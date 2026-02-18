<?php

namespace App\Service;

use App\Entity\Partie;
use App\Entity\Joueur;
   

final class FinPartie
{
    private $entityManager;
    private $carteRepository;

    public function __construct($entityManager, $carteRepository)
    {
        $this->entityManager = $entityManager;
        $this->carteRepository = $carteRepository;
    }

    // Méthode pour terminer la partie
    public function terminerPartie(Partie $partie): void
    {
            $partie->setStatus('terminée');
            $this->placerEspionDansFamille($partie);
            $this->entityManager->persist($partie);
            $this->entityManager->flush();
    }

    // Méthode pour placer les cartes espion dans leur famille respective à la fin de la partie
    public function placerEspionDansFamille(Partie $partie): void
    {
        $domaineReine = $partie->getDomaineReine();
        $espionsLumiere = $domaineReine->getLumiere()->getEspion();
        foreach ($espionsLumiere as $espion) {
            $domaineReine->getLumiere()->removeEspion($espion);
           switch ($espion->getFamille()) 
           {
                case 'Papillon': 
                    $domaineReine->getLumiere()->addPapillon($espion);
                    break; 
                case 'Crapaud':
                    $domaineReine->getLumiere()->addCrapaud($espion); 
                    break; 
                case 'Rossignol': 
                    $domaineReine->getLumiere()->addRossignol($espion); 
                    break; 
                case 'Cerf': 
                    $domaineReine->getLumiere()->addCerf($espion); 
                    break; 
                case 'Lapin': 
                    $domaineReine->getLumiere()->addLapin($espion); 
                    break; 
                case 'Carpe': 
                        $domaineReine->getLumiere()->addCarpe($espion); 
                        break; 
            }
        }

        $espionsDisgrace = $domaineReine->getDisgrace()->getEspion();
        foreach ($espionsDisgrace as $espion) {
            $domaineReine->getDisgrace()->removeEspion($espion);
            switch ($espion->getFamille()) 
            { 
                case 'Papillon': 
                    $domaineReine->getDisgrace()->addPapillon($espion); 
                    break; 
                case 'Crapaud': 
                    $domaineReine->getDisgrace()->addCrapaud($espion); 
                    break; 
                case 'Rossignol': 
                    $domaineReine->getDisgrace()->addRossignol($espion); 
                    break; 
                case 'Cerf': 
                    $domaineReine->getDisgrace()->addCerf($espion); 
                    break; 
                case 'Lapin': 
                    $domaineReine->getDisgrace()->addLapin($espion); 
                    break; 
                case 'Carpe': 
                    $domaineReine->getDisgrace()->addCarpe($espion); 
                    break; 
            }
        }

        $joueurs = $partie->getJoueurs();
        foreach ($joueurs as $joueur) {
            $espionsDomaineJoueur = $joueur->getDomaine()->getEspion();
            foreach ($espionsDomaineJoueur as $espion) {
                $joueur->getDomaine()->removeEspion($espion);
                switch ($espion->getFamille())
                { 
                    case 'Papillon': 
                        $joueur->getDomaine()->addPapillon($espion); 
                        break; 
                    case 'Crapaud': 
                        $joueur->getDomaine()->addCrapaud($espion); 
                        break; 
                    case 'Rossignol': 
                        $joueur->getDomaine()->addRossignol($espion); 
                        break; 
                    case 'Cerf': 
                        $joueur->getDomaine()->addCerf($espion); 
                        break; 
                    case 'Lapin': 
                        $joueur->getDomaine()->addLapin($espion); 
                        break; 
                    case 'Carpe': 
                        $joueur->getDomaine()->addCarpe($espion); 
                        break; 
                }
            }
            $this->entityManager->persist($joueur->getDomaine());
        }   
        $this->entityManager->persist($domaineReine);
        $this->entityManager->flush();
    }

    // Méhode pour identifier les familles en lumière et en disgrâce à la fin de la partie
    public function familleEnLumière(Partie $partie, string $famille): bool
    {
        $domaineReine = $partie->getDomaineReine();
        $oui = true;
        switch ($famille) {
            case 'Papillon':
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Papillon') - $this->compterNombreParFamilleEnDisgrace($partie, 'Papillon') > 0;
                break;
            case 'Crapaud':         
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Crapaud') - $this->compterNombreParFamilleEnDisgrace($partie, 'Crapaud') > 0;
                break;
            case 'Rossignol':
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Rossignol') - $this->compterNombreParFamilleEnDisgrace($partie, 'Rossignol') > 0;
                break;
            case 'Cerf':
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Cerf') - $this->compterNombreParFamilleEnDisgrace($partie, 'Cerf') > 0;
                break;
            case 'Lapin':
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Lapin') - $this->compterNombreParFamilleEnDisgrace($partie, 'Lapin') > 0;
                break;
            case 'Carpe':
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Carpe') - $this->compterNombreParFamilleEnDisgrace($partie, 'Carpe') > 0;
                break;
        }
        
        return $oui;
    }

    // Méthode pour compter le nombre de cartes d'une famille dans le domaine de la lumière
    public function compterNombreParFamilleEnLumiere(Partie $partie, string $famille): int
    {
        $domaineReine = $partie->getDomaineReine();
        $nombre = 0;
        $cartes = null;
        switch ($famille) {
            case 'Papillon':
                $cartes = $domaineReine->getLumiere()->getPapillon();
                break;
            case 'Crapaud':         
                $cartes = $domaineReine->getLumiere()->getCrapaud();
                break;
            case 'Rossignol':
                $cartes = $domaineReine->getLumiere()->getRossignol();
                break;
            case 'Cerf':
                $cartes = $domaineReine->getLumiere()->getCerf();
                break;
            case 'Lapin':
                $cartes = $domaineReine->getLumiere()->getLapin();
            case 'Carpe':
                $cartes = $domaineReine->getLumiere()->getCarpe();
                break;
        }
        foreach ($cartes as $carte) {
            if ($carte->getRole() === 'Noble') {
                $nombre += 2;
            } else {
                $nombre += 1;
            }
        }        
        return $nombre;
    }

    // Méthode pour compter le nombre de cartes d'une famille dans le domaine de la disgrâce
    public function compterNombreParFamilleEnDisgrace(Partie $partie, string $famille): int
    {
        $domaineReine = $partie->getDomaineReine();
        $nombre = 0;
        $cartes = null;
        switch ($famille) {
            case 'Papillon':
                $cartes = $domaineReine->getDisgrace()->getPapillon();
                break;
            case 'Crapaud':         
                $cartes = $domaineReine->getDisgrace()->getCrapaud();
                break;
            case 'Rossignol':
                $cartes = $domaineReine->getDisgrace()->getRossignol();
                break;
            case 'Cerf':
                $cartes = $domaineReine->getDisgrace()->getCerf();
                break;
            case 'Lapin':
                $cartes = $domaineReine->getDisgrace()->getLapin();
            case 'Carpe':
                $cartes = $domaineReine->getDisgrace()->getCarpe();
                break;
        }
        foreach ($cartes as $carte) {
            if ($carte->getRole() === 'Noble') {
                $nombre += 2;
            } else {
                $nombre += 1;
            }
        }        
        return $nombre;
    }

    // Méthode pour compter les points d'un joueur à la fin de la partie
    public function compterPoints(Joueur $joueur): int
    {
        $points = 0;
        $points += $this->compterPointsParFamilleParJoueur($joueur, 'Papillon');
        $points += $this->compterPointsParFamilleParJoueur($joueur, 'Crapaud');
        $points += $this->compterPointsParFamilleParJoueur($joueur, 'Rossignol');
        $points += $this->compterPointsParFamilleParJoueur($joueur, 'Cerf');
        $points += $this->compterPointsParFamilleParJoueur($joueur, 'Lapin');
        $points += $this->compterPointsParFamilleParJoueur($joueur, 'Carpe');

        return $points;
    }

    // Méthode pour compter les points d'une famille pour un joueur à la fin de la partie
    public function compterPointsParFamilleParJoueur(Joueur $joueur, string $famille): int
    {
        $pointsParFamille = 0;
        $domaineJoueur = $joueur->getDomaine();        
        $cartes = null;
        
        switch ($famille) {
            case 'Papillon':
                $cartes = $domaineJoueur->getPapillon();
                break;
            case 'Crapaud':         
                $cartes = $domaineJoueur->getCrapaud();
                break;
            case 'Rossignol':
                $cartes = $domaineJoueur->getRossignol();
            case 'Cerf':
                $cartes = $domaineJoueur->getCerf();
                break;
            case 'Lapin':
                $cartes = $domaineJoueur->getLapin();
                break;
            case 'Carpe':
                $cartes = $domaineJoueur->getCarpe();
                break;
        }
        foreach ($cartes as $carte) {
            if ($carte->getRole() === 'Noble') {
                $pointsParFamille += 2;
            } else {
                $pointsParFamille += 1;
            }
        }
        return $pointsParFamille;
    }

    // Méthode pour déterminer le gagnant de la partie
    public function gagnant(Partie $partie): ?Joueur
    {
        $gagnant = null;
        $pointsMax = -1;

        foreach ($partie->getJoueurs() as $joueur) {
            $points = $this->compterPoints($joueur);
            if ($points > $pointsMax) {
                $pointsMax = $points;
                $gagnant = $joueur;
            }
        }
        return $gagnant;
    }
}