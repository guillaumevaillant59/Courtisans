<?php

namespace App\Entity;

use App\Repository\PartieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Regex;

#[ORM\Entity(repositoryClass: PartieRepository::class)]
class Partie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?DomaineReine $domaineReine = null;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    private Collection $pioche;

    /**
     * @var Collection<int, Joueur>
     */
    #[ORM\OneToMany(targetEntity: Joueur::class, mappedBy: 'partie', cascade: ['persist', 'remove'])]
    #[ORM\OrderBy(['id' => 'ASC'])]
    private Collection $joueurs;

    #[ORM\Column]     
    private ?int $nombreJoueurMax = null;

    #[ORM\Column(length: 10)]
    private ?string $Status = null;

    public function __construct()
    {
        $this->pioche = new ArrayCollection();
        $this->joueurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomaineReine(): ?DomaineReine
    {
        return $this->domaineReine;
    }

    public function setDomaineReine(?DomaineReine $domaineReine): static
    {
        $this->domaineReine = $domaineReine;

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getPioche(): Collection
    {
        return $this->pioche;
    }

    public function addPioche(Carte $pioche): static
    {
        if (!$this->pioche->contains($pioche)) {
            $this->pioche->add($pioche);
        }

        return $this;
    }

    public function removePioche(Carte $pioche): static
    {
        $this->pioche->removeElement($pioche);

        return $this;
    }

    /**
     * @return Collection<int, Joueur>
     */
    public function getJoueurs(): Collection
    {
        return $this->joueurs;
    }

    public function addJoueur(Joueur $joueur): static
    {
        if (!$this->joueurs->contains($joueur)) {
            $this->joueurs->add($joueur);
            $joueur->setPartie($this);
        }

        return $this;
    }

    public function removeJoueur(Joueur $joueur): static
    {
        if ($this->joueurs->removeElement($joueur)) {
            // set the owning side to null (unless already changed)
            if ($joueur->getPartie() === $this) {
                $joueur->setPartie(null);
            }
        }

        return $this;
    }

    public function getNombreJoueurMax(): ?int
    {
        return $this->nombreJoueurMax;
    }

    public function setNombreJoueurMax(int $nombreJoueurMax): static
    {
        $this->nombreJoueurMax = $nombreJoueurMax;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): static
    {
        $this->Status = $Status;

        return $this;
    }
}
