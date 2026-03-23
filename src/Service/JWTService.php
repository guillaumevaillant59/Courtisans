<?php
// src/Service/JWTService.php
namespace App\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Entity\Utilisateur;

class JWTService
{
    private $secret = 'a8f9d2s7f9s8d7f9s8d7f9s8d7f9s8d7f9s8d7f9s8d7f9s8d7f9s8d7f9s8d7';

    public function generate(Utilisateur $user, int $exp = 3600): string
    {
        $payload = [
            'sub' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'pseudo' => $user->getPseudo(),
            'iat' => time(),
            'exp' => time() + $exp
        ];

        return JWT::encode($payload, $this->secret, 'HS256');
    }

    public function decode(string $token)
    {
        return JWT::decode($token, new Key($this->secret, 'HS256'));
    }
}