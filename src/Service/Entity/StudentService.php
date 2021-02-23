<?php


namespace App\Service\Entity;


use App\Entity\Student;
use App\Repository\StudentRepository;

class StudentService
{
    private StudentRepository $studentRepository;

    /**
     * StudentService constructor.
     * @param StudentRepository $studentRepository
     */
    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function getStudentById(int $id): Student
    {
        return $this->studentRepository->find($id);
    }
}