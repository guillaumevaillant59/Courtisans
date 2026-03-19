<?php

namespace App\Mapper;

use App\Entity\Disgrace;
use App\DTO\DisgraceDTO;

class DisgraceMapper
{
    public function toDto(Disgrace $disgrace):DisgraceDTO{

    $papillons =[];
    foreach($disgrace->getPapillons() as $papillon){
        $papillons[] = $papillon->getId();
    }

    $crapauds =[];
    foreach($disgrace->getCrapauds() as $crapaud){
        $crapauds[] = $crapaud->getId();
    }

    $rossignols =[];
    foreach($disgrace->getRossignols() as $rossignol){
        $rossignols[] = $rossignol->getId();
    }

    $espions =[];
    foreach($disgrace->getEspions() as $espion){
        $espions[] = $espion->getId();
    }

    $cerfs =[];
    foreach($disgrace->getCerfs() as $cerf){
        $cerfs[] = $cerf->getId();
    }

    $lapins =[];
    foreach($disgrace->getLapins() as $lapin){
        $lapins[] = $lapin->getId();
    }

    $carpes =[];
    foreach($disgrace->getCarpes() as $carpe){
        $carpes[] = $carpe->getId();
    }

    return new DisgraceDTO(
        id : $disgrace->getId(),
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