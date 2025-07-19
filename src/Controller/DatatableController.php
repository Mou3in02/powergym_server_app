<?php

// src/Controller/DatatableController.php

namespace App\Controller;

use App\Entity\SessionPers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class DatatableController extends AbstractController
{
    #[Route('/datatable', name: 'app_datatable')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $seances = $entityManager->getRepository(SessionPers::class)->findAll();

        return $this->render('tables/data.html.twig', [
            'seances' => $seances,
        ]);
    }
}

