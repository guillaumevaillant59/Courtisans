<?php

namespace App\Mapper;

use App\DTO\MissionBleueDTO;
use App\Entity\MissionBleue;

class MissionBleueMapper{
    public function toDto(MissionBleue $missionBleue):MissionBleueDTO{
        return new MissionBleueDTO(
            id: $missionBleue->getId(),
            objectif: $missionBleue->getObjectif(),
            path: $missionBleue->getPath(),
            numero: $missionBleue->getNumero()
        );
    }
}