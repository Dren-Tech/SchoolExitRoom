<?php

namespace App\MessageHandler;

use App\Entity\StudentRiddleResult;
use App\Message\RiddleResultMessage;
use App\Service\Entity\RiddleService;
use App\Service\Entity\StudentRiddleResultService;
use App\Service\Entity\StudentService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class RiddleResultMessageHandler implements MessageHandlerInterface
{
    private RiddleService $riddleService;

    private StudentService $studentService;

    private StudentRiddleResultService $resultService;

    private EntityManagerInterface $entityManager;

    /**
     * RiddleResultMessageHandler constructor.
     * @param RiddleService $riddleService
     * @param StudentService $studentService
     * @param StudentRiddleResultService $resultService
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(RiddleService $riddleService, StudentService $studentService, StudentRiddleResultService $resultService, EntityManagerInterface $entityManager)
    {
        $this->riddleService = $riddleService;
        $this->studentService = $studentService;
        $this->resultService = $resultService;

        $this->entityManager = $entityManager;
    }


    public function __invoke(RiddleResultMessage $message)
    {
        $riddle = $this->riddleService->getRiddleByIdentifier($message->getRiddleIdentifier());
        $student = $this->studentService->getStudentById($message->getStudentId());

        $this->resultService->saveResultForStudent($student, $riddle, $message->getResult(), $message->getResolveTime());
    }
}
