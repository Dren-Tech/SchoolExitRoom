<?php

namespace App\Controller\Frontend;

use App\Form\RiddleCodeFormType;
use App\Service\Entity\RiddleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RiddleController extends AbstractController
{
    private RiddleService $riddleService;

    /**
     * RiddleController constructor.
     * @param RiddleService $riddleService
     */
    public function __construct(RiddleService $riddleService)
    {
        $this->riddleService = $riddleService;
    }


    #[Route('/riddle', name: 'frontend_riddle')]
    public function index(): Response
    {
        return $this->render('frontend/riddle/index.html.twig', [
            'controller_name' => 'RiddleController',
        ]);
    }

    #[Route('/riddle/{riddleIdentifier}', name: 'frontend_riddle_detail')]
    public function detail(string $riddleIdentifier, Request $request): Response
    {
        $riddle = $this->riddleService->getRiddleByIdentifier($riddleIdentifier);

        $codeForm = $this->createForm(RiddleCodeFormType::class);
        $codeForm->handleRequest($request);

        // check if submitted code is correct
        if ($codeForm->isSubmitted() && $codeForm->isValid()) {
            if (strtoupper($codeForm->get("code")->getData()) == $riddle->getSolutionCode()) {
                echo "CODE IS CORRECT";
            } else {
                echo "CODE IS WRONG";
            }
        }

        return $this->render('frontend/riddle/detail.html.twig', [
            'controller_name' => 'RiddleController',
            'identifier' => $riddleIdentifier,
            'riddle' => $riddle,
            'code_form' => $codeForm->createView()
        ]);
    }
}
