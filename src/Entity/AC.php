<?php

namespace App\Entity;

use App\Repository\ACRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ACRepository::class)]
class AC extends User
{

    #[ORM\OneToMany(mappedBy: 'aC', targetEntity: Inscription::class)]
    private $incriptions;

    public function __construct()
    {
        $this->incriptions = new ArrayCollection();
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
            $incription->setAC($this);
        }

        return $this;
    }

    public function removeIncription(Inscription $incription): self
    {
        if ($this->incriptions->removeElement($incription)) {
            // set the owning side to null (unless already changed)
            if ($incription->getAC() === $this) {
                $incription->setAC(null);
            }
        }

        return $this;
    }
    public function getRoles(): array
    {
        $roles[] = 'ROLE_AC';
        return $roles;
    }
}
