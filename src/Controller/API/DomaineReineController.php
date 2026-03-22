<?php

namespace App\Controller\API;

use App\Entity\DomaineReine;
use App\Repository\DomaineReineRepository;
use App\Mapper\DomaineReineMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/domaine-reine','api_domaine_reine')]
class DomaineReineController extends AbstractController{

    #[Route('/{id}', name: 'api_domaine_reine_show', methods: ['GET'])]
    public function show(int $id,
    DomaineReineRepository $domaineReineRepository,
    DomaineReineMapper $domaineReineMapper
    ):JsonResponse {

        $domaineReine = $domaineReineRepository->find($id);
        $domaineReineDto = $domaineReineMapper->toDto($domaineReine);

        return $this->json($domaineReineDto);
    }

}