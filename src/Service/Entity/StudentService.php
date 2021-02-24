<?php


namespace App\Service\Entity;


use App\Entity\Student;
use App\Repository\StudentRepository;
use Doctrine\ORM\EntityManagerInterface;

class StudentService
{
    private StudentRepository $studentRepository;

    private EntityManagerInterface $entityManager;

    /**
     * StudentService constructor.
     * @param StudentRepository $studentRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(StudentRepository $studentRepository, EntityManagerInterface $entityManager)
    {
        $this->studentRepository = $studentRepository;
        $this->entityManager = $entityManager;
    }

    public function getStudentById(int $id): Student
    {
        return $this->studentRepository->find($id);
    }

    public function saveStudent(Student $student)
    {
        $this->entityManager->persist($student);
        $this->entityManager->flush();
    }
}