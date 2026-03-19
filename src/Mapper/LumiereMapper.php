<?php

namespace App\Mapper;

use App\DTO\LumiereDTO;
use App\Entity\Lumiere;

class LumiereMapper{

    public function toDto(Lumiere $lumiere):LumiereDTO{

        $papillons =[];
    foreach($lumiere->getPapillons() as $papillon){
        $papillons[] = $papillon->getId();
    }

    $crapauds =[];
    foreach($lumiere->getCrapauds() as $crapaud){
        $crapauds[] = $crapaud->getId();
    }

    $rossignols =[];
    foreach($lumiere->getRossignols() as $rossignol){
        $rossignols[] = $rossignol->getId();
    }

    $espions =[];
    foreach($lumiere->getEspions() as $espion){
        $espions[] = $espion->getId();
    }

    $cerfs =[];
    foreach($lumiere->getCerfs() as $cerf){
        $cerfs[] = $cerf->getId();
    }

    $lapins =[];
    foreach($lumiere->getLapins() as $lapin){
        $lapins[] = $lapin->getId();
    }

    $carpes =[];
    foreach($lumiere->getCarpes() as $carpe){
        $carpes[] = $carpe->getId();
    }

    return new LumiereDTO(
        id : $lumiere->getId(),
        papillons : $papillons,
        crapauds: $crapauds,
        rossignols: $rossignols,
        espions: $espions,
        cerfs: $cerfs,
        lapins: $lapins,
        carpes: $carpes
    );
    }
}