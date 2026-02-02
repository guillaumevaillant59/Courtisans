<?php

namespace App\Entity;

use App\Repository\MissionBleueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionBleueRepository::class)]
class MissionBleue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Objectif = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjectif(): ?string
    {
        return $this->Objectif;
    }

    public function setObjectif(string $Objectif): static
    {
        $this->Objectif = $Objectif;

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
