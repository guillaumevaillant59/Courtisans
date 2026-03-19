<?php

namespace App\DTO;

class DisgraceDTO{
    public function __construct(
        public ?int $id,
        public ?array $papillons,
        public ?array $crapauds,
        public ?array $rossignols,
        public ?array $espions,
        public ?array $cerfs,
        public ?array $lapins,
        public ?array $carpes,

    ){

    }
}