<?php

namespace App\Mapper;

use App\DTO\MainJoueurDTO;
use App\Entity\MainJoueur;

class MainJoueurMapper{

    public function toDto(MainJoueur $mainJoueur):MainJoueurDTO{

        $cartes = [];
        foreach($mainJoueur->getCartes() as $carte){
            $cartes[]=$carte->getId();
        }

        return new MainJoueurDTO(
            id :$mainJoueur->getId(),
            cartes : $cartes,
            jouerReine : $mainJoueur->isJouerReine(),
            jouerAdverse : $mainJoueur->isJouerAdverse(),
            jouerSoi : $mainJoueur->isJouerSoi()
        );
    }
}