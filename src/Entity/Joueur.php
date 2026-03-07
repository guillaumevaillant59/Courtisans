<?php

namespace App\Entity;

use App\Repository\JoueurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JoueurRepository::class)]
class Joueur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'joueurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'joueurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partie $partie = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], orphanRemoval: true)]
    private ?MainJoueur $main = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'], orphanRemoval: true)]
    private ?DomaineJoueur $domaine = null;

    #[ORM\ManyToOne]
    private ?MissionBlanche $missionBlanche = null;

    #[ORM\ManyToOne]
    private ?MissionBleue $missionBleue = null;

    #[ORM\Column(nullable: true)]
    private ?int $points = null;

    #[ORM\Column]
    private ?int $position = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getPartie(): ?Partie
    {
        return $this->partie;
    }

    public function setPartie(?Partie $partie): static
    {
        $this->partie = $partie;

        return $this;
    }

    public function getMain(): ?MainJoueur
    {
        return $this->main;
    }

    public function setMain(?MainJoueur $main): static
    {
        $this->main = $main;

        return $this;
    }

    public function getDomaine(): ?DomaineJoueur
    {
        return $this->domaine;
    }

    public function setDomaine(?DomaineJoueur $domaine): static
    {
        $this->domaine = $domaine;

        return $this;
    }

    public function getMissionBlanche(): ?MissionBlanche
    {
        return $this->missionBlanche;
    }

    public function setMissionBlanche(?MissionBlanche $missionBlanche): static
    {
        $this->missionBlanche = $missionBlanche;

        return $this;
    }

    public function getMissionBleue(): ?MissionBleue
    {
        return $this->missionBleue;
    }

    public function setMissionBleue(?MissionBleue $missionBleue): static
    {
        $this->missionBleue = $missionBleue;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): static
    {
        $this->points = $points;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

        return $this;
    }
}
