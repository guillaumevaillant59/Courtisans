<?php

namespace App\Service;

use App\Entity\Partie;
use App\Entity\Joueur;
use App\Repository\CarteRepository;
use Doctrine\ORM\EntityManagerInterface;
   

final class FinPartie
{
    private $entityManager;
    private $carteRepository;

    public function __construct(EntityManagerInterface $entityManager, CarteRepository $carteRepository)
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

    // Méhode pour identifier les familles en lumière à la fin de la partie
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

    // Méthode pour identifier les familles en disgrâce à la fin de la partie
    public function familleEnDisgrace(Partie $partie, string $famille): bool
    {        
        $domaineReine = $partie->getDomaineReine();
        $oui = true;
        switch ($famille) {
            case 'Papillon':
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Papillon') - $this->compterNombreParFamilleEnDisgrace($partie, 'Papillon') < 0;
                break;
            case 'Crapaud':         
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Crapaud') - $this->compterNombreParFamilleEnDisgrace($partie, 'Crapaud') < 0;
                break;
            case 'Rossignol':
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Rossignol') - $this->compterNombreParFamilleEnDisgrace($partie, 'Rossignol') < 0;
                break;
            case 'Cerf':
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Cerf') - $this->compterNombreParFamilleEnDisgrace($partie, 'Cerf') < 0;
                break;
            case 'Lapin':
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Lapin') - $this->compterNombreParFamilleEnDisgrace($partie, 'Lapin') < 0;
                break;
            case 'Carpe':
                $oui = $this->compterNombreParFamilleEnLumiere($partie, 'Carpe') - $this->compterNombreParFamilleEnDisgrace($partie, 'Carpe') < 0;
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
        $familles = ['Papillon', 'Crapaud', 'Rossignol', 'Cerf', 'Lapin', 'Carpe'];
        foreach ($familles as $famille) {
            if ($this->familleEnLumière($joueur->getPartie(), $famille)) {
                $points += $this->compterPointsParFamilleParJoueur($joueur, $famille);
            } else if ($this->familleEnDisgrace($joueur->getPartie(), $famille)) {
                $points -= $this->compterPointsParFamilleParJoueur($joueur, $famille);
            } else {
                $points += 0;   
            }
        }

        if ($this->validerMissionBlanche($joueur->getPartie(), $joueur)) {
            $points += 3;
        }
        if ($this->validerMissionBleue($joueur->getPartie(), $joueur)) {
            $points += 3;
        }

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

    // Méthode pour valider la mission blanche à la fin de la partie
    public function validerMissionBlanche(Partie $partie, Joueur $joueur): bool
    {
        $missionBlanche = $joueur->getMissionBlanche();
        $position = $joueur->getPosition();
        $numero = $missionBlanche->getNumero();
        $joueurGauche = null;
        if($position === 1) {
            $joueurGauche = $partie->getJoueurs()[$partie->getNombreJoueurMax()];
        } else {
            $joueurGauche = $partie->getJoueurs()[$position - 1];
        }
        switch ($numero) {
            case 1:
                if($joueurGauche->getDomaine()->getPapillon()->count() > $joueur->getDomaine()->getPapillon()->count()) {
                    return true;
                }
                return false;
            case 2:
                if($joueurGauche->getDomaine()->getCrapaud()->count() > $joueur->getDomaine()->getCrapaud()->count()) {
                    return true;
                }
                return false;
            case 3:
                if($joueurGauche->getDomaine()->getRossignol()->count() > $joueur->getDomaine()->getRossignol()->count()) {
                    return true;
                }
                return false;
            case 4:
                if($joueurGauche->getDomaine()->getCerf()->count() > $joueur->getDomaine()->getCerf()->count()) {
                    return true;  
                }
                return false;
            case 5:
                if($joueurGauche->getDomaine()->getLapin()->count() > $joueur->getDomaine()->getLapin()->count()) {
                    return true;
                }
                return false;
            case 6:
                if($joueurGauche->getDomaine()->getCarpe()->count() > $joueur->getDomaine()->getCarpe()->count()) {
                    return true;   
                }
                return false;
            case 7:
                if($this->compterNombreNoble($joueur) >= 3) {                   
                        return true;  
                }
                return false;
            case 8:
                if($this->compterNombreAssassin($joueur) >= 2) {                   
                        return true;  
                }
                return false;
            case 9:
                if($this->compterNombreProtecteur($joueur) >= 4) {                   
                        return true;  
                }
                return false;
            case 10:
                if($this->compterNombreEspion($joueur) >= 3) {                   
                        return true;    
                }
                return false;
            default:
                return false;
        }

    }

    // Méthode pour compter le nombre de cartes noble dans le domaine d'un joueur
    public function compterNombreNoble(Joueur $joueur): int
    {
        $nombreNoble = 0;
        $cartes = array_merge(
            $joueur->getDomaine()->getPapillon()->toArray(),
            $joueur->getDomaine()->getCrapaud()->toArray(),
            $joueur->getDomaine()->getRossignol()->toArray(),
            $joueur->getDomaine()->getCerf()->toArray(),
            $joueur->getDomaine()->getLapin()->toArray(),
            $joueur->getDomaine()->getCarpe()->toArray()
        );
        foreach ($cartes as $carte) {
            if ($carte->getRole() === 'Noble') {
                $nombreNoble++;
            }
        }
        return $nombreNoble;
    }

    // Méthode pour compter le nombre de cartes assassin dans le domaine d'un joueur
    public function compterNombreAssassin(Joueur $joueur): int
    {
        $nombreAssassin = 0;
        $cartes = array_merge(
            $joueur->getDomaine()->getPapillon()->toArray(),
            $joueur->getDomaine()->getCrapaud()->toArray(),
            $joueur->getDomaine()->getRossignol()->toArray(),       
            $joueur->getDomaine()->getCerf()->toArray(),
            $joueur->getDomaine()->getLapin()->toArray(),
            $joueur->getDomaine()->getCarpe()->toArray()
        );
        foreach ($cartes as $carte) {
            if ($carte->getRole() === 'Assassin') {
                $nombreAssassin++;
            }
        }
        return $nombreAssassin;
    }

    // Méthode pour compter le nombre de cartes protecteur dans le domaine d'un joueur
    public function compterNombreProtecteur(Joueur $joueur): int
    {
        $nombreProtecteur = 0;
        $cartes = array_merge(
            $joueur->getDomaine()->getPapillon()->toArray(),
            $joueur->getDomaine()->getCrapaud()->toArray(),         
            $joueur->getDomaine()->getRossignol()->toArray(),
            $joueur->getDomaine()->getCerf()->toArray(),
            $joueur->getDomaine()->getLapin()->toArray(),
            $joueur->getDomaine()->getCarpe()->toArray()
        );
        foreach ($cartes as $carte) {
            if ($carte->getRole() === 'Protecteur') {
                $nombreProtecteur++;
            }
        }
        return $nombreProtecteur;
    }   

    // Méthode pour compter le nombre de cartes espion dans le domaine d'un joueur
    public function compterNombreEspion(Joueur $joueur): int
    {
        $nombreEspion = 0;
        $cartes = array_merge(
            $joueur->getDomaine()->getPapillon()->toArray(),
            $joueur->getDomaine()->getCrapaud()->toArray(),
            $joueur->getDomaine()->getRossignol()->toArray(),
            $joueur->getDomaine()->getCerf()->toArray(),
            $joueur->getDomaine()->getLapin()->toArray(),
            $joueur->getDomaine()->getCarpe()->toArray()
        );
        foreach ($cartes as $carte) {
            if ($carte->getRole() === 'Espion') {
                $nombreEspion++;
            }
        }
        return $nombreEspion;
    }

    // Méthode pour valider la mission bleue à la fin de la partie
    public function validerMissionBleue(Partie $partie, Joueur $joueur): bool
    {
        $missionBleue = $joueur->getMissionBleue();
        $numero = $missionBleue->getNumero();
        switch ($numero) {
            case 1:
                if(!$this->familleEnLumière($partie, "Papillon")) {
                    return true;
                }
                return false;
            case 2:
                if(!$this->familleEnLumière($partie, "Crapaud")) {
                    return true;    
                }
                return false;
            case 3:
                if(!$this->familleEnLumière($partie, "Rossignol")) {
                    return true;    
                }
                return false;
            case 4:
                if(!$this->familleEnLumière($partie, "Cerf")) {
                    return true;    
                }
                return false;
            case 5:
                if(!$this->familleEnLumière($partie, "Lapin")) {
                    return true;    
                }
                return false;
            case 6:
                if(!$this->familleEnLumière($partie, "Carpe")) {
                    return true;    
                }
                return false;
            case 7:
                if($this->toutesFamillesCarteEnDisgrace($partie)) {
                    return true;    
                }
                return false;
            case 8:
                if($this->familleCinqCartesEnDisgrace($partie)) {
                    return true;    
                }
                return false;
            case 9:
                if($this->troisFamillesEnLumiere($partie)) {                   
                    return true;    
                }
                return false;
            case 10:                    
                if($this->deuxFamillesEnDisgrace($partie)) {
                    return true;
                }
                return false;
            default:
                return false;
        }
    }

    // Méthode pour vérifier si tous les familles sont en disgrace à la fin de la partie
    public function toutesFamillesCarteEnDisgrace(Partie $partie): bool
    {        $familles = ['Papillon', 'Crapaud', 'Rossignol', 'Cerf', 'Lapin', 'Carpe'];
        foreach ($familles as $famille) {
            if ($this->compterNombreParFamilleEnDisgrace($partie, $famille)>=1) {
                return true;
            }
        }
        return false;
    }

    // Méthode pour voir si une famille a 5 cartes ou plus en disgâce à la fin de la partie
    public function familleCinqCartesEnDisgrace(Partie $partie): bool
    {
        $familles = ['Papillon', 'Crapaud', 'Rossignol', 'Cerf', 'Lapin', 'Carpe'];
        foreach ($familles as $famille) {
            if ($this->compterNombreParFamilleEnDisgrace($partie, $famille) >= 5) {
                return true;
            }
        }
        return false;
    }
    
    // Méthode pour vérifier si 3 familles ou plus sont en lumière à la fin de la partie
    public function troisFamillesEnLumiere(Partie $partie): bool
    {        $familles = ['Papillon', 'Crapaud', 'Rossignol', 'Cerf', 'Lapin', 'Carpe'];
        $compteur = 0;
        foreach ($familles as $famille) {
            if ($this->familleEnLumière($partie, $famille)) {
                $compteur++;
            }
        }
        return $compteur >= 3;
    }

    // Méthode pour vérifier si 2 familles ou moins sont en disgrâce à la fin de la partie
    public function deuxFamillesEnDisgrace(Partie $partie): bool
    {        $familles = ['Papillon', 'Crapaud', 'Rossignol', 'Cerf', 'Lapin', 'Carpe'];
        $compteur = 0;
        foreach ($familles as $famille) {
            if (!$this->familleEnLumière($partie, $famille)) {
                $compteur++;
            }
        }
        return $compteur <= 2;
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