<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant extends User
{

    #[ORM\Column(type: 'string', length: 100)]
    private $matricule;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $sexe;

    #[ORM\Column(type: 'text', nullable: true)]
    private $adresse;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Inscription::class)]
    private $incriptions;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Demande::class)]
    private $demandes;

    public function __construct()
    {
        $this->incriptions = new ArrayCollection();
        $this->demandes = new ArrayCollection();
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

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
            $incription->setEtudiant($this);
        }

        return $this;
    }

    public function removeIncription(Inscription $incription): self
    {
        if ($this->incriptions->removeElement($incription)) {
            // set the owning side to null (unless already changed)
            if ($incription->getEtudiant() === $this) {
                $incription->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Demande>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demande $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes[] = $demande;
            $demande->setEtudiant($this);
        }

        return $this;
    }

    public function removeDemande(Demande $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getEtudiant() === $this) {
                $demande->setEtudiant(null);
            }
        }

        return $this;
    }
}
