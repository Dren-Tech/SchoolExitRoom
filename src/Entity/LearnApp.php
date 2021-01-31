<?php

namespace App\Entity;

use App\Repository\LearnAppRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LearnAppRepository::class)
 */
class LearnApp
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
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $difficulty;

    /**
     * @ORM\ManyToMany(targetEntity=Riddle::class, mappedBy="learnApps")
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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

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
            $riddle->addLearnApp($this);
        }

        return $this;
    }

    public function removeRiddle(Riddle $riddle): self
    {
        if ($this->riddles->removeElement($riddle)) {
            $riddle->removeLearnApp($this);
        }

        return $this;
    }
}
