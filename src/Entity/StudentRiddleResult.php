<?php

namespace App\Entity;

use App\Repository\StudentRiddleResultRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRiddleResultRepository::class)
 */
class StudentRiddleResult
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="riddleResults")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @ORM\ManyToOne(targetEntity=Riddle::class, inversedBy="studentResults")
     * @ORM\JoinColumn(nullable=false)
     */
    private $riddle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $result;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getRiddle(): ?Riddle
    {
        return $this->riddle;
    }

    public function setRiddle(?Riddle $riddle): self
    {
        $this->riddle = $riddle;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(string $result): self
    {
        $this->result = $result;

        return $this;
    }
}
