<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeanceController extends AbstractController
{
    #[Route('/add-seance', name: 'add_seance')]
    public function addSeance(): Response
    {
        return $this->render('add_seance.html.twig');
    }
}