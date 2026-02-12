<?php

namespace App\Service;

use App\Entity\Partie;
use App\Entity\DomaineReine;
use App\Entity\Carte;
use App\Entity\Lumiere;
use App\Entity\Disgrace;
use App\Entity\DomaineJoueur;
use App\Entity\Joueur;

use Doctrine\ORM\EntityManagerInterface;

final class ServicePartie
{
    private EntityManagerInterface $entityManager;
    private FinPartie $finPartie;
    
    public function __construct(EntityManagerInterface $entityManager, FinPartie $finPartie)
    {
        $this->entityManager = $entityManager;
        $this->finPartie = $finPartie;
    }

    public function ajouterCarteDansDomaineReine(Partie $partie, Carte $carte, Joueur $joueur, string $type): void
    {
        $domaineReine = $partie->getDomaineReine();
        if ($type === 'lumiere') {
            if ($carte->getRole() === 'Espion') {
                $domaineReine->getLumiere()->addEspion($carte);
            } else {
                switch ($carte->getFamille()) {
                    case 'Papillon':
                        $domaineReine->getLumiere()->addPapillon($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getLumiere()->addCrapaud($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getLumiere()->addRossignol($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getLumiere()->addCerf($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getLumiere()->addLapin($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getLumiere()->addCarpe($carte);
                        break;
                }
            }
            
        } elseif ($type === 'disgrace') {
            if ($carte->getRole() === 'Espion') {
                $domaineReine->getDisgrace()->addEspion($carte);
            } else {
                switch ($carte->getFamille()) {
                    case 'Papillon':
                        $domaineReine->getDisgrace()->addPapillon($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getDisgrace()->addCrapaud($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getDisgrace()->addRossignol($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getDisgrace()->addCerf($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getDisgrace()->addLapin($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getDisgrace()->addCarpe($carte);
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
                $domaineReine->getLumiere()->removeEspion($carte);
            } else {
                switch ($carte->getFamille()) {
                    case 'Papillon':
                        $domaineReine->getLumiere()->removePapillon($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getLumiere()->removeCrapaud($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getLumiere()->removeRossignol($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getLumiere()->removeCerf($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getLumiere()->removeLapin($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getLumiere()->removeCarpe($carte);
                        break;
                }
            }
           

        } elseif ($type === 'disgrace') {
            // Retirer la carte du domaine de la disgrâce
            if( $carte->getRole() === 'Espion') {
                $domaineReine->getDisgrace()->removeEspion($carte);
            } else {
                switch ($carte->getFamille()) {
                    case 'Papillon':
                        $domaineReine->getDisgrace()->removePapillon($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getDisgrace()->removeCrapaud($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getDisgrace()->removeRossignol($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getDisgrace()->removeCerf($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getDisgrace()->removeLapin($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getDisgrace()->removeCarpe($carte);
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
            $joueurRecevant->getDomaine()->addEspion($carte);
        } else {
            switch ($carte->getFamille()) {
                case 'Papillon':
                    $joueurRecevant->getDomaine()->addPapillon($carte);
                    break;
                
                case 'Crapaud':
                    $joueurRecevant->getDomaine()->addCrapaud($carte);
                    break;
                case 'Rossignol':
                    $joueurRecevant->getDomaine()->addRossignol($carte);
                    break;
                case 'Cerf':
                    $joueurRecevant->getDomaine()->addCerf($carte);
                    break;
                case 'Lapin':
                    $joueurRecevant->getDomaine()->addLapin($carte);
                    break;
                case 'Carpe':
                    $joueurRecevant->getDomaine()->addCarpe($carte);
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
            $joueur->getDomaine()->removeEspion($carte);
        } else {
            switch ($carte->getFamille()) {
                case 'Papillon':
                    $joueur->getDomaine()->removePapillon($carte);
                    break;
                
                case 'Crapaud':
                    $joueur->getDomaine()->removeCrapaud($carte);
                    break;
                case 'Rossignol':
                    $joueur->getDomaine()->removeRossignol($carte);
                    break;
                case 'Cerf':
                    $joueur->getDomaine()->removeCerf($carte);
                    break;
                case 'Lapin':
                    $joueur->getDomaine()->removeLapin($carte);
                    break;
                case 'Carpe':
                    $joueur->getDomaine()->removeCarpe($carte);
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
            // La pioche est vide — terminer la partie via le service dédié
            $this->finPartie->terminerPartie($partie);
            return null;
        }
        for ($i = 0; $i < 3; $i++) { 
            $index = array_rand($piocheArray);
            $carte = $piocheArray[$index];
            if ($carte) {
                $joueur->getMain()->addCarte($carte);
                $partie->getPioche()->removeElement($carte);
            }
        }

        $this->entityManager->persist($joueur);
        $this->entityManager->persist($partie);
        $this->entityManager->flush();

        return $carte;
    }

    

    

}
