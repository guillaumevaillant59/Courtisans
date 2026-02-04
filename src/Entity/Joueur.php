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

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?MainJoueur $main = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?DomaineJoueur $domaine = null;

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
}
