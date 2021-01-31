<?php

namespace App\Entity;

use App\Repository\RiddleHintRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RiddleHintRepository::class)
 */
class RiddleHint
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\ManyToMany(targetEntity=Riddle::class, inversedBy="riddleHints")
     */
    private $riddles;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFilename;

    public function __construct()
    {
        $this->riddles = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Collection|Riddle[]
     */
    public function getRiddles(): Collection
    {
        return $this->riddles;
    }

    public function addRiddle(Riddle $riddle): self
    {
        if (!$this->riddles->contains($riddle)) {
            $this->riddles[] = $riddle;
        }

        return $this;
    }

    public function removeRiddle(Riddle $riddle): self
    {
        $this->riddles->removeElement($riddle);

        return $this;
    }

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename(?string $imageFilename): self
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }
}
