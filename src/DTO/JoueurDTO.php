<?php

namespace App\DTO;



class JoueurDTO{
    public function __construct(
        public ?int $id,
        public ?int $utilisateur,
        public ?int $partie,
        public ?int $main,
        public ?int $domaine,
        public ?int $missonBlanche,
        public ?int $missonBleue,
        public ?int $points,
        public ?int $position,
        public ?bool $actif
    )
    {
        
    }
}