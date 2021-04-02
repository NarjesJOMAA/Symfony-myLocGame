<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Biens::class, mappedBy="categories")
     */
    private $bien;

    public function __construct()
    {
        $this->bien = new ArrayCollection();
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
     * @return Collection|Biens[]
     */
    public function getBien(): Collection
    {
        return $this->bien;
    }

    public function addBien(Biens $bien): self
    {
        if (!$this->bien->contains($bien)) {
            $this->bien[] = $bien;
            $bien->setCategories($this);
        }

        return $this;
    }

    public function removeBien(Biens $bien): self
    {
        if ($this->bien->removeElement($bien)) {
            // set the owning side to null (unless already changed)
            if ($bien->getCategories() === $this) {
                $bien->setCategories(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->nom;
    }
}
