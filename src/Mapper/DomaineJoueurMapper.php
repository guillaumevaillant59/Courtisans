<?php

namespace App\Mapper;

use App\Entity\DomaineJoueur;
use App\DTO\DomaineJoueurDTO;

class DomaineJoueurMapper
{
    public function toDto(DomaineJoueur $domaineJoueur):DomaineJoueurDTO{

    $papillons =[];
    foreach($domaineJoueur->getPapillons() as $papillon){
        $papillons[] = $papillon->getId();
    }

    $crapauds =[];
    foreach($domaineJoueur->getCrapauds() as $crapaud){
        $crapauds[] = $crapaud->getId();
    }

    $rossignols =[];
    foreach($domaineJoueur->getRossignols() as $rossignol){
        $rossignols[] = $rossignol->getId();
    }

    $espions =[];
    foreach($domaineJoueur->getEspions() as $espion){
        $espions[] = $espion->getId();
    }

    $cerfs =[];
    foreach($domaineJoueur->getCerfs() as $cerf){
        $cerfs[] = $cerf->getId();
    }

    $lapins =[];
    foreach($domaineJoueur->getLapins() as $lapin){
        $lapins[] = $lapin->getId();
    }

    $carpes =[];
    foreach($domaineJoueur->getCarpes() as $carpe){
        $carpes[] = $carpe->getId();
    }

    return new DomaineJoueurDTO(
        id : $domaineJoueur->getId(),
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