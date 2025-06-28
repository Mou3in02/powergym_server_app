<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/dashboard')]
class DashboardController extends AbstractController
{
    #[Route(path: '/index', name: 'dashboard_index')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}