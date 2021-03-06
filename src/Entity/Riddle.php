<?php

namespace App\Entity;

use App\Repository\RiddleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;

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

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank
     */
    private $successMessage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $youtubeLink;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pdfFilename;

    /**
     * @ORM\ManyToOne(targetEntity=Riddle::class)
     */
    private $nextRiddle;

    /**
     * @ORM\ManyToMany(targetEntity=LearnApp::class, inversedBy="riddles", cascade={"persist"})
     */
    private $learnApps;

    /**
     * @ORM\OneToMany(targetEntity=StudentRiddleResult::class, mappedBy="riddle")
     */
    private $studentResults;

    public function __construct()
    {
        $this->riddleHints = new ArrayCollection();
        $this->learnApps = new ArrayCollection();
        $this->studentResults = new ArrayCollection();
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
     * @return RiddleHint[]
     */
    public function getRiddleHints(): array
    {
        return $this->riddleHints->toArray();
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

    public function getSuccessMessage(): ?string
    {
        return $this->successMessage;
    }

    public function setSuccessMessage(string $successMessage): self
    {
        $this->successMessage = $successMessage;

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

    public function getYoutubeEmbedLink(): ?string
    {
        $stringExploded = explode("/", $this->getYoutubeLink());
        $youtubeId = end($stringExploded);

        return sprintf("https://www.youtube.com/embed/%s", $youtubeId);
    }

    public function getPdfFilename(): ?string
    {
        return $this->pdfFilename;
    }

    public function setPdfFilename(?string $pdfFilename): self
    {
        $this->pdfFilename = $pdfFilename;

        return $this;
    }

    public function getPdfDownloadLink(): string
    {
        return sprintf("/uploads/pdf/%s", $this->getPdfFilename());
    }

    public function getNextRiddle(): ?self
    {
        return $this->nextRiddle;
    }

    public function setNextRiddle(?self $nextRiddle): self
    {
        $this->nextRiddle = $nextRiddle;

        return $this;
    }

    /**
     * @return Collection|LearnApp[]
     */
    public function getLearnApps(): Collection
    {
        return $this->learnApps;
    }

    public function addLearnApp(LearnApp $learnApp): self
    {
        if (!$this->learnApps->contains($learnApp)) {
            $this->learnApps[] = $learnApp;
        }

        return $this;
    }

    public function removeLearnApp(LearnApp $learnApp): self
    {
        $this->learnApps->removeElement($learnApp);

        return $this;
    }

    /**
     * @return Collection|StudentRiddleResult[]
     */
    public function getStudentResults(): Collection
    {
        return $this->studentResults;
    }

    public function addStudentResult(StudentRiddleResult $studentResult): self
    {
        if (!$this->studentResults->contains($studentResult)) {
            $this->studentResults[] = $studentResult;
            $studentResult->setRiddle($this);
        }

        return $this;
    }

    public function removeStudentResult(StudentRiddleResult $studentResult): self
    {
        if ($this->studentResults->removeElement($studentResult)) {
            // set the owning side to null (unless already changed)
            if ($studentResult->getRiddle() === $this) {
                $studentResult->setRiddle(null);
            }
        }

        return $this;
    }
}
