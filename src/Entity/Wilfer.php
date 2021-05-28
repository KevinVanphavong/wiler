<?php

namespace App\Entity;

use App\Repository\WilferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * @ORM\Entity(repositoryClass=WilferRepository::class)
 * @Vich\Uploadable
 *
 */
class Wilfer
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullname;

    /**
     * @ORM\Column(type="datetime")
     */
    private $birthAt;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=WilferImage::class, mappedBy="wilfer", cascade={"persist"})
     */
    private $wilferImages;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="wilfer")
     */
    private $comments;

    public function __construct()
    {
        $this->wilferImages = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->firstname . ' ' . $this->getLastname();
    }

    public function setFullName(string $string): self
    {
        $this->fullname = $string;
        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthAt(): ?\DateTimeInterface
    {
        return $this->birthAt;
    }

    public function setBirthAt(\DateTimeInterface $birthAt): self
    {
        $this->birthAt = $birthAt;

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
     * @return Collection|WilferImage[]
     */
    public function getWilferImages(): Collection
    {
        return $this->wilferImages;
    }

    public function addWilferImage(WilferImage $wilferImage): self
    {
        if (!$this->wilferImages->contains($wilferImage)) {
            $this->wilferImages[] = $wilferImage;
            $wilferImage->setWilfer($this);
        }

        return $this;
    }

    public function removeWilferImage(WilferImage $wilferImage): self
    {
        if ($this->wilferImages->removeElement($wilferImage)) {
            // set the owning side to null (unless already changed)
            if ($wilferImage->getWilfer() === $this) {
                $wilferImage->setWilfer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setWilfer($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getWilfer() === $this) {
                $comment->setWilfer(null);
            }
        }

        return $this;
    }
}
