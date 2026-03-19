<?php

namespace App\DTO;



class JoueurDTO{
    public function __construct(
        public ?int $id,
        public ?int $point
    )
    {
        throw new \Exception('Not implemented');
    }
}