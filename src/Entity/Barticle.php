<?php

namespace App\Entity;

use App\Repository\BarticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarticleRepository::class)]
class Barticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    #[ORM\ManyToOne(inversedBy: 'barticles')]
    private ?Bcategorie $bcategories = null;

    #[ORM\OneToMany(mappedBy: 'barticles', targetEntity: Bcommentaire::class)]
    private Collection $bcommentaires;

    public function __construct()
    {
        $this->bcommentaires = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getBcategories(): ?Bcategorie
    {
        return $this->bcategories;
    }

    public function setBcategories(?Bcategorie $bcategories): self
    {
        $this->bcategories = $bcategories;

        return $this;
    }

    /**
     * @return Collection<int, Bcommentaire>
     */
    public function getBcommentaires(): Collection
    {
        return $this->bcommentaires;
    }

    public function addBcommentaire(Bcommentaire $bcommentaire): self
    {
        if (!$this->bcommentaires->contains($bcommentaire)) {
            $this->bcommentaires->add($bcommentaire);
            $bcommentaire->setBarticles($this);
        }

        return $this;
    }

    public function removeBcommentaire(Bcommentaire $bcommentaire): self
    {
        if ($this->bcommentaires->removeElement($bcommentaire)) {
            // set the owning side to null (unless already changed)
            if ($bcommentaire->getBarticles() === $this) {
                $bcommentaire->setBarticles(null);
            }
        }

        return $this;
    }
}
