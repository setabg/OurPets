<?php

namespace App\Entity;

use App\Repository\AddPetsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddPetsRepository::class)
 */
class AddPets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $petKind;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $petInfo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getPetKind(): ?string
    {
        return $this->petKind;
    }

    public function setPetKind(string $petKind): self
    {
        $this->petKind = $petKind;

        return $this;
    }

    public function getPetInfo(): ?string
    {
        return $this->petInfo;
    }

    public function setPetInfo(?string $petInfo): self
    {
        $this->petInfo = $petInfo;

        return $this;
    }
}
