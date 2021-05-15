<?php

namespace App\Entity;

use App\Repository\EntertainementImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntertainementImageRepository::class)
 */
class EntertainementImage
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
     * @ORM\ManyToOne(targetEntity=Entertainement::class, inversedBy="entertainementImages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $event;

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

    public function getEvent(): ?Entertainement
    {
        return $this->event;
    }

    public function setEvent(?Entertainement $event): self
    {
        $this->event = $event;

        return $this;
    }
}
