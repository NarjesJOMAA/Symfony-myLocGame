<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Biens;
use App\Entity\User;
use App\Entity\Categories;
use App\Entity\Prets;

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
            ->setTitle('Mylocgame');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Users');
        yield MenuItem::linktoCrud('User', 'fa fa-user', User::class);

        yield MenuItem::section('Biens');
        yield MenuItem::linktoCrud('Biens', 'fa fa-tags', Biens::class);

        yield MenuItem::section('Categories');
        yield MenuItem::linktoCrud('Categories', 'fa fa-tags', Categories::class);

        yield MenuItem::section('Prets');
        yield MenuItem::linktoCrud('Prets', 'fa fa-tags', Prets::class);

    }
}
