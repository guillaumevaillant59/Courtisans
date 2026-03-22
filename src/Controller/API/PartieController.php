<?php

namespace App\Controller\API;

use App\Entity\Partie;
use App\Repository\PartieRepository;
use App\Mapper\PartieMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/partie', 'api_partie')]
class PartieController extends AbstractController{
    #[Route(path:'', name : '_index_partie', methods: ['GET'])]
    public function index(PartieRepository $pr,
        PartieMapper $pm
    ):JsonResponse{
        $parties = $pr->findAll();
        $partiesDtos = array_map(fn(Partie $partie) 
        => $pm->toDto($partie), $parties);

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
}