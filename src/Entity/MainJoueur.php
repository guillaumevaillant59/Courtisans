<?php

namespace App\Entity;

use App\Repository\MainJoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MainJoueurRepository::class)]
class MainJoueur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class, inversedBy: 'mainJoueurs')]
    private Collection $cartes;

    #[ORM\Column]
    private ?bool $jouerReine = false;

    #[ORM\Column]
    private ?bool $jouerAdverse = false;

    #[ORM\Column]
    private ?bool $jouerSoi = false;

    public function __construct()
    {
        $this->cartes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getCartes(): Collection
    {
        return $this->cartes;
    }

    public function addCarte(Carte $carte): static
    {
        if (!$this->cartes->contains($carte)) {
            $this->cartes->add($carte);
        }

        return $this;
    }

    public function removeCarte(Carte $carte): static
    {
        $this->cartes->removeElement($carte);

        return $this;
    }

    public function isJouerReine(): ?bool
    {
        return $this->jouerReine;
    }

    public function setJouerReine(bool $jouerReine): static
    {
        $this->jouerReine = $jouerReine;

        return $this;
    }

    public function isJouerAdverse(): ?bool
    {
        return $this->jouerAdverse;
    }

    public function setJouerAdverse(bool $jouerAdverse): static
    {
        $this->jouerAdverse = $jouerAdverse;

        return $this;
    }

    public function isJouerSoi(): ?bool
    {
        return $this->jouerSoi;
    }

    public function setJouerSoi(bool $jouerSoi): static
    {
        $this->jouerSoi = $jouerSoi;

        return $this;
    }
}
