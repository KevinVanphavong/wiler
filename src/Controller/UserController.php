<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class UserController
 * @IsGranted("ROLE_USER")
 * @package App\Controller
 */
class UserController extends AbstractController
{
    /**
     * @Route("account", name="account")
     */
    public function index()
    {
        return $this->render('user/index.html.twig');
    }
}
