<?php

namespace App\Mapper;

use App\Entity\Joueur;
use App\DTO\JoueurDTO;

class JoueurMapper{
    public function toDto(Joueur $joueur):JoueurDTO{
        return new JoueurDTO(
            id: $joueur->getId(),
            utilisateur: $joueur->getUtilisateur()?->getId(),
            partie: $joueur->getPartie()?->getId(),
            main: $joueur->getMain()?->getId(),
            domaine: $joueur->getDomaine()?->getId(),
            missionBlanche: $joueur->getMissionBlanche()?->getId(),
            missionBleue: $joueur->getMissionBleue()?->getId(),
            points: $joueur->getPoints(),
            position: $joueur->getPosition(),
            actif: $joueur->isActif()
        );
    }
}