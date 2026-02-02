<?php

namespace App\Entity;

use App\Repository\LumiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LumiereRepository::class)]
class Lumiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\ManyToMany(targetEntity: Carte::class, inversedBy: 'lumieres')]
    private Collection $cartes;

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
}
