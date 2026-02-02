<?php

namespace App\Entity;

use App\Repository\CarteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarteRepository::class)]
class Carte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $famille = null;

    #[ORM\Column(length: 30)]
    private ?string $role = null;

    /**
     * @var Collection<int, Lumiere>
     */
    #[ORM\ManyToMany(targetEntity: Lumiere::class, mappedBy: 'cartes')]
    private Collection $lumieres;

    /**
     * @var Collection<int, Disgrace>
     */
    #[ORM\ManyToMany(targetEntity: Disgrace::class, mappedBy: 'cartes')]
    private Collection $disgraces;

    /**
     * @var Collection<int, DomaineJoueur>
     */
    #[ORM\ManyToMany(targetEntity: DomaineJoueur::class, mappedBy: 'cartes')]
    private Collection $domaineJoueurs;

    /**
     * @var Collection<int, MainJoueur>
     */
    #[ORM\ManyToMany(targetEntity: MainJoueur::class, mappedBy: 'cartes')]
    private Collection $mainJoueurs;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    public function __construct()
    {
        $this->lumieres = new ArrayCollection();
        $this->disgraces = new ArrayCollection();
        $this->domaineJoueurs = new ArrayCollection();
        $this->mainJoueurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(string $famille): static
    {
        $this->famille = $famille;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return Collection<int, Lumiere>
     */
    public function getLumieres(): Collection
    {
        return $this->lumieres;
    }

    public function addLumiere(Lumiere $lumiere): static
    {
        if (!$this->lumieres->contains($lumiere)) {
            $this->lumieres->add($lumiere);
            $lumiere->addCarte($this);
        }

        return $this;
    }

    public function removeLumiere(Lumiere $lumiere): static
    {
        if ($this->lumieres->removeElement($lumiere)) {
            $lumiere->removeCarte($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Disgrace>
     */
    public function getDisgraces(): Collection
    {
        return $this->disgraces;
    }

    public function addDisgrace(Disgrace $disgrace): static
    {
        if (!$this->disgraces->contains($disgrace)) {
            $this->disgraces->add($disgrace);
            $disgrace->addCarte($this);
        }

        return $this;
    }

    public function removeDisgrace(Disgrace $disgrace): static
    {
        if ($this->disgraces->removeElement($disgrace)) {
            $disgrace->removeCarte($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, DomaineJoueur>
     */
    public function getDomaineJoueurs(): Collection
    {
        return $this->domaineJoueurs;
    }

    public function addDomaineJoueur(DomaineJoueur $domaineJoueur): static
    {
        if (!$this->domaineJoueurs->contains($domaineJoueur)) {
            $this->domaineJoueurs->add($domaineJoueur);
            $domaineJoueur->addCarte($this);
        }

        return $this;
    }

    public function removeDomaineJoueur(DomaineJoueur $domaineJoueur): static
    {
        if ($this->domaineJoueurs->removeElement($domaineJoueur)) {
            $domaineJoueur->removeCarte($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, MainJoueur>
     */
    public function getMainJoueurs(): Collection
    {
        return $this->mainJoueurs;
    }

    public function addMainJoueur(MainJoueur $mainJoueur): static
    {
        if (!$this->mainJoueurs->contains($mainJoueur)) {
            $this->mainJoueurs->add($mainJoueur);
            $mainJoueur->addCarte($this);
        }

        return $this;
    }

    public function removeMainJoueur(MainJoueur $mainJoueur): static
    {
        if ($this->mainJoueurs->removeElement($mainJoueur)) {
            $mainJoueur->removeCarte($this);
        }

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }
}
