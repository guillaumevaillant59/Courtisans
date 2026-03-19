<?php

namespace App\DTO;

class MainJoueurDTO{
    public function __construct(
        public ?int $id,
        public ?array $cartes,
        public ?bool $jouerReine,
        public ?bool $jouerAdverse,
        public ?bool $jouerSoi
    )
    {
        throw new \Exception('Not implemented');
    }
}