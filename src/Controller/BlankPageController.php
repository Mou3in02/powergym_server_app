<?php

// src/Controller/BlankPageController.php

// src/Controller/BlankPageController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlankPageController extends AbstractController
{
    #[Route('/blank', name: 'app_blank')]
    public function index(): Response
    {
        return $this->render('blank.html.twig');
    }
}
