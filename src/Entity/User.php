<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *  fields={"mail"},
 *  message="Cette adresse mail est déjà utilisée."
 * )
 */
class User implements UserInterface
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
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $points;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=Biens::class, mappedBy="proprietaire")
     */
    private $bien;

    /**
     * @ORM\OneToMany(targetEntity=Prets::class, mappedBy="emprunteur")
     */
    private $prets;

    public function __construct()
    {
        $this->bien = new ArrayCollection();
        $this->prets = new ArrayCollection();
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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;

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
            $bien->setProprietaire($this);
        }

        return $this;
    }

    public function removeBien(Biens $bien): self
    {
        if ($this->bien->removeElement($bien)) {
            // set the owning side to null (unless already changed)
            if ($bien->getProprietaire() === $this) {
                $bien->setProprietaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Prets[]
     */
    public function getPrets(): Collection
    {
        return $this->prets;
    }

    public function addPret(Prets $pret): self
    {
        if (!$this->prets->contains($pret)) {
            $this->prets[] = $pret;
            $pret->setEmprunteur($this);
        }

        return $this;
    }
    public function removePret(Prets $pret): self
    {
        if ($this->prets->removeElement($pret)) {
            // set the owning side to null (unless already changed)
            if ($pret->getEmprunteur() === $this) {
                $pret->setEmprunteur(null);
            }
        }

        return $this;
    }
    public function getUsername()
    {
        return $this->nom;
    }
    public function getSalt()
    {
        
    }
    public function eraseCredentials()
    {
        
    }
    public function getRoles():array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

}
