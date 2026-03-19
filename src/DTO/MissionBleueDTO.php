<?php

namespace App\DTO;

class MissionBleueDTO{
    public function __construct(
        public ?int $id,
        public ?string $objectif,
        public ?string $path,
        public ?int $numero
    ) {}
}