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
            $code = strtoupper($codeForm->get("code")->getData());

            if ($code == $riddle->getSolutionCode()) {
                $hashedCode = $this->riddleService->hashRiddleCode($code);
                return $this->redirectToRoute('frontend_riddle_success', ['riddleIdentifier' => $riddle->getIdentifier(), 'code' => $hashedCode]);
            } else {
                $codeIsWrong = true;
            }
        }

        return $this->render('frontend/riddle/detail.html.twig', [
            'riddle' => $riddle,
            'code_form' => $codeForm->createView(),
            'codeIsWrong' => $codeIsWrong ?? false
        ]);
    }

    #[Route('/riddle/{riddleIdentifier}/success/{code}', name: 'frontend_riddle_success')]
    public function success(string $riddleIdentifier, string $code): Response
    {
        $riddle = $this->riddleService->getRiddleByIdentifier($riddleIdentifier);

        $hashedCode = $this->riddleService->hashRiddleCode($riddle->getSolutionCode());

        if($code == $hashedCode) {
            return $this->render('frontend/riddle/success.html.twig', [
                'riddle' => $riddle
            ]);
        } else {
            echo "failure - redirect to riddle page";
        }
    }
}
