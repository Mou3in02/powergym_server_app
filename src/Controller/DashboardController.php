<?php

namespace App\Controller;

use App\Entity\PersSession;
use App\Entity\User;
use App\SQL\PersAccessFirstInLastOut;
use App\SQL\PersPersonSQL;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/dashboard')]
#[IsGranted("ROLE_ADMIN")]
class DashboardController extends AbstractController
{
    #[Route(path: '/index', name: 'dashboard_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $now = new \DateTime();
        $connection = $em->getConnection();
        $sqlScript = PersPersonSQL::count();
        $stmt = $connection->prepare($sqlScript);
        $result = $stmt->executeQuery();
        $nbPersonnes = $result->fetchNumeric();

        $nbAdmin = $em->getRepository(User::class)->findByRoles(User::ROLE_ADMIN);
        // TODO: only current day
        $nbSeance = $em->getRepository(PersSession::class)->count(['isDeleted' => false]);

        $sqlScript = PersAccessFirstInLastOut::countAccessByDate();
        $stmt = $connection->prepare($sqlScript);
        $stmt->bindValue(':customDate', $now->format('Y-m-d'));
        $result = $stmt->executeQuery();
        $nbAccessToday = $result->fetchNumeric();

        return $this->render('index.html.twig', [
            'nbPersonnes' => $nbPersonnes[0],
            'nbAccessToday' => $nbAccessToday[0],
            'nbAdmin' => $nbAdmin,
            'nbSeance' => $nbSeance,
        ]);
    }
}