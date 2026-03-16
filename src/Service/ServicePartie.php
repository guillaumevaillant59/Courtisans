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

    // Méthode pour ajouter une carte dans le domaine de la reine (lumière ou disgrâce)
    public function ajouterCarteDansDomaineReine(Partie $partie, Carte $carte, Joueur $joueur, string $type): void
    {
        $domaineReine = $partie->getDomaineReine();
        if ($type === 'lumiere') {
            // Ajouter la carte dans le domaine de la lumière
            if ($carte->getRole() === 'Espion') {
                $domaineReine->getLumiere()->addEspions($carte);
            } else {
                switch ($carte->getFamille()) {
                    case 'Papillon':
                        $domaineReine->getLumiere()->addPapillons($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getLumiere()->addCrapauds($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getLumiere()->addRossignols($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getLumiere()->addCerfs($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getLumiere()->addLapins($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getLumiere()->addCarpes($carte);
                        break;
                }
            }
            
        } elseif ($type === 'disgrace') {
            // Ajouter la carte dans le domaine de la disgrâce
            if ($carte->getRole() === 'Espion') {
                $domaineReine->getDisgrace()->addEspions($carte);
            } else {
                switch ($carte->getFamille()) {
                    case 'Papillon':
                        $domaineReine->getDisgrace()->addPapillons($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getDisgrace()->addCrapauds($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getDisgrace()->addRossignols($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getDisgrace()->addCerfs($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getDisgrace()->addLapins($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getDisgrace()->addCarpes($carte);
                        break;
                }
            }            
        }
        
        // Retirer la carte de la main du joueur
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
                $domaineReine->getLumiere()->removeEspions($carte);
            } else {
                switch ($carte->getFamille()) {
                    case 'Papillon':
                        $domaineReine->getLumiere()->removePapillons($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getLumiere()->removeCrapauds($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getLumiere()->removeRossignols($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getLumiere()->removeCerfs($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getLumiere()->removeLapins($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getLumiere()->removeCarpes($carte);
                        break;
                }
            }
           

        } elseif ($type === 'disgrace') {
            // Retirer la carte du domaine de la disgrâce
            if( $carte->getRole() === 'Espion') {
                $domaineReine->getDisgrace()->removeEspions($carte);
            } else {
                switch ($carte->getFamille()) {
                    case 'Papillon':
                        $domaineReine->getDisgrace()->removePapillons($carte);
                        break;
                    
                    case 'Crapaud':
                        $domaineReine->getDisgrace()->removeCrapauds($carte);
                        break;
                    case 'Rossignol':
                        $domaineReine->getDisgrace()->removeRossignols($carte);
                        break;
                    case 'Cerf':
                        $domaineReine->getDisgrace()->removeCerfs($carte);
                        break;
                    case 'Lapin':
                        $domaineReine->getDisgrace()->removeLapins($carte);
                        break;
                    case 'Carpe':
                        $domaineReine->getDisgrace()->removeCarpes($carte);
                        break;
                }
            }
        }

        $this->entityManager->persist($domaineReine);
        $this->entityManager->flush();
    }

    // Méthode pour ajouter une carte dans le domaine d'un joueur
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

        // Retirer la carte de la main du joueur qui ajoute la carte
        $joueurAjoutant->getMain()->removeCarte($carte);

        $this->entityManager->persist($joueurAjoutant);
        $this->entityManager->persist($joueurRecevant);
        $this->entityManager->flush();
    }

    // Méthode pour retirer une carte du domaine d'un joueur
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

    // Méthode pour piocher une carte de la pioche de la partie
    public function piocher(Partie $partie, Joueur $joueur): ?Carte
    {
        $piocheArray = $partie->getPioche()->toArray();
        if (count($piocheArray) === 0) {
            // La pioche est vide — terminer la partie via le service dédié
            $this->finPartie->terminerPartie($partie);
            return null;
        } else {
            for ($i = 0; $i < 3; $i++) { 
                $index = array_rand($piocheArray);
                $carte = $piocheArray[$index];
                $joueur->getMain()->addCarte($carte);
                $partie->getPioche()->removeElement($carte);
                unset($piocheArray[$index]);                
            }
        }
        

        $this->entityManager->persist($joueur);
        $this->entityManager->persist($partie);
        $this->entityManager->flush();

        return $carte;
    }

    

    

}
