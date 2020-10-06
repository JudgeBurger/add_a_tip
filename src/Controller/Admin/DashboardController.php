<?php

namespace App\Controller\Admin;

use App\Entity\Tips;
use App\Entity\User;
use App\Repository\TipsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    protected $tipsRepository;
    protected $userRepository;

    public function __construct(
        TipsRepository  $tipsRepository,
        UserRepository  $userRepository
    )
    {
        $this->tipsRepository = $tipsRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/admin", name="admin")
     * @Security("is_granted('ROLE_ADMIN')")
     * @throws NonUniqueResultException
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig', [
            'countAllUser' => $this->userRepository->countAllUser(),
            'countAllTips' => $this->tipsRepository->countAllTips(),
            'tips' => $this->tipsRepository->findAll(),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Add A Tip');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Accueil', 'fa fa-home');
        yield MenuItem::linkToCrud('Tips', 'fas fa-lightbulb', Tips::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', User::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu {
        return parent::configureUserMenu($user)
            ->setName($user->getUsername())
            ->setAvatarUrl('https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcScEfvzrIe0ICeKwz-tpYFQnaD9Bavf3tTfmQ&usqp=CAU')
            ->displayUserAvatar(true);
            ;
    }
}
