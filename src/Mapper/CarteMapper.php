<?php

namespace App\Mapper;

use App\DTO\CarteDTO;
use App\Entity\Carte;

class CarteMapper{

    public function toDto(Carte $carte) : CarteDTO {

        return new CarteDTO(
            id : $carte->getId(),
            famille : $carte->getFamille(),
            role : $carte->getRole(),
            path : $carte->getPath()
        );
    }
}