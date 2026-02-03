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
    #[ORM\JoinColumn(nullable: false)]
    private ?Lumiere $lumiere = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Disgrace $disgrace = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLumiere(): ?Lumiere
    {
        return $this->lumiere;
    }

    public function setLumiere(Lumiere $lumiere): static
    {
        $this->lumiere = $lumiere;

        return $this;
    }

    public function getDisgrace(): ?Disgrace
    {
        return $this->disgrace;
    }

    public function setDisgrace(Disgrace $disgrace): static
    {
        $this->disgrace = $disgrace;

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
