<?php

namespace App\Entity;

use App\Repository\EscapeRoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EscapeRoomRepository::class)
 */
class EscapeRoom
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
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity=Introduction::class, mappedBy="escapeRoom", cascade={"persist", "remove"})
     */
    private $introduction;

    /**
     * @ORM\OneToMany(targetEntity=Riddle::class, mappedBy="escapeRoom")
     */
    private $riddles;

    public function __construct()
    {
        $this->riddles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIntroduction(): ?Introduction
    {
        return $this->introduction;
    }

    public function setIntroduction(?Introduction $introduction): self
    {
        // unset the owning side of the relation if necessary
        if ($introduction === null && $this->introduction !== null) {
            $this->introduction->setEscapeRoom(null);
        }

        // set the owning side of the relation if necessary
        if ($introduction !== null && $introduction->getEscapeRoom() !== $this) {
            $introduction->setEscapeRoom($this);
        }

        $this->introduction = $introduction;

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
            $riddle->setEscapeRoom($this);
        }

        return $this;
    }

    public function removeRiddle(Riddle $riddle): self
    {
        if ($this->riddles->removeElement($riddle)) {
            // set the owning side to null (unless already changed)
            if ($riddle->getEscapeRoom() === $this) {
                $riddle->setEscapeRoom(null);
            }
        }

        return $this;
    }
}
