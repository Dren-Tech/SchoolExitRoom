<?php

namespace App\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RiddleController extends AbstractController
{
    #[Route('/riddle', name: 'frontend_riddle')]
    public function index(): Response
    {
        return $this->render('frontend/riddle/index.html.twig', [
            'controller_name' => 'RiddleController',
        ]);
    }

    #[Route('/riddle/{riddleCode}', name: 'frontend_riddle_detail')]
    public function detail(string $riddleCode): Response
    {
        return $this->render('frontend/riddle/detail.html.twig', [
            'controller_name' => 'RiddleController',
        ]);
    }
}
