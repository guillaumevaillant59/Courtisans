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
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
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

    #[Route('/{id}', name: 'api_partie_show', methods: ['GET'])]
    public function show(int $id, 
        PartieRepository $repo,
        PartieMapper $partieMapper
        ): JsonResponse{

        $partie = $repo->find($id);
        $partieDto = $partieMapper->toDto($partie);

        return $this->json($partieDto);
    }

    #[Route('/creation', name: 'api_partie_create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        DebutPartie $debutPartie
    ): JsonResponse
    {
        $authHeader = $request->headers->get('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return $this->json(['error' => 'Token manquant'], 401);
        }

        $token = substr($authHeader, 7);

        try {
            $decoded = JWT::decode($token, new Key('a8f9d2s7f9s8d7f9s8d7f9s8d7f9s8d7f9s8d7f9s8d7f9s8d7f9s8d7f9s8d7', 'HS256'));
        } catch (\Exception $e) {
            return $this->json(['error' => 'Token invalide'], 401);
        }

        $data = json_decode($request->getContent(), true);

        $nbJoueurs = $data['nombreJoueurMax'] ?? null;
        if (!$nbJoueurs) {
            return $this->json(['error' => 'nombreJoueurMax requis'], 400);
        }

        // Récupérer l'utilisateur depuis le token décodé
        $userId = $decoded->sub ?? null;
        if (!$userId) {
            return $this->json(['error' => 'Utilisateur invalide'], 401);
        }

        $user = $entityManager->getRepository(Utilisateur::class)->find($userId);
        if (!$user) {
            return $this->json(['error' => 'Utilisateur introuvable'], 401);
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

    #[Route('{id}/rejoindre', name:'api_partie_rejoindre', methods: ['POST'])]
    public function join(
    Partie $partie,
    EntityManagerInterface $entityManager,
    #[CurrentUser] $user,
    DebutPartie $debutPartie,
    Request $request
): JsonResponse
{
    // Optionnel : récupérer les données JSON envoyées
    $data = json_decode($request->getContent(), true);

    if (!$user) {
        return new JsonResponse(['error' => 'Non authentifié'], 401);
    }

    if ($partie->getJoueurs()->contains($user)) {
        return new JsonResponse(['error' => 'Déjà dans la partie'], 400);
    }

    if (count($partie->getJoueurs()) >= $partie->getNombreJoueurMax()) {
        return new JsonResponse(['error' => 'Partie pleine'], 400);
    }

    $partie = $debutPartie->rejoindrePartie($partie, $user);
    $entityManager->flush();

    return new JsonResponse([
        'message' => 'Partie rejointe',
        'partieId' => $partie->getId()
    ]);
}
}