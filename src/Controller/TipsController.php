<?php

namespace App\Controller;

use App\Entity\Tips;
use App\Form\TipsType;
use App\Repository\TipsRepository;
use App\Service\MessagesFlash;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

// Rajouter IsGranted pour l'ensenble de TipsController

/**
 * @Route("/")
 */
class TipsController extends AbstractController
{
    const TIPS_PER_PAGE = 3;

    /***
     * @var string
     */
    private $messageFlash;

    public function __construct(MessagesFlash $flash)
    {
        $this->messageFlash = $flash;
    }

    /**
     * @Route("/tips", name="tips_index", methods={"GET"})
     * @param TipsRepository $tipsRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(TipsRepository $tipsRepository, PaginatorInterface $paginator, Request $request): Response
    {
        return $this->render('tips/index.html.twig', [
            'tips' => $paginator->paginate(
                $tipsRepository->findAll(),
                $request->query->getInt('page', 1),
                self::TIPS_PER_PAGE
            ),
        ]);
    }

    /**
     * @Route("/new", name="tips_new", methods={"GET","POST"})
     * @param Request $request
     * @param MessagesFlash $messagesFlash
     * @return Response
     */
    public function new(Request $request, MessagesFlash $messagesFlash): Response
    {
        $tip = new Tips();
        $form = $this->createForm(TipsType::class, $tip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $this->messageFlash->messageFlash('create');
            $entityManager->persist($tip);
            $entityManager->flush();

            return $this->redirectToRoute('tips_index');
        }

        return $this->render('tips/new.html.twig', [
            'tip' => $tip,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tips/{id}", name="tips_show", methods={"GET"})
     * @param Tips $tip
     * @return Response
     */
    public function show(Tips $tip): Response
    {
        return $this->render('tips/show.html.twig', [
            'tip' => $tip,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tips_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Tips $tip
     * @param MessagesFlash $messagesFlash
     * @return Response
     */
    public function edit(Request $request, Tips $tip, MessagesFlash $messagesFlash): Response
    {
        $form = $this->createForm(TipsType::class, $tip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->messageFlash->messageFlash('update');
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tips_index');
        }

        return $this->render('tips/edit.html.twig', [
            'tip' => $tip,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tips_delete", methods={"DELETE"})
     * @param Request $request
     * @param Tips $tip
     * @param MessagesFlash $messagesFlash
     * @return Response
     */
    public function delete(Request $request, Tips $tip, MessagesFlash $messagesFlash): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tip->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $this->messageFlash->messageFlash('delete');

            $entityManager->remove($tip);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tips_index');
    }
}
