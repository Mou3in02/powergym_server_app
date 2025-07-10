<?php

namespace App\Controller;

use App\Entity\SessionPers;
use App\Form\SessionPersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SessionPersController extends AbstractController
{
    #[Route('/add-session', name: 'add_session')]
    public function addSession(Request $request, EntityManagerInterface $em): Response
    {
        $session = new SessionPers();
        $form = $this->createForm(SessionPersType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->setCreatedBy($this->getUser());


            $session->setDateTime(new \DateTime());

            $em->persist($session);
            $em->flush();

            $this->addFlash('success', 'Séance ajoutée avec succès.');

            return $this->redirectToRoute('add_session');
        }

        return $this->render('add_session.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}