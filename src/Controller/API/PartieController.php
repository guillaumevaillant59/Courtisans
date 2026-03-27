<?php

namespace App\Controller\API;

use App\DTO\PartieDTO;
use App\Entity\Partie;
use App\Entity\Utilisateur;
use App\Repository\PartieRepository;
use App\Mapper\PartieMapper;
use App\Service\DebutPartie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;


#[Route('api/partie', 'api_partie')]
class PartieController extends AbstractController{
    #[Route(path:'', name : '_index_partie', methods: ['GET'])]
    public function index(PartieRepository $pr,
        PartieMapper $pm
    ):JsonResponse{
        $parties = $pr->findAll();
        $partiesDtos =[];
        foreach($parties as $partie){
            if($partie->getStatus() === "en cours" || $partie->getStatus() === "terminer" ){
                $partieDto = $pm->toDto($partie);
                $partiesDtos[] = $partieDto;
            }else{
                $joueurs = [];
                foreach ($partie->getJoueurs() as $joueur) {
                    $joueurs[]=$joueur->getId();
                }
                $partieDto = new PartieDTO(
                    id : $partie->getId(),
                    domaineReine: null,
                    pioche: null,
                    joueurs: $joueurs,
                    nombreJoueurMax: $partie->getNombreJoueurMax(),
                    status: $partie->getStatus()
                );
                $partiesDtos[]=$partieDto;
            }
        }

        return $this->json($partiesDtos);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(
            int $id,
            PartieRepository $partieRepository,
            PartieMapper $partieMapper
        ): JsonResponse {
            try {
                // Vérifie si l'utilisateur est authentifié via JWT
                $user = $this->getUser(); // null si token invalide ou absent
                if (!$user) {
                    return $this->json(['error' => 'Token invalide ou expiré'], 401);
                }

                // Récupère l'entité Partie
                $partie = $partieRepository->find($id);

                if (!$partie) {
                    return $this->json(['error' => 'Partie introuvable'], 404);
                }

                // Sérialisation sécurisée avec groupes
                $data = $partieMapper->toDto($partie);

                return $this->json($data);

            } catch (\Exception $e) {
                // Retourne le message exact pour debug Angular
                return $this->json(['error' => 'Erreur serveur: ' . $e->getMessage()], 500);
            }
        }

    #[Route('/creation', name: 'api_partie_create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        DebutPartie $debutPartie
    ): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->json(['error' => 'Non authentifié'], 401);
        }

        $data = json_decode($request->getContent(), true);

        $nbJoueurs = $data['nombreJoueurMax'] ?? null;
        if (!$nbJoueurs) {
            return $this->json(['error' => 'nombreJoueurMax requis'], 400);
        }

        $partie = $debutPartie->creerPartie($nbJoueurs, $user);

        $entityManager->persist($partie);
        $entityManager->flush();

        return $this->json([
            'message' => 'Partie créée ✅',
            'partie' => [
                'id' => $partie->getId(),
                'nombreJoueurMax' => $partie->getNombreJoueurMax()
            ]
        ], 201);
    }

    #[Route('/{id}/rejoindre', name:'api_partie_rejoindre', methods: ['POST'])]
    public function join(
        Partie $partie,
        EntityManagerInterface $entityManager,
        DebutPartie $debutPartie,
        #[CurrentUser] ?Utilisateur $user
    ): JsonResponse
    {
        if (!$user) {
            return new JsonResponse(['error' => 'Non authentifié'], 401);
        }

        try {
            // Utilise le service pour ajouter l'utilisateur à la partie
            $partie = $debutPartie->rejoindrePartie($partie, $user);

            return new JsonResponse([
                'message' => 'Partie rejointe',
                'partieId' => $partie->getId(),
                'joueurs' => array_map(fn($joueur) => $joueur->getUtilisateur()->getId(), $partie->getJoueurs()->toArray())
            ]);
        } catch (\LogicException $e) {
            // Gestion de l'erreur si l'utilisateur est déjà dans la partie
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/{id}', name: 'api_partie_delete', methods: ['DELETE'])]
    public function delete(
        Partie $partie,
        EntityManagerInterface $entityManager,
        #[CurrentUser] $user
    ): JsonResponse
    {
        if (!$user) {
            return new JsonResponse(['error' => 'Non authentifié'], 401);
        }

        $entityManager->remove($partie);
        $entityManager->flush();

        return new JsonResponse([
            'message' => 'Partie supprimée'
        ]);
    }
}