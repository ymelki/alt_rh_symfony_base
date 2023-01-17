<?php

namespace App\Entity;

use App\Repository\BcommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BcommentaireRepository::class)]
class Bcommentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'bcommentaires')]
    private ?Barticle $barticles = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBarticles(): ?Barticle
    {
        return $this->barticles;
    }
    public function __toString()
    {
        return $this->id;
    }

    public function setBarticles(?Barticle $barticles): self
    {
        $this->barticles = $barticles;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }
}
