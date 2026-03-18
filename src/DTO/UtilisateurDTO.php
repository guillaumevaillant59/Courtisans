<?php

namespace App\DTO;

class UtilisateurDTO
{
 public function __construct(
    public ?int $id,
    public ?string $email,
    public ?string $password,
    public ?array $roles,
    public ?array $joueurs,
    public ?string $pseudo
    ){
        
    }
}

