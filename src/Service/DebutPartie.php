<?php

namespace App\Service;

use App\Entity\Partie;
use App\Entity\Joueur;
use App\Entity\Carte;
use App\Entity\DomaineReine;
use App\Entity\Lumiere;
use App\Entity\Disgrace;
use App\Entity\Utilisateur;
use App\Entity\MainJoueur;

use App\Repository\CarteRepository;
use App\Repository\MissionBlancheRepository; 
use App\Repository\MissionBleueRepository;
use App\Service\ServicePartie;
use Doctrine\ORM\EntityManagerInterface; 
   

final class DebutPartie
{
    private $entityManager;
    private $carteRepository;
    private $missionBlancheRepository;
    private $missionBleueRepository;
    private $servicePartie;

    public function __construct(
        EntityManagerInterface $entityManager,
        CarteRepository $carteRepository,
        MissionBlancheRepository $missionBlancheRepository,
        MissionBleueRepository $missionBleueRepository,
        ServicePartie $servicePartie
    ) {
        $this->entityManager = $entityManager;
        $this->carteRepository = $carteRepository;
        $this->missionBlancheRepository = $missionBlancheRepository;
        $this->missionBleueRepository = $missionBleueRepository;
        $this->servicePartie = $servicePartie;
    }

    // Méthode pour initier une partie et ajouter le premier joueur
    public function creerPartie(int $nombreJoueurMax, Utilisateur $utilisateur): Partie
    {
        // Création d'une nouvelle partie 
        $partie = new Partie();
        // Initialisation des propriétés de la partie
        $partie->setNombreJoueurMax($nombreJoueurMax);
        // Création du joueur qui a initié la partie et association avec la partie
        $joueur = new Joueur();
        $joueur->setUtilisateur($utilisateur);
        $joueur->setPartie($partie);
        $joueur->setPosition(1);
        $partie->addJoueur($joueur);
        $partie->setStatus('en attente');

        $this->entityManager->persist($joueur);    
        $this->entityManager->persist($partie);
        $this->entityManager->flush();

        return $partie;
    }

    // Méthode pour rejoindre une partie existante
    public function rejoindrePartie(Partie $partie, Utilisateur $utilisateur): Partie
    {
        // Création du joueur qui rejoint la partie et association avec la partie
        $joueur = new Joueur();
        $joueur->setUtilisateur($utilisateur);
        $joueur->setPartie($partie);
        $joueur->setPosition($partie->getJoueurs()->count() + 1);           
        $partie->addJoueur($joueur);
        if ($partie->getJoueurs()->count() === $partie->getNombreJoueurMax()) {
            $partie->setStatus('en cours');
            $this->initialiserPartie($partie);
        }

        $this->entityManager->persist($joueur);
        $this->entityManager->persist($partie);
        $this->entityManager->flush();

        return $partie;
    }

    // Méthode pour initialiser la partie une fois que tous les joueurs ont rejoint
    public function initialiserPartie(Partie $partie): void
    {
        // Créer le domaine de la reine
        $domaineReine = $this->creerDomaineReine();
        $partie->setDomaineReine($domaineReine);

        // Créer la pioche
        $this->creerPioche($partie, $this->carteRepository, $this->entityManager);
        $this->commencerPartie($partie);

        $this->entityManager->persist($partie);
        $this->entityManager->flush();
    }

    // Méthode pour démarrer la partie : distribuer les cartes et attribuer les missions aux joueurs
    public function commencerPartie(Partie $partie): void
    {
        // Commencement de la partie : distribution des cartes aux joueurs.
        foreach ($partie->getJoueurs() as $joueur) {
            // Créer la main du joueur
            $main = new MainJoueur();
            $joueur->setMain($main);
            // Distribuer des cartes au joueur. 
            $this->servicePartie->piocher($partie, $joueur);
            // Attribuer des missions au joueur.
            $this->attribuerMissions($partie, $joueur);
            $this->entityManager->persist($joueur);
        }
    }

    // Méthode pour attribuer les missions aux joueurs
    public function attribuerMissions(Partie $partie, Joueur $joueur): void
    {
        // Récupération de toutes les missions disponibles
        $missionsBlanches = $this->missionBlancheRepository->findAll();
        $missionsBleues = $this->missionBleueRepository->findAll();

        // Attribution aléatoire d'une mission blanche
        $indexBlanche = array_rand($missionsBlanches);
        $missionBlanche = $missionsBlanches[$indexBlanche] ?? null;
        if ($missionBlanche) {
            $joueur->setMissionBlanche($missionBlanche);
        }

        // Attribution aléatoire d'une mission bleue au joueur
        $indexBleue = array_rand($missionsBleues);
        $missionBleue = $missionsBleues[$indexBleue] ?? null;
        if ($missionBleue) {
            $joueur->setMissionBleue($missionBleue);
        }
        
        $this->entityManager->persist($joueur);
        $this->entityManager->flush();
    }

    // Méthode pour créer la pioche de cartes au début de la partie
    public function creerPioche(
        Partie $partie,
        CarteRepository $carteRepository,
        EntityManagerInterface $entityManager
    ): void {
        for($i=0; $i<4; $i++) {
            $carte = $carteRepository->findOneByFamilleAndRole('Papillon', 'Normal');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Papillon', 'Noble');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Crapaud', 'Normal');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Crapaud', 'Noble');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Rossignol', 'Normal');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Rossignol', 'Noble');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Cerf', 'Normal');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Cerf', 'Noble');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Lapin', 'Normal');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Lapin', 'Noble');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Carpe', 'Normal');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Carpe', 'Noble');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
        }
        for($j=0; $j<3; $j++) {
            $carte = $carteRepository->findOneByFamilleAndRole('Papillon', 'Protecteur');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Crapaud', 'Protecteur');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Rossignol', 'Protecteur');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Cerf', 'Protecteur');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Lapin', 'Protecteur');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Carpe', 'Protecteur');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
        }
        for($k=0; $k<2; $k++) {
            $carte = $carteRepository->findOneByFamilleAndRole('Papillon', 'Assassin');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Papillon', 'Espion');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Crapaud', 'Assassin');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Crapaud', 'Espion');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Rossignol', 'Assassin');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Rossignol', 'Espion');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Cerf', 'Assassin');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Cerf', 'Espion');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Lapin', 'Assassin');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Lapin', 'Espion');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }            
            $carte = $carteRepository->findOneByFamilleAndRole('Carpe', 'Assassin');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->findOneByFamilleAndRole('Carpe', 'Espion');
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
        }

        $this->retirerCartesPioche($partie);

        $entityManager->persist($partie);
        $entityManager->flush();
    }

    // Méhode pour créer le domaine de la reine au début de la partie
    public function creerDomaineReine(): DomaineReine
    {
        $lumiere = new Lumiere();
        $disgrace = new Disgrace();
        $domaineReine = new DomaineReine();
        $domaineReine->setLumiere($lumiere);
        $domaineReine->setDisgrace($disgrace);
        $domaineReine->setPath('/assets/images/domaine_reine.jpg');

        $this->entityManager->persist($lumiere);
        $this->entityManager->persist($disgrace);
        $this->entityManager->persist($domaineReine);
        $this->entityManager->flush();

        return $domaineReine;
    }

    // Méthode pour retirer les cartes de la pioche en fonction du nombre de joueurs
    public function retirerCartesPioche(Partie $partie): void
    {
        $nombreJoueurs = $partie->getNombreJoueurMax();
        $cartesPioche = $partie->getPioche()->toArray();
        
        switch ($nombreJoueurs) {
            case 2:
                $cartesAEnlever = 30;
                break;
            case 3:
                $cartesAEnlever = 15;
                break;
            default:
                $cartesAEnlever = 0;
        }
        $this->enleverCartesDePioche($partie, $cartesAEnlever);

        $this->entityManager->persist($partie);
        $this->entityManager->flush();
    }
    
    // Méthode pour retirer les cartes de la pioche 
    public function enleverCartesDePioche(Partie $partie, int $nombreCartes): void
    {
        $cartesPioche = $partie->getPioche()->toArray();
        
        for ($i = 0; $i < $nombreCartes; $i++) {
            $index = array_rand($cartesPioche);
            $carte = $cartesPioche[$index] ?? null;
            if ($carte) {
                $partie->getPioche()->removeElement($carte);
            }
        }
    }
}
