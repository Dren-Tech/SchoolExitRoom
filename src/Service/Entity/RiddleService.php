<?php


namespace App\Service\Entity;


use App\Entity\Riddle;
use App\Repository\RiddleRepository;

class RiddleService
{
    private RiddleRepository $riddleRepository;

    /**
     * RiddleService constructor.
     * @param RiddleRepository $riddleRepository
     */
    public function __construct(RiddleRepository $riddleRepository)
    {
        $this->riddleRepository = $riddleRepository;
    }


    function getRiddleByIdentifier(string $identifier): Riddle
    {
        return $this->riddleRepository->findOneBy(['identifier' => $identifier]);
    }

    function hashRiddleCode(string $code): string {
        return hash("sha256", $code);
    }

}