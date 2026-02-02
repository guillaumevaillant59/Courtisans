<?php

namespace App\Entity;

use App\Repository\DomaineReineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DomaineReineRepository::class)]
class DomaineReine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Lumiere $lumiere = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Disgrace $disgrace = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLumiere(): ?Lumiere
    {
        return $this->lumiere;
    }

    public function setLumiere(?Lumiere $lumiere): static
    {
        $this->lumiere = $lumiere;

        return $this;
    }

    public function getDisgrace(): ?Disgrace
    {
        return $this->disgrace;
    }

    public function setDisgrace(?Disgrace $disgrace): static
    {
        $this->disgrace = $disgrace;

        return $this;
    }
}
