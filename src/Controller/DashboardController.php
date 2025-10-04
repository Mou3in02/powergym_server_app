<?php

namespace App\Controller;

use App\Entity\PersSession;
use App\Entity\User;
use App\SQL\PersAccessFirstInLastOut;
use App\SQL\PersPersonSQL;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/dashboard')]
#[IsGranted("ROLE_ADMIN")]
class DashboardController extends AbstractController
{
    #[Route(path: '/index', name: 'dashboard_index')]
    public function index(EntityManagerInterface $em): Response
    {
        $today = (new \DateTime())->setTime(0, 0);

        $connection = $em->getConnection();

        $sqlScript = PersPersonSQL::count();
        $stmt = $connection->prepare($sqlScript);
        $result = $stmt->executeQuery();
        $nbPersonnes = $result->fetchNumeric();

        $nbAdmin = $em->getRepository(User::class)->countByRole(User::ROLE_ADMIN);

        $nbSeance = $em->getRepository(PersSession::class)->countSessionByDate($today->format('Y-m-d'));

        $sqlScript = PersAccessFirstInLastOut::countAccessByDate();
        $stmt = $connection->prepare($sqlScript);
        $stmt->bindValue(':customDate', $today->format('Y-m-d'));
        $result = $stmt->executeQuery();
        $nbAccessToday = $result->fetchNumeric();

        return $this->render('index.html.twig', [
            'nbPersonnes' => $nbPersonnes[0] ?? 0,
            'nbAdmin' => $nbAdmin,
            'nbSeance' => $nbSeance,
            'nbAccessToday' => $nbAccessToday[0] ?? 0,
        ]);
    }

    #[Route(path: '/weekly-data', name: 'dashboard_weekly_data')]
    public function getWeeklyData(EntityManagerInterface $em): JsonResponse
    {
        $today = new \DateTime();

        $startOfWeek = (clone $today)->modify('monday this week')->setTime(0, 0, 0);
        $endOfWeek = (clone $today)->modify('sunday this week')->setTime(23, 59, 59);

        $conn = $em->getConnection();

        $sql = '
        SELECT 
            EXTRACT(DOW FROM create_time) AS day_of_week,
            COUNT(*) AS nb_clients
        FROM app_payment
        WHERE create_time BETWEEN :start AND :end
        GROUP BY day_of_week
        UNION ALL
        SELECT 
            EXTRACT(DOW FROM start_time) AS day_of_week,
            COUNT(*) AS nb_clients
        FROM app_payment
        WHERE start_time BETWEEN :start AND :end
        GROUP BY day_of_week
    ';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('start', $startOfWeek->format('Y-m-d H:i:s'));
        $stmt->bindValue('end', $endOfWeek->format('Y-m-d H:i:s'));
        $result = $stmt->executeQuery()->fetchAllAssociative();
        $weeklyData = array_fill(0, 7, 0);
        foreach ($result as $row) {
            $dayIndex = (int)$row['day_of_week'];
            $dayIndex = $dayIndex === 0 ? 6 : $dayIndex - 1;
            $weeklyData[$dayIndex] += (int)$row['nb_clients'];
        }

        return new JsonResponse($weeklyData);
    }

}
