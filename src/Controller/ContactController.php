<?php


namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;


class ContactController extends AbstractController
{
    /**
     * @Route("/contact-us", name="contact")
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        
        // dump(
            //     gettype($form->get('duration')->getData()),
            //     $form->get('duration')->getData(),
            //     gettype($form->get('events')->getData()),
            //     $form->get('events')->getData(),
            // );die();
            
        if ($form->isSubmitted() && $form->isValid()) {
            $reason = $form->get('events')->getData()->getName();
            $email = (new Email())
                ->from($contact->getEmail())
                ->to($this->getParameter('mailer_admin'))
                ->subject($reason)
                ->html($this->renderView('contact/mail.html.twig', [
                    'contact' => $contact,
                    'reason' => $reason,
                    'wilfers' => $form->get('wilfers')->getData(),
                    'event' => $form->get('events')->getData(),
                    'duration' => $form->get('duration')->getData(),
                ]));
            $mailer->send($email);
            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('home');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
