<?php

namespace App\Mapper;

use App\DTO\UtilisateurDTO;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\UrlHelper;

class UtilisateurMapper{
    public function __construct(        
        private readonly UrlHelper $urlHelper
        ) {
        }

    public function toDto(Utilisateur $utilisateur): UtilisateurDTO {

        $joueurs = [];
        foreach($utilisateur->getJoueurs() as $joueur){
            $joueurs[] = $joueur->getId();
        }

        return new UtilisateurDTO(
            id : $utilisateur->getId(),
            email: $utilisateur->getEmail(),
            password: $utilisateur->getPassword(),
            roles : $utilisateur->getRoles(),
            joueurs: $joueurs,
            pseudo: $utilisateur->getPseudo(),
        );

    }
}