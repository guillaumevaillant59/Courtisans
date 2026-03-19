<?php

namespace App\Entity;

use App\Repository\DomaineJoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DomaineJoueurRepository::class)]
class DomaineJoueur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    #[ORM\JoinTable(name: 'domainejoueur_papillon')]
    private Collection $papillons;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    #[ORM\JoinTable(name: 'domainejoueur_crapaud')]
    private Collection $crapauds;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    #[ORM\JoinTable(name: 'domainejoueur_rossignol')]
    private Collection $rossignols;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    #[ORM\JoinTable(name: 'domainejoueur_cerf')]
    private Collection $cerfs;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    #[ORM\JoinTable(name: 'domainejoueur_lapin')]
    private Collection $lapins;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    #[ORM\JoinTable(name: 'domainejoueur_carpe')]
    private Collection $carpes;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class)]
    #[ORM\JoinTable(name: 'domainejoueur_espion')]
    private Collection $espions;

    public function __construct()
    {
        $this->papillons = new ArrayCollection();
        $this->crapauds = new ArrayCollection();
        $this->rossignols = new ArrayCollection();
        $this->cerfs = new ArrayCollection();
        $this->lapins = new ArrayCollection();
        $this->carpes = new ArrayCollection();
        $this->espions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getPapillons(): Collection
    {
        return $this->papillons;
    }

    public function addPapillons(Carte $papillon): static
    {
        if (!$this->papillons->contains($papillon)) {
            $this->papillons->add($papillon);
        }

        return $this;
    }

    public function removePapillons(Carte $papillon): static
    {
        $this->papillons->removeElement($papillon);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getCrapauds(): Collection
    {
        return $this->crapauds;
    }

    public function addCrapauds(Carte $crapaud): static
    {
        if (!$this->crapauds->contains($crapaud)) {
            $this->crapauds->add($crapaud);
        }

        return $this;
    }

    public function removeCrapauds(Carte $crapaud): static
    {
        $this->crapauds->removeElement($crapaud);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getRossignols(): Collection
    {
        return $this->rossignols;
    }

    public function addRossignols(Carte $rossignol): static
    {
        if (!$this->rossignols->contains($rossignol)) {
            $this->rossignols->add($rossignol);
        }

        return $this;
    }

    public function removeRossignols(Carte $rossignol): static
    {
        $this->rossignols->removeElement($rossignol);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getCerfs(): Collection
    {
        return $this->cerfs;
    }

    public function addCerfs(Carte $cerf): static
    {
        if (!$this->cerfs->contains($cerf)) {
            $this->cerfs->add($cerf);
        }

        return $this;
    }

    public function removeCerfs(Carte $cerf): static
    {
        $this->cerfs->removeElement($cerf);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getLapins(): Collection
    {
        return $this->lapins;
    }

    public function addLapins(Carte $lapin): static
    {
        if (!$this->lapins->contains($lapin)) {
            $this->lapins->add($lapin);
        }

        return $this;
    }

    public function removeLapins(Carte $lapin): static
    {
        $this->lapins->removeElement($lapin);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getCarpes(): Collection
    {
        return $this->carpes;
    }

    public function addCarpes(Carte $carpe): static
    {
        if (!$this->carpes->contains($carpe)) {
            $this->carpes->add($carpe);
        }

        return $this;
    }

    public function removeCarpes(Carte $carpe): static
    {
        $this->carpes->removeElement($carpe);

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getEspions(): Collection
    {
        return $this->espions;
    }

    public function addEspions(Carte $espion): static
    {
        if (!$this->espions->contains($espion)) {
            $this->espions->add($espion);
        }

        return $this;
    }

    public function removeEspions(Carte $espion): static
    {
        $this->espions->removeElement($espion);

        return $this;
    }
}
