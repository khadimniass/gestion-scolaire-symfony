<?php

namespace App\Entity;

use App\Repository\AnneeScolaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneeScolaireRepository::class)]
class AnneeScolaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 200)]
    private $libelle;

    #[ORM\OneToMany(mappedBy: 'anneeScolaire', targetEntity: Inscription::class)]
    private $incriptions;

    public function __construct()
    {
        $this->incriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getIncriptions(): Collection
    {
        return $this->incriptions;
    }

    public function addIncription(Inscription $incription): self
    {
        if (!$this->incriptions->contains($incription)) {
            $this->incriptions[] = $incription;
            $incription->setAnneeScolaire($this);
        }

        return $this;
    }

    public function removeIncription(Inscription $incription): self
    {
        if ($this->incriptions->removeElement($incription)) {
            // set the owning side to null (unless already changed)
            if ($incription->getAnneeScolaire() === $this) {
                $incription->setAnneeScolaire(null);
            }
        }

        return $this;
    }
}
