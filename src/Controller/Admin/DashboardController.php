<?php

namespace App\Controller\Admin;

use App\Entity\{AnneeScolaire, Inscription,AC,RP};
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
         return $this->render('dashboard/dashboard.html.twig');
    }


    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ADMIN ECOLE')
            ->renderContentMaximized()
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('INFORMATION', 'fas fa-list', Inscription::class);
        yield MenuItem::linkToCrud('ANNEE SCOLAIRE', 'fa-solid fa-calendar-check', AnneeScolaire::class);
        yield MenuItem::linkToCrud('AC', 'fa-solid fa-chalkboard-user', AC::class);
        yield MenuItem::linkToCrud('RP', 'fa-solid fa-chalkboard-user', RP::class);
        yield MenuItem::linkToCrud('PROFESSEUR', 'fa-solid fa-chalkboard-user', RP::class);
    }
}