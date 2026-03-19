<?php

namespace App\Mapper;

use App\DTO\MissionBlancheDTO;
use App\Entity\MissionBlanche;

class MissionBlancheMapper{
    public function toDto(MissionBlanche $missionBlanche):MissionBlancheDTO{
        return new MissionBlancheDTO(
            id: $missionBlanche->getId(),
            objectif: $missionBlanche->getObjectif(),
            path: $missionBlanche->getPath(),
            numero: $missionBlanche->getNumero()
        );
    }
}