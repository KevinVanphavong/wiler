<?php

namespace App\Controller;

use App\Entity\Wilfer;
use App\Entity\WilferImage;
use App\Form\WilferType;
use App\Repository\WilferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminWilferController extends AbstractController
{
    /**
     * @Route("/wilfer", name="wilfer_index", methods={"GET"})
     * @param WilferRepository $wilferRepository
     * @return Response
     */
    public function index(WilferRepository $wilferRepository): Response
    {
        return $this->render('admin_wilfer/index.html.twig', [
            'wilfers' => $wilferRepository->findAll(),
        ]);
    }

    /**
     * @Route("/wilfer/new", name="wilfer_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $wilfer = new Wilfer();
        $form = $this->createForm(WilferType::class, $wilfer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('wilferImages')->getData();

            foreach ($images as $image) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move($this->getParameter('wilfers_images'), $imageName);
                $newImage = new WilferImage();
                $newImage->setName($imageName);
                $wilfer->addWilferImage($newImage);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($wilfer);
            $entityManager->flush();

            return $this->redirectToRoute('admin_wilfer_index');
        }

        return $this->render('admin_wilfer/new.html.twig', [
            'wilfer' => $wilfer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/wilfer/{id}/show", name="wilfer_show", methods={"GET"})
     * @param Wilfer $wilfer
     * @return Response
     */
    public function show(Wilfer $wilfer): Response
    {
        return $this->render('admin_wilfer/show.html.twig', [
            'wilfer' => $wilfer,
        ]);
    }

    /**
     * @Route("/wilfer/{id}/edit", name="wilfer_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Wilfer $wilfer
     * @return Response
     */
    public function edit(Request $request, Wilfer $wilfer): Response
    {
        $form = $this->createForm(WilferType::class, $wilfer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('wilferImages')->getData();

            foreach ($images as $image) {
                $imageName = md5(uniqid()) . '.' . $image->guessExtension();
                $image->move($this->getParameter('wilfers_images'), $imageName);
                $newImage = new WilferImage();
                $newImage->setName($imageName);
                $wilfer->addWilferImage($newImage);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_wilfer_index');
        }

        return $this->render('admin_wilfer/edit.html.twig', [
            'wilfer' => $wilfer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("wilfer/{id}/delete", name="wilfer_delete", methods={"DELETE"})
     * @param Request $request
     * @param Wilfer $wilfer
     * @return Response
     */
    public function delete(Request $request, Wilfer $wilfer): Response
    {
        if ($this->isCsrfTokenValid('delete' . $wilfer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($wilfer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_wilfer_index');
    }

    /**
     * @Route("wilfer/delete/wilferImage/{id}", name="wilfer_image_delete", methods={"DELETE"})
     */
    public function deleteWilferImage(WilferImage $wilferImage, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        // vérifier si le token envoyé correspond bien a celui de l'image en question
        if ($this->isCsrfTokenValid('delete' . $wilferImage->getId(), $data['_token'])) {
            // récupérer le nom de l'image  le supprimer du disque et de la bdd
            $imageName = $wilferImage->getName();
            unlink($this->getParameter('wilfers_images') . '/' . $imageName);
            $em = $this->getDoctrine()->getManager();
            $em->remove($wilferImage);
            $em->flush();

            // donner une réponse en JSON
            return new JsonResponse(['success' => 1]);
        } else {
            return new JsonResponse(['error' => 'Token invalide'], 400);
        }
    }
}
