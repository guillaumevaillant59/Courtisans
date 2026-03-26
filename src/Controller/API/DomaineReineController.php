<?php

namespace App\Controller\API;

use App\Repository\DomaineReineRepository;
use App\Mapper\DomaineReineMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/domaine-reine','api_domaine_reine')]
class DomaineReineController extends AbstractController{
     #[Route('/{id}', name: 'api_domaine_reine_show', methods: ['GET'])]
    public function show(
        int $id,
        DomaineReineRepository $domaineReineRepository,
        DomaineReineMapper $domaineReineMapper
    ): JsonResponse {
        try {
            // Vérifie que l'utilisateur est authentifié via JWT
            $user = $this->getUser(); // null si token invalide ou absent
            if (!$user) {
                return $this->json(['error' => 'Token invalide ou expiré'], 401);
            }

            // Récupère l'entité DomaineReine
            $domaineReine = $domaineReineRepository->find($id);

            if (!$domaineReine) {
                return $this->json(['error' => 'DomaineReine introuvable'], 404);
            }

            // Transforme l'entité en DTO
            $domaineReineDto = $domaineReineMapper->toDto($domaineReine);

            return $this->json($domaineReineDto);

        } catch (\Exception $e) {
            // Retourne un message d'erreur détaillé pour debug Angular
            return $this->json(['error' => 'Erreur serveur: ' . $e->getMessage()], 500);
        }
    }
}

