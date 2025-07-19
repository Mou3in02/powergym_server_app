<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SessionController extends AbstractController
{
    #[Route('/add-session', name: 'add_session')]
    public function addSession(): Response
    {
        return $this->render('add_session.html.twig');
    }
}