<?php

namespace App\Controller;

use App\Entity\Language;
use App\Entity\Tips;
use App\Form\TipsType;
use App\Repository\TipsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class TipsController extends AbstractController
{
    /**
     * @Route("/tips", name="tips_index", methods={"GET"})
     */
    public function index(TipsRepository $tipsRepository, Request $request): Response
    {
        $tips = new Tips();
        $form = $this->createForm(TipsType::class, $tips);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Tips Created! Knowledge is power');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tips);
            $entityManager->flush();

            return $this->redirectToRoute('tips_index');
        }

        return $this->render('tips/index.html.twig', [
            'tips' => $tipsRepository->findAll(),
            'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/tips/{id}", name="tips_show", methods={"GET"})
     * @ParamConverter("tips", options={"id" = "tips_id"})
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
            $this->addFlash('success', 'Well done, Tip Modified!');
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
            $this->addFlash('success', 'It wasn\'t that important anyway!');
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->remove($tip);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tips_index');
    }
}
