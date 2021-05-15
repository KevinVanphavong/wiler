<?php


namespace App\Controller;

use App\Entity\Wilfer;
use App\Form\SearchWilferType;
use App\Repository\PlaylistRepository;
use App\Repository\WilferRepository;
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

        return $this->redirectToRoute('wilfers');
    }
}
