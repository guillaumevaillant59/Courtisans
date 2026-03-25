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
        
        // Créer le domaine de la reine
        $domaineReine = $this->creerDomaineReine();
        $partie->setDomaineReine($domaineReine);

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
            $this->attribuerMissions($partie);
            $this->entityManager->persist($joueur);
        }
        $joueurs = array_values($partie->getJoueurs()->toArray());
        $joueur= $joueurs[array_rand($joueurs,1)];
        $this->servicePartie->activationJoueur($joueur);
        $this->entityManager->persist($joueur);
    }

    // Méthode pour attribuer les missions aux joueurs
    public function attribuerMissions(Partie $partie): void
    {
        // Récupération de toutes les missions disponibles
        $missionsBlanches = $this->missionBlancheRepository->findAll();
        $missionsBleues = $this->missionBleueRepository->findAll();

        // Attribution aléatoire d'une mission blanche aux joueurs
        foreach ($partie->getJoueurs() as $joueur) {
            $indexBlanche = array_rand($missionsBlanches);
            $missionBlanche = $missionsBlanches[$indexBlanche] ?? null;
            $joueur->setMissionBlanche($missionBlanche);
            unset($missionsBlanches[$indexBlanche]);
            $this->entityManager->persist($joueur);
        }

        // Attribution aléatoire d'une mission bleue aux joueurs
        foreach ($partie->getJoueurs() as $joueur) {
            $indexBleue = array_rand($missionsBleues);
            $missionBleue = $missionsBleues[$indexBleue] ?? null;
            $joueur->setMissionBleue($missionBleue);
            unset($missionsBleues[$indexBleue]);            
            $this->entityManager->persist($joueur);
        }

        $this->entityManager->flush();
        
    }

    // Méthode pour créer la pioche de cartes au début de la partie
    public function creerPioche(
        Partie $partie,
        CarteRepository $carteRepository,
        EntityManagerInterface $entityManager
    ): void {
        $cartes = $carteRepository->findAll();
        foreach ($cartes as $carte) {
            $partie->addPioche($carte);
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
        $domaineReine->setPath('assets/images/domaine_reine.jpg');

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
        
        switch ($nombreJoueurs) {
            case 2:
                $cartesAEnlever = 30;
                break;
            case 3:
                $cartesAEnlever = 18;
                break;
            case 4:
                $cartesAEnlever = 6;
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
            $partie->removePioche($carte);
            unset($cartesPioche[$index]);
            $this->entityManager->persist($partie);
        }
    }
}
