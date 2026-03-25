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
    // 1️⃣ Récupère les données JSON envoyées depuis Angular
    $data = json_decode($request->getContent(), true);

    // Vérifie que tous les champs requis sont présents
    if (empty($data['email']) || empty($data['pseudo']) || empty($data['password'])) {
        return $this->json(['error' => 'Données manquantes'], 400);
    }

    // 2️⃣ Vérifie si l'utilisateur existe déjà
    $existingUser = $em->getRepository(Utilisateur::class)->findOneBy(['email' => $data['email']]);
    if ($existingUser) {
        return $this->json(['error' => 'Utilisateur déjà existant'], 409);
    }

    // 3️⃣ Crée un nouvel utilisateur
    $user = new Utilisateur();
    $user->setEmail($data['email']);
    $user->setPseudo($data['pseudo']);
    $user->setRoles(['ROLE_USER']);

    // 4️⃣ Hash le mot de passe
    $hashedPassword = $hasher->hashPassword($user, $data['password']);
    $user->setPassword($hashedPassword);

    // 5️⃣ Persiste et flush en base
    $em->persist($user);
    $em->flush();

    // 6️⃣ Retourne un succès JSON
    return $this->json([
        'message' => 'Utilisateur créé avec succès',
        'email' => $user->getEmail(),
        'pseudo' => $user->getPseudo()
    ], 201);
}

    #[Route('/api/logout', name: 'api_logout', methods: ['POST'])]
    public function logout(): JsonResponse
    {
         return $this->json(['message' => 'Logged out']);
    }
}