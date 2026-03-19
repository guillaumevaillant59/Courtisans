<?php

namespace App\DTO;

class PartieDTO{
    public function __construct(
        public ?int $id,
        public ?int $domaineReine,
        public ?array $pioche,
        public ?array $joueurs,
        public ?int $nombreJoueurMax,
        public ?string $status
    ){

    }
}