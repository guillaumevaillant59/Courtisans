<?php

namespace App\Service;

use App\Entity\Partie;
use App\Entity\DomaineReine;
use App\Entity\Carte;
use App\Entity\Lumiere;
use App\Entity\Disgrace;
use App\Entity\DomaineJoueur;
use App\Entity\Joueur;
use App\Entity\Utilisateur;
use App\Entity\MissionBlanche;
use App\Entity\MissionBleue;
use Doctrine\ORM\EntityManagerInterface;
use Repository\CarteRepository;

final class ServicePartie
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function ajouterCarteDansDomaineReine(Partie $partie, Carte $carte, Joueur $joueur, string $type): void
    {
        $domaineReine = $partie->getDomaineReine();
        if ($type === 'lumiere') {
            if ($carte->getRole() === 'Espion') {
                $domaineReine->getLumiere()->getEspion()->addEspion($carte);
            } else {
                switch ($carte->getFamille() && $carte->getRole()) {
                    case 'Papillon':
                        $domaineReine->getLumiere()->getPapillon()->addPapillon($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getLumiere()->getCrapaud()->addCrapaud($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getLumiere()->getRossignol()->addRossignol($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getLumiere()->getCerf()->addCerf($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getLumiere()->getLapin()->addLapin($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getLumiere()->getCarpe()->addCarpe($carte);
                        break;
                }
            }
            
        } elseif ($type === 'disgrace') {
            if ($carte->getRole() === 'Espion') {
                $domaineReine->getDisgrace()->getEspion()->addEspion($carte);
            } else {
                switch ($carte->getFamille() && $carte->getRole()) {
                    case 'Papillon':
                        $domaineReine->getDisgrace()->getPapillon()->addPapillon($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getDisgrace()->getCrapaud()->addCrapaud($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getDisgrace()->getRossignol()->addRossignol($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getDisgrace()->getCerf()->addCerf($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getDisgrace()->getLapin()->addLapin($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getDisgrace()->getCarpe()->addCarpe($carte);
                        break;
                }
            }            
        }

        $joueur->getMain()->removeCarte($carte);

        $this->entityManager->persist($joueur);
        $this->entityManager->persist($domaineReine);
        $this->entityManager->flush();
    }

    public function retirerCarteDuDomaineReine(Partie $partie, Carte $carte, string $type): void
    {
        $domaineReine = $partie->getDomaineReine();
        if ($type === 'lumiere') {
            // Retirer la carte du domaine de la lumière   
            if( $carte->getRole() === 'Espion') {
                $domaineReine->getLumiere()->getEspion()->removeEspion($carte);
            } else {
                switch ($carte->getFamille()) {
                    case 'Papillon':
                        $domaineReine->getLumiere()->getPapillon()->removePapillon($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getLumiere()->getCrapaud()->removeCrapaud($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getLumiere()->getRossignol()->removeRossignol($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getLumiere()->getCerf()->removeCerf($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getLumiere()->getLapin()->removeLapin($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getLumiere()->getCarpe()->removeCarpe($carte);
                        break;
                }
            }
           

        } elseif ($type === 'disgrace') {
            // Retirer la carte du domaine de la disgrâce
            if( $carte->getRole() === 'Espion') {
                $domaineReine->getDisgrace()->getEspion()->removeEspion($carte);
            } else {
                switch ($carte->getFamille()) {
                    case 'Papillon':
                        $domaineReine->getDisgrace()->getPapillon()->removePapillon($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getDisgrace()->getCrapaud()->removeCrapaud($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getDisgrace()->getRossignol()->removeRossignol($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getDisgrace()->getCerf()->removeCerf($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getDisgrace()->getLapin()->removeLapin($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getDisgrace()->getCarpe()->removeCarpe($carte);
                        break;
                }
            }
        }

        $this->entityManager->persist($domaineReine);
        $this->entityManager->flush();
    }

    public function ajouterCarteDansDomaineJoueur(Joueur $joueurAjoutant, Joueur $joueurRecevant, Carte $carte): void
    {
        if($carte->getRole() === 'Espion') {
            $joueurRecevant->getDomaineJoueur()->getEspion()->addEspion($carte);
        } else {
            switch ($carte->getFamille()) {
                case 'Papillon':
                    $joueurRecevant->getDomaineJoueur()->getPapillon()->addPapillon($carte);
                    break;
                
                case 'Crapaud':
                    $joueurRecevant->getDomaineJoueur()->getCrapaud()->addCrapaud($carte);
                    break;
                case 'Rossignol':
                    $joueurRecevant->getDomaineJoueur()->getRossignol()->addRossignol($carte);
                    break;
                case 'Cerf':
                    $joueurRecevant->getDomaineJoueur()->getCerf()->addCerf($carte);
                    break;
                case 'Lapin':
                    $joueurRecevant->getDomaineJoueur()->getLapin()->addLapin($carte);
                    break;
                case 'Carpe':
                    $joueurRecevant->getDomaineJoueur()->getCarpe()->addCarpe($carte);
                    break;
            }
        }

        $joueurAjoutant->getMain()->removeCarte($carte);

        $this->entityManager->persist($joueurAjoutant);
        $this->entityManager->persist($joueurRecevant);
        $this->entityManager->flush();
    }

    public function retirerCarteDuDomaineJoueur(Joueur $joueur, Carte $carte): void
    {
        if( $carte->getRole() === 'Espion') {
            $joueur->getDomaineJoueur()->getEspion()->removeEspion($carte);
        } else {
            switch ($carte->getFamille()) {
                case 'Papillon':
                    $joueur->getDomaineJoueur()->getPapillon()->removePapillon($carte);
                    break;
                
                case 'Crapaud':
                    $joueur->getDomaineJoueur()->getCrapaud()->removeCrapaud($carte);
                    break;
                case 'Rossignol':
                    $joueur->getDomaineJoueur()->getRossignol()->removeRossignol($carte);
                    break;
                case 'Cerf':
                    $joueur->getDomaineJoueur()->getCerf()->removeCerf($carte);
                    break;
                case 'Lapin':
                    $joueur->getDomaineJoueur()->getLapin()->removeLapin($carte);
                    break;
                case 'Carpe':
                    $joueur->getDomaineJoueur()->getCarpe()->removeCarpe($carte);
                    break;
            }
        }

        $this->entityManager->persist($joueur);
        $this->entityManager->flush();
    }


    public function piocher(Partie $partie, Joueur $joueur): ?Carte
    {
        $piocheArray = $partie->getPioche()->toArray();
        if (count($piocheArray) === 0) {
            return null; // La pioche est vide
            $this->terminerPartie($partie);
        }
        for ($i = 0; $i < 3; $i++) { 
            $index = array_rand($piocheArray);
            $carte = $piocheArray[$index];
            if ($carte) {
                $joueur->getMain()->add($carte);
                $partie->getPioche()->removeElement($carte);
            }
        }

        $this->entityManager->persist($joueur);
        $this->entityManager->persist($partie);
        $this->entityManager->flush();

        return $carte;
    }

    

    

}
