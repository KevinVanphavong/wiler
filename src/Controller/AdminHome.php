<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class AdminHome
 * @package App\Controller
 * @IsGranted("ROLE_ADMIN")
 */
class AdminHome extends AbstractController
{
    /**
     * @Route("admin/dashboard", name="admin_dashboard")
     */
    public function dashboard()
    {
        return $this->render('admin/index.html.twig');
    }

}

