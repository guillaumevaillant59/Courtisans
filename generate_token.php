<?php
// generate_token.php

require __DIR__ . '/vendor/autoload.php';

use App\Security\JwtService;

// Instancie ton service JWT
$jwtService = new JwtService();

// Génère un token pour l'utilisateur test
$token = $jwtService->generate([
    'email' => 'test0@example.com',
    'roles' => ['ROLE_USER']
]);

echo "Token généré :\n$token\n";