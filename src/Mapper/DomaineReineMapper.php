<?php

namespace App\Mapper;

use App\Entity\DomaineReine;
use App\DTO\DomaineReineDTO;

class DomaineReineMapper{
    public function toDto(DomaineReine $domaineReine):DomaineReineDTO{
        return new DomaineReineDTO(
            id: $domaineReine->getId(),
            lumiere: $domaineReine->getLumiere()->getId(),
            disgrace: $domaineReine->getDisgrace()->getId(),
            path: $domaineReine->getPath()

        );
    }
}