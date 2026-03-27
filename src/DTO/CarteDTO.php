<?php

namespace App\DTO;

class CarteDTO{
    public function __construct(
        public ?int $id,
        public ?string $famille,
        public ?string $role,
        public ?string $path
    )
    {
        
    }
}