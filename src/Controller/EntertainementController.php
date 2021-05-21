<?php

namespace App\Controller;

use App\Entity\Entertainement;
use App\Entity\EntertainementImage;
use App\Form\EntertainementType;
use App\Repository\EntertainementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/entertainement", name="admin_")
 */
class EntertainementController extends AbstractController
{
    /**
     * @Route("/", name="entertainement_index", methods={"GET"})
     * @param EntertainementRepository $entertainementRepository
     * @return Response
     */
    public function index(EntertainementRepository $entertainementRepository): Response
    {
        return $this->render('admin_entertainement/index.html.twig', [
            'entertainements' => $entertainementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="entertainement_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $entertainement = new Entertainement();
        $form = $this->createForm(EntertainementType::class, $entertainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('entertainementImages')->getData();

            foreach ($images as $image) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move($this->getParameter('entertainements_images'), $imageName);
                $newImage = new EntertainementImage();
                $newImage->setName($imageName);
                $entertainement->addEntertainementImage($newImage);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entertainement);
            $entityManager->flush();

            return $this->redirectToRoute('admin_entertainement_index');
        }

        return $this->render('admin_entertainement/new.html.twig', [
            'entertainement' => $entertainement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entertainement_show", methods={"GET"})
     * @param Entertainement $entertainement
     * @return Response
     */
    public function show(Entertainement $entertainement): Response
    {
        return $this->render('admin_entertainement/show.html.twig', [
            'entertainement' => $entertainement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="entertainement_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Entertainement $entertainement
     * @return Response
     */
    public function edit(Request $request, Entertainement $entertainement): Response
    {
        $form = $this->createForm(EntertainementType::class, $entertainement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('entertainementImages')->getData();

            foreach ($images as $image) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move($this->getParameter('entertainements_images'), $imageName);
                $newImage = new EntertainementImage();
                $newImage->setName($imageName);
                $entertainement->addEntertainementImage($newImage);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_entertainement_index');
        }

        return $this->render('admin_entertainement/edit.html.twig', [
            'entertainement' => $entertainement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="entertainement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Entertainement $entertainement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$entertainement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entertainement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_entertainement_index');
    }

    /**
     * @Route("entertainement/delete/entertainementImage/{id}", name="entertainement_image_delete", methods={"DELETE"})
     */
    public function deleteWilferImage(entertainementImage $entertainementImage, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        // vérifier si le token envoyé correspond bien a celui de l'image en question
        if ($this->isCsrfTokenValid('delete' . $entertainementImage->getId(), $data['_token'])) {
            // récupérer le nom de l'image  le supprimer du disque et de la bdd
            $imageName = $entertainementImage->getName();
            unlink($this->getParameter('entertainements_images') . '/' . $imageName);
            $em = $this->getDoctrine()->getManager();
            $em->remove($entertainementImage);
            $em->flush();

            // donner une réponse en JSON
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token invalide'], 400);
        }
    }
}
