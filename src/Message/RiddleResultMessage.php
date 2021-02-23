<?php

namespace App\Message;

final class RiddleResultMessage
{
    private int $studentId;

    private string $riddleIdentifier;

    private string $result;

    private \DateTime $resolveTime;

    /**
     * RiddleResultMessage constructor.
     * @param int $studentId
     * @param string $riddleIdentifier
     * @param string $result
     */
    public function __construct(int $studentId, string $riddleIdentifier, string $result, \DateTime $resolveTime = null)
    {
        $this->studentId = $studentId;
        $this->riddleIdentifier = $riddleIdentifier;
        $this->result = $result;

        $this->resolveTime = $resolveTime ?? new \DateTime();
    }

    /**
     * @return int
     */
    public function getStudentId(): int
    {
        return $this->studentId;
    }

    /**
     * @return string
     */
    public function getRiddleIdentifier(): string
    {
        return $this->riddleIdentifier;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }

    /**
     * @return \DateTime
     */
    public function getResolveTime(): \DateTime
    {
        return $this->resolveTime;
    }
}
