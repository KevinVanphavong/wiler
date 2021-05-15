<?php

namespace App\Entity;

use App\Repository\WilferImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WilferImageRepository::class)
 */
class WilferImage
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Wilfer::class, inversedBy="wilferImages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $wilfer;

    public function getId(): ?int
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

    public function getWilfer(): ?Wilfer
    {
        return $this->wilfer;
    }

    public function setWilfer(?Wilfer $wilfer): self
    {
        $this->wilfer = $wilfer;

        return $this;
    }
}
