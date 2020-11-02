<?php

namespace App\Controller;

use App\Repository\TipsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     *
     * @return Response
     */
    public function index(TipsRepository $tipsRepository)
    {
        return $this->render('home/index.html.twig', [
            'tips' => $tipsRepository->findAll(),
        ]);
    }
}
