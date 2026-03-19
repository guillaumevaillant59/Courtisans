<?php

namespace App\DTO;

class MissionBlancheDTO{
    public function __construct(
        public ?int $id,
        public ?string $objectif,
        public ?string $path,
        public ?int $numero
    ) {}

}