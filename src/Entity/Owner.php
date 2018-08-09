<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OwnerRepository")
 */
class Owner
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Moving", mappedBy="owner")
     */
    private $movings;

    public function __construct()
    {
        $this->movings = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Moving[]
     */
    public function getMovings(): Collection
    {
        return $this->movings;
    }

    public function addMoving(Moving $moving): self
    {
        if (!$this->movings->contains($moving)) {
            $this->movings[] = $moving;
            $moving->setOwner($this);
        }

        return $this;
    }

    public function removeMoving(Moving $moving): self
    {
        if ($this->movings->contains($moving)) {
            $this->movings->removeElement($moving);
            // set the owning side to null (unless already changed)
            if ($moving->getOwner() === $this) {
                $moving->setOwner(null);
            }
        }

        return $this;
    }
}
