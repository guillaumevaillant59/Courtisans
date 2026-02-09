<?php

namespace App\Service;

use App\Entity\Partie;
use App\Entity\Joueur;
use App\Entity\Carte;
use App\Entity\DomaineReine;
use App\Entity\Lumiere;
use App\Entity\Disgrace;
use App\Entity\DomaineJoueur;
use App\Entity\Utilisateur;
use App\Entity\MissionBlanche;
use App\Entity\MissionBleue;
use App\Repository\CarteRepository;
use Doctrine\ORM\EntityManagerInterface;    

final class FinPartie
{
    private $entityManager;
    private $carteRepository;

    public function terminerPartie(Partie $partie): void
    {
            $partie->setStatus('terminée');
            $this->placerEspionDansFamille($partie);
            $this->entityManager->persist($partie);
            $this->entityManager->flush();
    }

    public function placerEspionDansFamille(Partie $partie): void
    {
        $domaineReine = $partie->getDomaineReine();
        $espionsLumiere = $domaineReine->getLumiere()->getEspion();
        foreach ($espionsLumiere as $espion) {
            $domaineReine->getLumiere()->getEspion()->removeEspion($espion);
            if ($espion->getFamille() === 'Papillon') {
                $domaineReine->getLumiere()->getPapillon()->addPapillon($espion);
            } elseif ($espion->getFamille() === 'Crapaud') {
                $domaineReine->getLumiere()->getCrapaud()->addCrapaud($espion);
            } elseif ($espion->getFamille() === 'Rossignol') {
                $domaineReine->getLumiere()->getRossignol()->addRossignol($espion);
            } elseif ($espion->getFamille() === 'Cerf') {
                $domaineReine->getLumiere()->getCerf()->addCerf($espion);
            } elseif ($espion->getFamille() === 'Lapin') {
                $domaineReine->getLumiere()->getLapin()->addLapin($espion);
            } elseif ($espion->getFamille() === 'Carpe') {
                $domaineReine->getLumiere()->getCarpe()->addCarpe($espion);
            }
        }

        $espionsDisgrace = $domaineReine->getDisgrace()->getEspion();
        foreach ($espionsDisgrace as $espion) {
            $domaineReine->getDisgrace()->getEspion()->removeEspion($espion);
            if ($espion->getFamille() === 'Papillon') {
                $domaineReine->getDisgrace()->getPapillon()->addPapillon($espion);
            } elseif ($espion->getFamille() === 'Crapaud') {
                $domaineReine->getDisgrace()->getCrapaud()->addCrapaud($espion);
            } elseif ($espion->getFamille() === 'Rossignol') {
                $domaineReine->getDisgrace()->getRossignol()->addRossignol($espion);
            } elseif ($espion->getFamille() === 'Cerf') {
                $domaineReine->getDisgrace()->getCerf()->addCerf($espion);
            } elseif ($espion->getFamille() === 'Lapin') {
                $domaineReine->getDisgrace()->getLapin()->addLapin($espion);
            } elseif ($espion->getFamille() === 'Carpe') {
                $domaineReine->getDisgrace()->getCarpe()->addCarpe($espion);
            }
        }

        $joueurs = $partie->getJoueurs();
        foreach ($joueurs as $joueur) {
            $espionsDomaineJoueur = $joueur->getDomaineJoueur()->getEspion();
            foreach ($espionsDomaineJoueur as $espion) {
                $joueur->getDomaineJoueur()->getEspion()->removeEspion($espion);
                if ($espion->getFamille() === 'Papillon') {
                    $joueur->getDomaineJoueur()->getPapillon()->addPapillon($espion);
                } elseif ($espion->getFamille() === 'Crapaud')  {
                    $joueur->getDomaineJoueur()->getCrapaud()->addCrapaud($espion);
                } elseif ($espion->getFamille() === 'Rossignol') {
                    $joueur->getDomaineJoueur()->getRossignol()->addRossignol($espion);
                } elseif ($espion->getFamille() === 'Cerf') {
                    $joueur->getDomaineJoueur()->getCerf()->addCerf($espion);
                } elseif ($espion->getFamille() === 'Lapin') {
                    $joueur->getDomaineJoueur()->getLapin()->addLapin($espion);
                } elseif ($espion->getFamille() === 'Carpe') {
                    $joueur->getDomaineJoueur()->getCarpe()->addCarpe($espion);
                }
            }
            $this->entityManager->persist($joueur->getDomaineJoueur());
        }   
        $this->entityManager->persist($domaineReine);
        $this->entityManager->flush();
    }

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

    public function compterPointsParFamilleParJoueur(Joueur $joueur, string $famille): int
    {
        $pointsParFamille = 0;
        $domaineJoueur = $joueur->getDomaineJoueur();        
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