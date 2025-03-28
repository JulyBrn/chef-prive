<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use LDAP\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomePageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contacts = new Contacts();
        $form = $this->createForm( ContactType::class, $contacts );
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($contacts);
            $entityManager->flush();
            $this->addFlash('success', 'J\'ai bien reçu votre message, je vous recontacterai dans les plus brefs délais.');
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
