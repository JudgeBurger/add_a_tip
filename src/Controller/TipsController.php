<?php

namespace App\Controller;

use App\Entity\Language;
use App\Entity\Tips;
use App\Form\TipsType;
use App\Repository\TipsRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Rajouter IsGranted pour l'ensenble de TipsController

/**
 * @Route("/")
 */
class TipsController extends AbstractController
{
    const TIPS_PER_PAGE = 3;

    /**
     * @Route("/tips", name="tips_index", methods={"GET"})
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
     */
    public function new(Request $request): Response
    {
        $tip = new Tips();
        $form = $this->createForm(TipsType::class, $tip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
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
     * @param Language $language
     * @return Response
     */
    public function show(Tips $tip, Language $language): Response
    {
        return $this->render('tips/show.html.twig', [
            'tip' => $tip,
            'language' => $language,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tips_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tips $tip): Response
    {
        $form = $this->createForm(TipsType::class, $tip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
     */
    public function delete(Request $request, Tips $tip): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tip->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->remove($tip);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tips_index');
    }
}
