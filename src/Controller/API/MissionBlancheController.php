<?php

namespace App\Controller\API;

use App\Repository\MissionBlancheRepository;
use App\Mapper\MissionBlancheMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/mission-blanche','api_mission_blanche')]
class MissionBlancheController extends AbstractController{
    #[Route('/{id}', name: 'api_mission_blanche_show', methods: ['GET'])]
    public function show(
        int $id,
        MissionBlancheRepository $missionBlancheRepository,
        MissionBlancheMapper $missionBlancheMapper
    ):JsonResponse {
         try {
            // Vérifie que l'utilisateur est authentifié via JWT
            $user = $this->getUser(); // null si token invalide ou absent
            if (!$user) {
                return $this->json(['error' => 'Token invalide ou expiré'], 401);
            }
            $missionBlanche = $missionBlancheRepository->find($id);

            

            if (!$missionBlanche) {
                return $this->json(['error' => 'Mission Blanche introuvable'], 404);
            }

            // Transforme l'entité en DTO
            $missionBlancheDto = $missionBlancheMapper->toDto($missionBlanche);

            return $this->json($missionBlancheDto);

            } catch (\Exception $e) {
            // Retourne un message d'erreur détaillé pour debug Angular
            return $this->json(['error' => 'Erreur serveur: ' . $e->getMessage()], 500);
        }
    }
}