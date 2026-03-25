<?php

namespace App\Mapper;

use App\DTO\PartieDTO;
use App\Entity\Partie;

class PartieMapper{
    public function toDto(Partie $partie):PartieDTO{

        $pioche=[];
        foreach($partie->getPioche() as $carte){
            $pioche[]=$carte->getId();
        }

        $joueurs=[];
        foreach($partie->getJoueurs() as $joueur){
            $joueurs[]=$joueur->getId();
        }

        return new PartieDTO(
            id: $partie->getId(),
            domaineReine: $partie->getDomaineReine()?->getId(),
            pioche: $pioche,
            joueurs: $joueurs,
            nombreJoueurMax: $partie->getNombreJoueurMax(),
            status: $partie->getStatus()
        );
    }
}