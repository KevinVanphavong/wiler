<?php

namespace App\Controller;

use App\Entity\Faq;
use App\Form\FaqType;
use App\Repository\FaqRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class AdminFaqController
 * @package App\Controller
 * @Route("/admin/faq", name="admin_faq_")
 */
class AdminFaqController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response
     */
    public function index(): Response
    {
        $faqs = $this->getDoctrine()
            ->getRepository(Faq::class)
            ->findAll();

        return $this->render(
            'admin_faq/indexAdmin.html.twig',
            [
                'faqs' => $faqs]
        );
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/nouveau",  name="new")
     */
    public function new(Request $request): Response
    {
        $faq = new Faq();
        $form = $this->createForm(FaqType::class, $faq);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($faq);
            $entityManager->flush();

            $this->addFlash('success', 'La nouvelle question/réponse a bien été ajoutée');

            return $this->redirectToRoute('admin_faq_index');
        }
        return $this->render('admin_faq/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="edit", methods={"GET","POST"})
     * @param Request $request
     * @param Faq $faq
     * @return Response
     */
    public function edit(Request $request, Faq $faq): Response
    {
        $form = $this->createForm(FaqType::class, $faq);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'La question/réponse a bien été modifiée');

            return $this->redirectToRoute('admin_faq_index');
        }

        return $this->render('admin_faq/edit.html.twig', [
            'faq' => $faq,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/supprimer", name="delete", methods={"DELETE"})
     * @param Request $request
     * @param Faq $faq
     * @return Response
     */
    public function delete(Request $request, Faq $faq): Response
    {
        if ($this->isCsrfTokenValid('delete' . $faq->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($faq);
            $entityManager->flush();

            $this->addFlash('success', 'La question/réponse a bien été suprimée');
        }

        return $this->redirectToRoute('admin_faq_index');
    }
}
