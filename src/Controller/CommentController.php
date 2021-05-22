<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Wilfer;
use App\Form\Comment1Type;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CommentController extends AbstractController
{
    /**
     * @Route("/admin/comment", name="admin_comment_index", methods={"GET"})
     */
    public function index(CommentRepository $commentRepository): Response
    {
        return $this->render('admin_comment/index.html.twig', [
            'comments' => $commentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/comment/new", name="comment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin_comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/comment/{id}", name="admin_comment_show", methods={"GET"})
     */
    public function show(Comment $comment): Response
    {
        return $this->render('admin_comment/show.html.twig', [
            'comment' => $comment,
        ]);
    }

    /**
     * @Route("/admin/comment/{commentId}/edit/wilfer/{wilferId}", name="admin_comment_edit", methods={"GET","POST"})
     * @ParamConverter("wilfer", class="App\Entity\Wilfer", options={"mapping": {"wilferId": "id"}})
     * @ParamConverter("comment", class="App\Entity\Comment", options={"mapping": {"commentId": "id"}})
     */
    public function edit(Request $request, Comment $comment, Wilfer $wilfer): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin_comment/edit.html.twig', [
            'comment' => $comment,
            'wilfer' => $wilfer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/comment/{commentId}/delete/wilfer/{wilferId}", name="comment_delete", methods={"DELETE"})
     * @ParamConverter("wilfer", class="App\Entity\Wilfer", options={"mapping": {"wilferId": "id"}})
     * @ParamConverter("comment", class="App\Entity\Comment", options={"mapping": {"commentId": "id"}})
     */
    public function delete(Request $request, Comment $comment, Wilfer $wilfer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comment);
            $entityManager->flush();
        }
        
        if($request->request->get('_route') == "admin_comment_edit" || $request->request->get('_route') == "admin_dashboard"){
            return $this->redirectToRoute('admin_dashboard');
        } else {
            return $this->redirectToRoute('wilfer_id_show', ['id' => $wilfer->getId()]);
        }
    }
}
