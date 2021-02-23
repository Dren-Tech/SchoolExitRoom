<?php


namespace App\Service\Entity;


use App\Entity\Riddle;
use App\Entity\Student;
use App\Entity\StudentRiddleResult;
use App\Repository\StudentRiddleResultRepository;
use Doctrine\ORM\EntityManagerInterface;

class StudentRiddleResultService
{
    private StudentRiddleResultRepository $resultRepository;

    private EntityManagerInterface $entityManager;

    /**
     * StudentRiddleResultService constructor.
     * @param StudentRiddleResultRepository $resultRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(StudentRiddleResultRepository $resultRepository, EntityManagerInterface $entityManager)
    {
        $this->resultRepository = $resultRepository;
        $this->entityManager = $entityManager;
    }

    public function saveResultForStudent(Student $student, Riddle $riddle, string $resultText, \DateTime $resolveTime)
    {
        $result = new StudentRiddleResult();

        $result->setStudent($student);
        $result->setRiddle($riddle);
        $result->setResult($resultText);
        $result->setResolveTime($resolveTime);

        $this->entityManager->persist($result);
        $this->entityManager->flush();
    }
}