<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Carte;
use App\Entity\MissionBlanche;
use App\Entity\MissionBleue;
use \App\Entity\Utilisateur;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        for($i=0; $i<4; $i++){
            $carte1= new Carte();
            $carte1->setFamille("Papillon");
            $carte1->setRole(role: "Normal");
            $carte1->setpath("image/papillons/papillon_normal.jpg");
            $manager->persist($carte1);

            $carte2= new Carte();
            $carte2->setFamille("Papillon");
            $carte2->setRole("Noble");
            $carte2->setpath("image/papillons/papillon_noble.jpg");
            $manager->persist($carte2);

            $carte6= new Carte();
            $carte6->setFamille("Crapaud");
            $carte6->setRole("Normal");
            $carte6->setpath("image/crapauds/crapaud_normal.jpg");
            $manager->persist($carte6);

            $carte7= new Carte();
            $carte7->setFamille("Crapaud");
            $carte7->setRole("Noble");
            $carte7->setpath("image/crapauds/crapaud_noble.jpg");
            $manager->persist($carte7);

            $carte11= new Carte();
            $carte11->setFamille("Rossignol");
            $carte11->setRole("Normal");
            $carte11->setpath("image/rossignols/rossignol_normal.jpg");
            $manager->persist($carte11);

            $carte12= new Carte();
            $carte12->setFamille("Rossignol");
            $carte12->setRole("Noble");
            $carte12->setpath("image/rossignols/rossignol_noble.jpg");
            $manager->persist($carte12);

            $carte16= new Carte();
            $carte16->setFamille("Cerf");
            $carte16->setRole("Normal");
            $carte16->setpath("image/cerfs/cerf_normal.jpg");
            $manager->persist($carte16);

            $carte17= new Carte();
            $carte17->setFamille("Cerf");
            $carte17->setRole("Noble");
            $carte17->setpath("image/cerfs/cerf_noble.jpg");
            $manager->persist($carte17);

            $carte21= new Carte();
            $carte21->setFamille("Lapin");
            $carte21->setRole("Normal");
            $carte21->setpath("image/lapins/lapin_normal.jpg");
            $manager->persist($carte21);

            $carte22= new Carte();
            $carte22->setFamille("Lapin");
            $carte22->setRole("Noble");
            $carte22->setpath("image/lapins/lapin_noble.jpg");
            $manager->persist($carte22);

            $carte26= new Carte();
            $carte26->setFamille("Carpe");
            $carte26->setRole("Normal");
            $carte26->setpath("image/carpes/carpe_normal.jpg");
            $manager->persist($carte26);

            $carte27= new Carte();
            $carte27->setFamille("Carpe");
            $carte27->setRole("Noble");
            $carte27->setpath("image/carpes/carpe_noble.jpg");
            $manager->persist($carte27);
        }

        for($i=0; $i<3; $i++){
            $carte4= new Carte();
            $carte4->setFamille("Papillon");
            $carte4->setRole("Protecteur");
            $carte4->setpath("image/papillons/papillon_protecteur.jpg");
            $manager->persist($carte4);

            $carte9= new Carte();
            $carte9->setFamille("Crapaud");
            $carte9->setRole("Protecteur");
            $carte9->setpath("image/crapauds/crapaud_protecteur.jpg");
            $manager->persist($carte9);

            $carte14= new Carte();
            $carte14->setFamille("Rossignol");
            $carte14->setRole("Protecteur");
            $carte14->setpath("image/rossignols/rossignol_protecteur.jpg");
            $manager->persist($carte14);

            $carte19= new Carte();
            $carte19->setFamille("Cerf");
            $carte19->setRole("Protecteur");
            $carte19->setpath("image/cerfs/cerf_protecteur.jpg");
            $manager->persist($carte19);

            $carte24= new Carte();
            $carte24->setFamille("Lapin");
            $carte24->setRole("Protecteur");
            $carte24->setpath("image/lapins/lapin_protecteur.jpg");
            $manager->persist($carte24);

            $carte29= new Carte();
            $carte29->setFamille("Carpe");
            $carte29->setRole("Protecteur");
            $carte29->setpath("image/carpes/carpe_protecteur.jpg");
            $manager->persist($carte29);
        }

        for($i=0; $i<2; $i++){
            $carte3= new Carte();
            $carte3->setFamille("Papillon");
            $carte3->setRole("Assassin");
            $carte3->setpath("image/papillons/papillon_assassin.jpg");
            $manager->persist($carte3);
            
            $carte5= new Carte();
            $carte5->setFamille("Papillon");
            $carte5->setRole("Espion");
            $carte5->setpath("image/papillons/papillon_espion.jpg");
            $manager->persist($carte5);

            $carte8= new Carte();
            $carte8->setFamille("Crapaud");
            $carte8->setRole("Assassin");
            $carte8->setpath("image/crapauds/crapaud_assassin.jpg");
            $manager->persist($carte8);

            $carte10= new Carte();
            $carte10->setFamille("Crapaud");
            $carte10->setRole("Espion");
            $carte10->setpath("image/crapauds/crapaud_espion.jpg");
            $manager->persist($carte10);

            $carte13= new Carte();
            $carte13->setFamille("Rossignol");
            $carte13->setRole("Assassin");  
            $carte13->setpath("image/rossignols/rossignol_assassin.jpg");
            $manager->persist($carte13);

            $carte15= new Carte();
            $carte15->setFamille("Rossignol");
            $carte15->setRole("Espion");
            $carte15->setpath("image/rossignols/rossignol_espion.jpg");
            $manager->persist($carte15);

            $carte18= new Carte();
            $carte18->setFamille("Cerf");
            $carte18->setRole("Assassin");
            $carte18->setpath("image/cerfs/cerf_assassin.jpg");
            $manager->persist($carte18);

            $carte20= new Carte();
            $carte20->setFamille("Cerf");
            $carte20->setRole("Espion");
            $carte20->setpath("image/cerfs/cerf_espion.jpg");
            $manager->persist($carte20);

            $carte23= new Carte();
            $carte23->setFamille("Lapin");
            $carte23->setRole("Assassin");
            $carte23->setpath("image/lapins/lapin_assassin.jpg");
            $manager->persist($carte23);

            $carte25= new Carte();
            $carte25->setFamille("Lapin");
            $carte25->setRole("Espion");
            $carte25->setpath("image/lapins/lapin_espion.jpg");
            $manager->persist($carte25);

            $carte28= new Carte();
            $carte28->setFamille("Carpe");
            $carte28->setRole("Assassin");
            $carte28->setpath("image/carpes/carpe_assassin.jpg");
            $manager->persist($carte28);
            
            $carte30= new Carte();
            $carte30->setFamille("Carpe");
            $carte30->setRole("Espion");
            $carte30->setpath("image/carpes/carpe_espion.jpg");
            $manager->persist($carte30);        
        }   
        
        $missionBlanche1= new MissionBlanche();
        $missionBlanche1->setObjectif("Moins de papillon que le voisin de gauche");
        $missionBlanche1->setNumero(1);
        $missionBlanche1->setPath("image/missions_blanches/blanche_1.jpg");
        $missionBlanche2= new MissionBlanche();
        $missionBlanche2->setObjectif("Moins de crapaud que le voisin de gauche");
        $missionBlanche2->setNumero(2);
        $missionBlanche2->setPath("image/missions_blanches/blanche_2.jpg");
        $missionBlanche3= new MissionBlanche();
        $missionBlanche3->setObjectif("Moins de rossignol que le voisin de gauche");
        $missionBlanche3->setNumero(3);
        $missionBlanche3->setPath("image/missions_blanches/blanche_3.jpg");
        $missionBlanche4= new MissionBlanche();
        $missionBlanche4->setObjectif("Moins de cerf que le voisin de gauche");
        $missionBlanche4->setNumero(4);
        $missionBlanche4->setPath("image/missions_blanches/blanche_4.jpg");
        $missionBlanche5= new MissionBlanche();
        $missionBlanche5->setObjectif("Moins de lapin que le voisin de gauche");
        $missionBlanche5->setNumero(5);
        $missionBlanche5->setPath("image/missions_blanches/blanche_5.jpg");
        $missionBlanche6= new MissionBlanche();
        $missionBlanche6->setObjectif("Moins de carpe que le voisin de gauche");
        $missionBlanche6->setNumero(6);
        $missionBlanche6->setPath("image/missions_blanches/blanche_6.jpg");
        $missionBlanche7= new MissionBlanche();
        $missionBlanche7->setObjectif("Avoir au moins 3 noble");
        $missionBlanche7->setNumero(7);
        $missionBlanche7->setPath("image/missions_blanches/blanche_7.jpg");
        $missionBlanche8= new MissionBlanche();
        $missionBlanche8->setObjectif("Avoir au moins 2 assassin");
        $missionBlanche8->setNumero(8);
        $missionBlanche8->setPath("image/missions_blanches/blanche_8.jpg");
        $missionBlanche9= new MissionBlanche();
        $missionBlanche9->setObjectif("Avoir au moins 4 protecteur");
        $missionBlanche9->setNumero(9);
        $missionBlanche9->setPath("image/missions_blanches/blanche_9.jpg");
        $missionBlanche10= new MissionBlanche();
        $missionBlanche10->setObjectif("Avoir au moins 3 espion");
        $missionBlanche10->setNumero(10);
        $missionBlanche10->setPath("image/missions_blanches/blanche_10.jpg");
        $manager->persist($missionBlanche1);
        $manager->persist($missionBlanche2);
        $manager->persist($missionBlanche3);
        $manager->persist($missionBlanche4);
        $manager->persist($missionBlanche5);
        $manager->persist($missionBlanche6);
        $manager->persist($missionBlanche7);
        $manager->persist($missionBlanche8);
        $manager->persist($missionBlanche9);
        $manager->persist($missionBlanche10);

        $missionBleue1= new MissionBleue();
        $missionBleue1->setObjectif("La famille papillon est en disgrâce");
        $missionBleue1->setNumero(1);
        $missionBleue1->setPath("image/missions_bleues/bleue_1.jpg");
        $missionBleue2= new MissionBleue();
        $missionBleue2->setObjectif("La famille crapaud est en disgrâce");
        $missionBleue2->setNumero(2);
        $missionBleue2->setPath("image/missions_bleues/bleue_2.jpg");
        $missionBleue3= new MissionBleue();
        $missionBleue3->setObjectif("La famille rossignol est en disgrâce");
        $missionBleue3->setNumero(3);
        $missionBleue3->setPath("image/missions_bleues/bleue_3.jpg");
        $missionBleue4= new MissionBleue();
        $missionBleue4->setObjectif("La famille cerf est en disgrâce");
        $missionBleue4->setNumero(4);
        $missionBleue4->setPath("image/missions_bleues/bleue_4.jpg");
        $missionBleue5= new MissionBleue();
        $missionBleue5->setObjectif("La famille lapin est en disgrâce");
        $missionBleue5->setNumero(5);
        $missionBleue5->setPath("image/missions_bleues/bleue_5.jpg");
        $missionBleue6= new MissionBleue();
        $missionBleue6->setObjectif("La famille carpe est en disgrâce");
        $missionBleue6->setNumero(6);
        $missionBleue6->setPath("image/missions_bleues/bleue_6.jpg");
        $missionBleue7= new MissionBleue();
        $missionBleue7->setObjectif("Une carte de chaque famille doit être en disgrâce");
        $missionBleue7->setNumero(7);
        $missionBleue7->setPath("image/missions_bleues/bleue_7.jpg");
        $missionBleue8= new MissionBleue();
        $missionBleue8->setObjectif("Une famille doit avoir 5 cartes en disgrâce");
        $missionBleue8->setNumero(8);
        $missionBleue8->setPath("image/missions_bleues/bleue_8.jpg");
        $missionBleue9= new MissionBleue();
        $missionBleue9->setObjectif("3 familles maximum doivent être en lumière");
        $missionBleue9->setNumero(9);
        $missionBleue9->setPath("image/missions_bleues/bleue_9.jpg");
        $missionBleue10= new MissionBleue();
        $missionBleue10->setObjectif("2 famille minimum doivent être en disgrâce");
        $missionBleue10->setNumero(10);
        $missionBleue10->setPath("image/missions_bleues/bleue_10.jpg");
        $manager->persist($missionBleue1);
        $manager->persist($missionBleue2);
        $manager->persist($missionBleue3);  
        $manager->persist($missionBleue4);
        $manager->persist($missionBleue5);
        $manager->persist($missionBleue6);
        $manager->persist($missionBleue7);
        $manager->persist($missionBleue8);
        $manager->persist($missionBleue9);
        $manager->persist($missionBleue10);

        for($i=0; $i<5; $i++) {
            $utilisateur = new Utilisateur();
            $utilisateur->setPseudo("Test".$i);
            $utilisateur->setPassword($this->passwordHasher->hashPassword(
                $utilisateur,
                "mdp"
            ));
            $utilisateur->setEmail("test".$i."@example.com");
            $utilisateur->setRoles(["ROLE_USER"]);
            $manager->persist($utilisateur);
        }
       
        $manager->flush();
    }
}
