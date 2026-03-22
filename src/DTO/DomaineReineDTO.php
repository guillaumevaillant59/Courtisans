<?php

namespace App\DTO;

class DomaineReineDTO{
    
    public function __construct(
        public ?int $id,
        public ?int $lumiere,
        public ?int $disgrace,
        public ?string $path

    ){
    }
}