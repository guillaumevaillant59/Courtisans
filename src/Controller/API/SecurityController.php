<?php

namespace App\Controller\API;

use App\Entity\Utilisateur;
use App\Mapper\UtilisateurMapper;
use App\Repository\UtilisateurRepository;
use App\Security\JwtService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController
{
    #[Route('/api/login', methods: ['POST'])]
    public function login(
        Request $request,
        UtilisateurRepository $repo,
        JwtService $jwtService // ✅ injection correcte
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        $user = $repo->findOneBy(['email' => $data['email'] ?? null]);

        if (!$user || !password_verify($data['password'], $user->getPassword())) {
            return $this->json(['error' => 'Identifiants invalides'], 401);
        }

        // ✅ IMPORTANT : on génère le token avec un tableau (payload)
        $token = $jwtService->generate([
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
        ]);

        return $this->json(['token' => $token]);
    }

    #[Route('/api/profile', methods: ['GET'])]
    public function profile(UtilisateurMapper $utilisateurMapper): JsonResponse
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->json(['error' => 'Non authentifié'], 401);
        }

        $dto = $utilisateurMapper->toDto($user);
        return $this->json($dto);
    }

    #[Route('/api/register', methods: ['POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $hasher
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (empty($data['email']) || empty($data['pseudo']) || empty($data['password'])) {
            return $this->json(['error' => 'Données manquantes'], 400);
        }

        $existingUser = $em->getRepository(Utilisateur::class)->findOneBy(['email' => $data['email']]);
        if ($existingUser) {
            return $this->json(['error' => 'Utilisateur déjà existant'], 409);
        }

        $user = new Utilisateur();
        $user->setEmail($data['email']);
        $user->setPseudo($data['pseudo']);
        $user->setRoles(['ROLE_USER']);

        $hashedPassword = $hasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);

        $em->persist($user);
        $em->flush();

        return $this->json([
            'message' => 'Utilisateur créé avec succès'
        ], 201);
    }

    #[Route('/api/logout', methods: ['POST'])]
    public function logout(): JsonResponse
    {
        return $this->json(['message' => 'Logged out']);
    }
}