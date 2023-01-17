<?php

namespace App\Entity;

use App\Repository\BcategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BcategorieRepository::class)]
class Bcategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'bcategories', targetEntity: Barticle::class)]
    private Collection $barticles;

    public function __construct()
    {
        $this->barticles = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Barticle>
     */
    public function getBarticles(): Collection
    {
        return $this->barticles;
    }

    public function addBarticle(Barticle $barticle): self
    {
        if (!$this->barticles->contains($barticle)) {
            $this->barticles->add($barticle);
            $barticle->setBcategories($this);
        }

        return $this;
    }

    public function removeBarticle(Barticle $barticle): self
    {
        if ($this->barticles->removeElement($barticle)) {
            // set the owning side to null (unless already changed)
            if ($barticle->getBcategories() === $this) {
                $barticle->setBcategories(null);
            }
        }

        return $this;
    }
}
