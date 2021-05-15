<?php


namespace App\Controller;


use App\Repository\EntertainementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param EntertainementRepository $entertainementRepository
     * @return Response
     */
    public function index(EntertainementRepository $entertainementRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'entertainements' => $entertainementRepository->findAllExceptOther()
        ]);
    }
}
