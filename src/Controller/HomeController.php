<?php

namespace App\Controller;

use App\Entity\Language;
use App\Repository\TipsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @property array languages
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TipsRepository $tipsRepository)
    {
        return $this->render('home/index.html.twig', [
            'tips' => $tipsRepository->lastTips(),
        ]);
    }
}
