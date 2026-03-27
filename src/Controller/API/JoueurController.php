<?php

namespace App\Controller\API;

use App\Entity\Partie;
use App\Repository\JoueurRepository;
use App\Mapper\JoueurMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/joueur','api_joueur')]
class JoueurController extends AbstractController{
    
    #[Route('/{id}', name: 'api_joueur_show', methods: ['GET'])]
    public function show(
        int $id,
        JoueurRepository $joueurRepository,
        JoueurMapper $joueurMapper
    ):JsonResponse {
        try {
            // Vérifie que l'utilisateur est authentifié via JWT
            $user = $this->getUser(); // null si token invalide ou absent
            if (!$user) {
                return $this->json(['error' => 'Token invalide ou expiré'], 401);
            }

            $joueur = $joueurRepository->find($id);

            if(!$joueur){
                return $this->json(['error' => 'Joueur introuvable'], 404);
            }

            $joueurDto = $joueurMapper->toDto($joueur);

            return $this->json($joueurDto);
        } catch (\Exception $e) {
            // Retourne un message d'erreur détaillé pour debug Angular
            return $this->json(['error' => 'Erreur serveur: ' . $e->getMessage()], 500);
        }
    }
}