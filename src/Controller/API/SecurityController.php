<?php

namespace App\Controller\API;

use App\Entity\Utilisateur;
use App\Mapper\UtilisateurMapper;
use App\Repository\UtilisateurRepository;
use App\Service\JWTService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController{
    #[Route('/api/login', methods: ['POST'])]
    public function login(Request $request, UtilisateurRepository $repo, JWTService $jwtService)
    {
        $data = json_decode($request->getContent(), true);
        $user = $repo->findOneBy(['email' => $data['email']]);

        if (!$user || !password_verify($data['password'], $user->getPassword())) {
            return $this->json(['error' => 'Identifiants invalides'], 401);
        }

        $token = $jwtService->generate($user);

        return $this->json(['token' => $token]);
    }
    #[Route('/api/profile')]
    public function profile(UtilisateurMapper $utilisateurMapper): JsonResponse
    {
        $user = $this->getUser();

        $dto = $utilisateurMapper->toDto($user);
        return $this->json($dto);   
    }

    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        $user = new Utilisateur();
        $user->setEmail($data['email']);
        $user->setPseudo($data['pseudo']);
        $user->setRoles(['ROLE_USER']);
        
        $hashedPassword = $hasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);

        $em->persist($user);
        $em->flush();

        return $this->json([
            'message' => 'Utilisateur créé'
        ]);
    }

    #[Route('/api/logout', name: 'api_logout', methods: ['POST'])]
    public function logout(): JsonResponse
    {
         return $this->json(['message' => 'Logged out']);
    }
}