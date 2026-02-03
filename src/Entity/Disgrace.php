<?php

namespace App\Entity;

use App\Repository\DisgraceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisgraceRepository::class)]
class Disgrace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    private Collection $papillon;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    private Collection $crapaud;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    private Collection $rossignol;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    private Collection $espion;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    private Collection $cerf;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    private Collection $lapin;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    private Collection $carpe;

    public function __construct()
    {
        $this->papillon = new ArrayCollection();
        $this->crapaud = new ArrayCollection();
        $this->rossignol = new ArrayCollection();
        $this->espion = new ArrayCollection();
        $this->cerf = new ArrayCollection();
        $this->lapin = new ArrayCollection();
        $this->carpe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getPapillon(): Collection
    {
        return $this->papillon;
    }

    public function addPapillon(Carte $papillon): static
    {
        if (!$this->papillon->contains($papillon)) {
            $this->papillon->add($papillon);
        }

        return $this;
    }

    public function removePapillon(Carte $papillon): static
    {
        $this->papillon->removeElement($papillon);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getCrapaud(): Collection
    {
        return $this->crapaud;
    }

    public function addCrapaud(Carte $crapaud): static
    {
        if (!$this->crapaud->contains($crapaud)) {
            $this->crapaud->add($crapaud);
        }

        return $this;
    }

    public function removeCrapaud(Carte $crapaud): static
    {
        $this->crapaud->removeElement($crapaud);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getRossignol(): Collection
    {
        return $this->rossignol;
    }

    public function addRossignol(Carte $rossignol): static
    {
        if (!$this->rossignol->contains($rossignol)) {
            $this->rossignol->add($rossignol);
        }

        return $this;
    }

    public function removeRossignol(Carte $rossignol): static
    {
        $this->rossignol->removeElement($rossignol);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getEspion(): Collection
    {
        return $this->espion;
    }

    public function addEspion(Carte $espion): static
    {
        if (!$this->espion->contains($espion)) {
            $this->espion->add($espion);
        }

        return $this;
    }

    public function removeEspion(Carte $espion): static
    {
        $this->espion->removeElement($espion);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getCerf(): Collection
    {
        return $this->cerf;
    }

    public function addCerf(Carte $cerf): static
    {
        if (!$this->cerf->contains($cerf)) {
            $this->cerf->add($cerf);
        }

        return $this;
    }

    public function removeCerf(Carte $cerf): static
    {
        $this->cerf->removeElement($cerf);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getLapin(): Collection
    {
        return $this->lapin;
    }

    public function addLapin(Carte $lapin): static
    {
        if (!$this->lapin->contains($lapin)) {
            $this->lapin->add($lapin);
        }

        return $this;
    }

    public function removeLapin(Carte $lapin): static
    {
        $this->lapin->removeElement($lapin);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getCarpe(): Collection
    {
        return $this->carpe;
    }

    public function addCarpe(Carte $carpe): static
    {
        if (!$this->carpe->contains($carpe)) {
            $this->carpe->add($carpe);
        }

        return $this;
    }

    public function removeCarpe(Carte $carpe): static
    {
        $this->carpe->removeElement($carpe);

        return $this;
    }
}
