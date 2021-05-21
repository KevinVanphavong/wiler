<?php


namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Wilfer;
use App\Form\CommentType;
use App\Form\SearchWilferType;
use App\Repository\CommentRepository;
use App\Repository\PlaylistRepository;
use App\Repository\WilferRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class WilfersController extends AbstractController
{
    /**
     * @Route("/wilfers", name="wilfers")
     * @param Request $request
     * @param WilferRepository $wilferRepository
     * @return Response
     */
    public function index(Request $request, WilferRepository $wilferRepository):Response
    {
        $form = $this->createForm(SearchWilferType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $wilfers = $wilferRepository->findWithSpecialRequest($search);
        } else {
            $wilfers = $wilferRepository->findAll();
        }

            return $this->render('wilfers/index.html.twig', [
            'wilfers' => $wilfers,
            'searchWilfer' => $form->createView()
        ]);
    }

    /**
     * @Route("/wilfer/{id}/show", name="wilfer_id_show")
     */
    public function showWilfer(Request $request, Wilfer $wilfer):Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $comment->setWilfer($wilfer);
            $comment->setAuthor($this->getUser());
            $comment->setDate(new DateTime());
            $entityManager->persist($comment);
            $entityManager->flush();
            return $this->redirectToRoute('wilfer_id_show', ['id' => $wilfer->getId()]);
        }

        return $this->render('wilfers/show.html.twig', [
            'wilfer' => $wilfer,
            'formComment' => $form->createView()
        ]);
    }

    /**
     * @Route("wilfer/{id}/favorites", name="wilfer_favorites")
     * @param Wilfer $wilfer
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function addToFavorites(Wilfer $wilfer, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()->getFavoritesWilfers()->contains($wilfer)) {
            $this->getUser()->removeFavoritesWilfer($wilfer);
        } else {
            $this->getUser()->addFavoritesWilfer($wilfer);
        }

        $entityManager->flush();

        return $this->json([
            'isInFavoritesWilfer' => $this->getUser()->isInFavoritesWilfer($wilfer)
        ]);
    }
}
