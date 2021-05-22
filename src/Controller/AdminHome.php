<?php


namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Entertainement;
use App\Entity\Faq;
use App\Entity\Wilfer;
use App\Form\CommentType;
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
        $faqs = $this->getDoctrine()
        ->getRepository(Faq::class)
        ->findAll();
    
        $wilfers = $this->getDoctrine()
        ->getRepository(Wilfer::class)
        ->findAll();
    
        $entertainements = $this->getDoctrine()
        ->getRepository(Entertainement::class)
        ->findAll();
    
        $comments = $this->getDoctrine()
        ->getRepository(Comment::class)
        ->findAll();

        return $this->render('admin/index.html.twig', [
            'faqs' => $faqs,
            'wilfers' => $wilfers,
            'comments' => $comments,
            'entertainements' => $entertainements,
        ]);
    }

}

