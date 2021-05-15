<?php

namespace App\Entity;

use App\Repository\EntertainementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntertainementRepository::class)
 */
class Entertainement
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=EntertainementImage::class, mappedBy="event", cascade={"persist"})
     */
    private $entertainementImages;

    public function __construct()
    {
        $this->entertainementImages = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|EntertainementImage[]
     */
    public function getEntertainementImages(): Collection
    {
        return $this->entertainementImages;
    }

    public function addEntertainementImage(EntertainementImage $entertainementImage): self
    {
        if (!$this->entertainementImages->contains($entertainementImage)) {
            $this->entertainementImages[] = $entertainementImage;
            $entertainementImage->setEvent($this);
        }

        return $this;
    }

    public function removeEntertainementImage(EntertainementImage $entertainementImage): self
    {
        if ($this->entertainementImages->removeElement($entertainementImage)) {
            // set the owning side to null (unless already changed)
            if ($entertainementImage->getEvent() === $this) {
                $entertainementImage->setEvent(null);
            }
        }

        return $this;
    }
}
