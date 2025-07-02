<?php

namespace App\Controller;

use App\Entity\SeancePers;
use App\Form\SeancePersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeancePersController extends AbstractController
{
    #[Route('/seance/add', name: 'seance_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $seance = new SeancePers();
        $seance->setDateTime(new \DateTime()); // Valeur par défaut

        $form = $this->createForm(SeancePersType::class, $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($seance);
            $em->flush();

            $this->addFlash('success', 'Séance ajoutée avec succès');
            return $this->redirectToRoute('seance_add');
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            // Le formulaire est soumis mais invalide
            $this->addFlash('danger', 'retapez les champs de formulaire!');
        }


        return $this->render('add_seance.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
