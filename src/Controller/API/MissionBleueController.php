<?php

namespace App\Controller\API;

use App\Repository\MissionBleueRepository;
use App\Mapper\MissionBleueMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/mission-bleue','api_mission_Bleue')]
class MissionBleueController extends AbstractController{
    #[Route('/{id}', name: 'api_mission_bleue_show', methods: ['GET'])]
    public function show(
        int $id,
        MissionBleueRepository $missionBleueRepository,
        MissionBleueMapper $missionBleueMapper
    ):JsonResponse {
         try {
            // Vérifie que l'utilisateur est authentifié via JWT
            $user = $this->getUser(); // null si token invalide ou absent
            if (!$user) {
                return $this->json(['error' => 'Token invalide ou expiré'], 401);
            }
            $missionBleue = $missionBleueRepository->find($id);

            

            if (!$missionBleue) {
                return $this->json(['error' => 'Mission Bleue introuvable'], 404);
            }

            // Transforme l'entité en DTO
            $missionBleueDto = $missionBleueMapper->toDto($missionBleue);

            return $this->json($missionBleueDto);

            } catch (\Exception $e) {
            // Retourne un message d'erreur détaillé pour debug Angular
            return $this->json(['error' => 'Erreur serveur: ' . $e->getMessage()], 500);
        }
    }
}