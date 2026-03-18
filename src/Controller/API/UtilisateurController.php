<?php

namespace App\Controller\API;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use App\Mapper\UtilisateurMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('api/utilisateurs', name:'api_utilisateur')]
class UtilisateurController extends AbstractController
{
    #[Route(path:'', name:'_index_utilisateur', methods: ['GET'])]
    public function index(UtilisateurRepository $repo,
    UtilisateurMapper $utilisateurMapper
    ): JsonResponse {
        $utilisateurs = $repo->findAll();
        $utilisateursDtos = array_map(fn(Utilisateur $utilisateur) => $utilisateurMapper->toDto($utilisateur), $utilisateurs);

        return $this->json($utilisateursDtos);
    }
}