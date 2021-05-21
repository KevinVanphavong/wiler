<?php


namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @IsGranted("ROLE_USER")
 * @package App\Controller
 */
class UserController extends AbstractController
{
    /**
     * @Route("account/{id}", name="account")
     */
    public function index(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Vos informations ont bien été modifées !');
            return $this->redirectToRoute('account', ['id' => $user->getId()]);
        }
        return $this->render('user/index.html.twig', [
            "formUser" => $form->createView()
        ]);
    }
}
