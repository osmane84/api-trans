<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MovingRepository")
 * 
 * @Serializer\ExclusionPolicy("all")
 * 
 */
class Moving
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Expose
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Expose
     * @Assert\NotBlank
     */
    private $startAdress;

    /**
     * @ORM\Column(type="string", length=50)
     * @Serializer\Expose
     * @Assert\NotBlank
     */
    private $startTown;

    /**
     * @ORM\Column(type="string", length=15)
     * @Serializer\Expose
     */
    private $startZipCode;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Serializer\Expose
     */
    private $satartLevel;

    /**
     * @ORM\Column(type="boolean")
     * @Serializer\Expose
     */
    private $satartElevator;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Expose
     * @Assert\NotBlank
     */
    
    private $cameAdress;

    /**
     * @ORM\Column(type="string", length=50)
     * @Serializer\Expose
     * @Assert\NotBlank
     */
    private $cameTown;

    /**
     * @ORM\Column(type="string", length=15)
     * @Serializer\Expose
     */
    private $cameZipCode;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Serializer\Expose
     */
    private $cameLevel;

    /**
     * @ORM\Column(type="boolean")
     * @Serializer\Expose
     */
    private $cameElevator;

    /**
     * @ORM\Column(type="float")
     * @Serializer\Expose
     * @Assert\NotBlank
     */
    private $volume;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Expose
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Expose
     * @Assert\NotBlank
     */
    private $num;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Expose
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Serializer\Expose
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     * @Serializer\Expose
     */
    private $phone;

    /**
     * @ORM\Column(type="datetime")
     * @Serializer\Expose
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Owner", inversedBy="movings")
     * @Serializer\Expose
     */
    private $owner;


    public function __construct() {
       
    }

    public function getId()
    {
        return $this->id;
    }

    public function getStartAdress(): ?string
    {
        return $this->startAdress;
    }

    public function setStartAdress(string $startAdress): self
    {
        $this->startAdress = $startAdress;

        return $this;
    }

    public function getStartTown(): ?string
    {
        return $this->startTown;
    }

    public function setStartTown(string $startTown): self
    {
        $this->startTown = $startTown;

        return $this;
    }

    public function getStartZipCode(): ?string
    {
        return $this->startZipCode;
    }

    public function setStartZipCode(string $startZipCode): self
    {
        $this->startZipCode = $startZipCode;

        return $this;
    }

    public function getCameAdress(): ?string
    {
        return $this->cameAdress;
    }

    public function setCameAdress(string $cameAdress): self
    {
        $this->cameAdress = $cameAdress;

        return $this;
    }

    public function getCameTown(): ?string
    {
        return $this->cameTown;
    }

    public function setCameTown(string $cameTown): self
    {
        $this->cameTown = $cameTown;

        return $this;
    }

    public function getCameZipCode(): ?string
    {
        return $this->cameZipCode;
    }

    public function setCameZipCode(string $cameZipCode): self
    {
        $this->cameZipCode = $cameZipCode;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getElevator(): ?bool
    {
        return $this->elevator;
    }

    public function setElevator(bool $elevator): self
    {
        $this->elevator = $elevator;

        return $this;
    }

    public function getVolume(): ?float
    {
        return $this->volume;
    }

    public function setVolume(float $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNum(): ?string
    {
        return $this->num;
    }

    public function setNum(string $num): self
    {
        $this->num = $num;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getOwner(): ?Owner
    {
        return $this->owner;
    }

    public function setOwner(?Owner $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getSatartLevel(): ?int
    {
        return $this->satartLevel;
    }

    public function setSatartLevel(?int $satartLevel): self
    {
        $this->satartLevel = $satartLevel;

        return $this;
    }

    public function getSatartElevator(): ?bool
    {
        return $this->satartElevator;
    }

    public function setSatartElevator(bool $satartElevator): self
    {
        $this->satartElevator = $satartElevator;

        return $this;
    }

    public function getCameLevel(): ?int
    {
        return $this->cameLevel;
    }

    public function setCameLevel(?int $cameLevel): self
    {
        $this->cameLevel = $cameLevel;

        return $this;
    }

    public function getCameElevator(): ?bool
    {
        return $this->cameElevator;
    }

    public function setCameElevator(bool $cameElevator): self
    {
        $this->cameElevator = $cameElevator;

        return $this;
    }
}
