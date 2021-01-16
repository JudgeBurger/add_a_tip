<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Crud\AdminCrudController;
use App\Controller\Admin\Crud\UserCrudController;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="dashboard")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Add a Tip - Esapce Administrateur');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Profils');
        yield MenuItem::linkToCrud('Administrators', 'fa fa-user', User::class)
            ->setController(AdminCrudController::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class)
            ->setController(UserCrudController::class);
    }
}
