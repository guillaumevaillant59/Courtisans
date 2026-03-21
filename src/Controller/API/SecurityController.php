<?php

namespace App\Controller\API;

use App\Mapper\UtilisateurMapper;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController{
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Login handled by Symfony Security'
        ]);
    }
    #[Route('/api/profile')]
    public function profile(UtilisateurMapper $utilisateurMapper): JsonResponse
    {
        $user = $this->getUser();

        $dto = $utilisateurMapper->toDto($user);
        return $this->json($dto);   
    }

    #[Route('/api/logout', name: 'api_logout', methods: ['POST'])]
    public function logout(): JsonResponse
    {
         return $this->json(['message' => 'Logged out']);
    }
}