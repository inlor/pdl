<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\Theme;
use App\Entity\User;
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
        //$a = $this->getDoctrine()->getRepository(Post::class)->findAll();
        return Dashboard::new()
            ->setTitle('Poezii de luni');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Posts', 'fas fa-newspaper', Post::class);
        yield MenuItem::linkToCrud('Themes', 'fas fa-list', Theme::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
    }
}
