<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use LDAP\Result;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class HomePageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $contacts = new Contacts();
        $form = $this->createForm( ContactType::class, $contacts );
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            // Envoi de l'email
            $emailtosend = (new TemplatedEmail())
                ->from($contacts->getEmail())
                ->to('contact@demo.fr')
                ->subject('Demande de contact')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([ 'data' => $contacts ]);
            $mailer->send($emailtosend);
            
            // Enregistrement dans la base de données
            $entityManager->persist($contacts);
            $entityManager->flush();
            $this->addFlash('success', 'Votre message a bien été envoyé !');
            
            return $this->redirect($this->generateUrl('home').'#contact-form'); 
        }

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'form' => $form,
        ]);
    }
    
    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('about/index.html.twig');
    }

    #[Route('/prestations', name: 'prestations')]
    public function prestation(): Response
    {
        return $this->render('prestations/index.html.twig');
    }

    #[Route('/gallery', name: 'gallery')]
    public function gallery(): Response
    {
        return $this->render('gallery/index.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->redirect($this->generateUrl('home').'#contact-form');
    }

}
