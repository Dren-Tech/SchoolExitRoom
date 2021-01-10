<?php

namespace App\Entity;

use App\Repository\IntroductionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IntroductionRepository::class)
 */
class Introduction
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
     * @ORM\OneToOne(targetEntity=EscapeRoom::class, inversedBy="introduction", cascade={"persist", "remove"})
     */
    private $escapeRoom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $youtubeLink;

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

    public function getEscapeRoom(): ?EscapeRoom
    {
        return $this->escapeRoom;
    }

    public function setEscapeRoom(?EscapeRoom $escapeRoom): self
    {
        $this->escapeRoom = $escapeRoom;

        return $this;
    }

    public function getYoutubeLink(): ?string
    {
        return $this->youtubeLink;
    }

    public function setYoutubeLink(?string $youtubeLink): self
    {
        $this->youtubeLink = $youtubeLink;

        return $this;
    }
}
