<?php

namespace App\Controller\Admin;

use App\Entity\EscapeRoom;
use App\Entity\Introduction;
use App\Entity\Riddle;
use App\Entity\RiddleHint;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('School Exit Room');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToUrl('Website aufrufen', null, '/');

        yield MenuItem::section("Escape-Rooms");
        yield MenuItem::linkToCrud("Rooms", "fa fa-dungeon", EscapeRoom::class);
        yield MenuItem::linkToCrud("Einführung", "fa fa-book", Introduction::class);
        yield MenuItem::linkToCrud("Rätsel", "fa fa-lock", Riddle::class);
        yield MenuItem::linkToCrud("Hinweise", "fa fa-lightbulb", RiddleHint::class);

        yield MenuItem::section("Schüler*innen");

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
