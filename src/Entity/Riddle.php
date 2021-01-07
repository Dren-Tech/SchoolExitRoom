<?php

namespace App\Entity;

use App\Repository\RiddleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RiddleRepository::class)
 */
class Riddle
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $entryCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $solutionCode;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isUnlocked;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $identifier;

    /**
     * @ORM\ManyToOne(targetEntity=EscapeRoom::class, inversedBy="riddles")
     */
    private $escapeRoom;

    /**
     * @ORM\ManyToMany(targetEntity=RiddleHint::class, mappedBy="riddles")
     */
    private $riddleHints;

    public function __construct()
    {
        $this->riddleHints = new ArrayCollection();
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

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getEntryCode(): ?string
    {
        return $this->entryCode;
    }

    public function setEntryCode(?string $entryCode): self
    {
        $this->entryCode = $entryCode;

        return $this;
    }

    public function getSolutionCode(): ?string
    {
        return $this->solutionCode;
    }

    public function setSolutionCode(string $solutionCode): self
    {
        $this->solutionCode = $solutionCode;

        return $this;
    }

    public function getIsUnlocked(): ?bool
    {
        return $this->isUnlocked;
    }

    public function setIsUnlocked(bool $isUnlocked): self
    {
        $this->isUnlocked = $isUnlocked;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getEscapeRoom(): ?EscapeRoom
    {
        return $this->escapeRoom;
    }

    public function setEscapeRoom(?EscapeRoom $escapeRoom): self
    {
        $this->escapeRoom = $escapeRoom;

        return $this;
    }

    /**
     * @return Collection|RiddleHint[]
     */
    public function getRiddleHints(): Collection
    {
        return $this->riddleHints;
    }

    public function addRiddleHint(RiddleHint $riddleHint): self
    {
        if (!$this->riddleHints->contains($riddleHint)) {
            $this->riddleHints[] = $riddleHint;
            $riddleHint->addRiddle($this);
        }

        return $this;
    }

    public function removeRiddleHint(RiddleHint $riddleHint): self
    {
        if ($this->riddleHints->removeElement($riddleHint)) {
            $riddleHint->removeRiddle($this);
        }

        return $this;
    }
}
