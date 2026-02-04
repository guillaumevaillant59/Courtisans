<?php

namespace App\Service;

use App\Entity\Partie;
use App\Entity\DomaineReine;
use App\Entity\Carte;
use App\Entity\Lumiere;
use App\Entity\Disgrace;
use Doctrine\ORM\EntityManagerInterface;
use Repository\CarteRepository;

final class ServicePartie
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function creerPartie(int $nombreJoueurMax): Partie
    {
        $partie = new Partie();
        $partie->setNombreJoueurMax($nombreJoueurMax);

        $domaineReine = $this->creerDomaineReine();
        $partie->setDomaineReine($domaineReine);
     
        $this->creerPioche($partie, $this->entityManager->getRepository(Carte::class), $this->entityManager);
      
        $this->entityManager->persist($partie);
        $this->entityManager->flush();

        return $partie;
    }

    private function creerPioche(
        Partie $partie,
        CarteRepository $carteRepository,
        EntityManagerInterface $entityManager
    ): void {
        for($i=0; $i<4; $i++) {
            $carte = $carteRepository->find(1);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(2);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(6);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(7);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(11);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(12);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(16);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(17);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(21);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(22);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(26);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(27);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
        }
        for($j=0; $j<3; $j++) {
            $carte = $carteRepository->find(4);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(9);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(14);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(19);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(24);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(29);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
        }
        for($k=0; $k<2; $k++) {
            $carte = $carteRepository->find(3);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(5);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(8);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(10);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(13);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(15);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(18);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(20);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(23);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(25);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(28);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
            $carte = $carteRepository->find(30);
            if ($carte) {
                $partie->getPioche()->add($carte);
            }
        }
        $entityManager->persist($partie);
        $entityManager->flush();
    }

    private function creerDomaineReine(): DomaineReine
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

    public function ajouterJoueur(Partie $partie, Utilisateur $utilisateur): void
    {
        $joueur = new Joueur();
        $joueur->setUtilisateur($utilisateur);
        $joueur->setPartie($partie);
        if (!$partie->getJoueurs()->contains($joueur) && $partie->getJoueurs()->count() < $partie->getNombreJoueurMax()) {
            $partie->addJoueur($joueur);
        }
              
        $this->entityManager->persist($joueur);
        $this->entityManager->persist($partie);
        $this->entityManager->flush();
    }

    public function commencerPartie(Partie $partie): void
    {
        // Commencement de la partie : distribution des cartes aux joueurs.
        foreach ($partie->getJoueurs() as $joueur) {
            // Distribuer des cartes au joueur. 
            $this->piocher($partie, $joueur);
        }
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
