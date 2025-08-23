<?php

namespace App\Controller;

use App\SQL\PersAccessFirstInLastOut;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dashboard/pers-access-stats')]
class PersAccessStatsController extends AbstractController
{
    #[Route('/', name: 'pers_access_stats_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em): Response
    {
        $now = new \DateTime();
        $connection = $em->getConnection();
        // Récupérer tous les clients distincts
        $sqlScript = PersAccessFirstInLastOut::getPersonList();
        $stmt = $connection->prepare($sqlScript);
        $result = $stmt->executeQuery();
        $persListResult = $result->fetchAllAssociative();

        $persListData = [];
        foreach ($persListResult as $item) {
            if (empty($item['pin'])) {
                continue;
            }
            if (empty(trim($item['full_name']))) {
                continue;
            }
            $persListData[$item['pin']] = $item['full_name'];
        }

        return $this->render('pers_access_stats/index.html.twig', [
            'clients' => $persListData,
            'currentYear' => $now->format('Y'),
            'today' => $now
        ]);
    }

    #[Route('/yearly', name: 'pers_access_stats_yearly', methods: ['GET'])]
    public function yearlyStatsByPers(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $pinPers = $request->query->get('pin');
        if (empty($pinPers)) {
            return $this->json([
                'message' => 'Bad request !',
            ], Response::HTTP_BAD_REQUEST);
        }
        $now = new \DateTime();
        $currentYear = $now->format('Y');
        $connection = $em->getConnection();
        $sqlScript = PersAccessFirstInLastOut::getYearlyAccessStatsByPin();
        $stmt = $connection->prepare($sqlScript);
        $stmt->bindValue(':pin', $pinPers);
        $stmt->bindValue(':currentYear', $currentYear);
        $result = $stmt->executeQuery();
        $accessYearlyResult = $result->fetchAllAssociative();

        $responseData = array_fill_keys(range(0, 11), 0);
        foreach ($accessYearlyResult as $item) {
            $responseData[(int)$item['month_num'] - 1] = $item['total'];
        }

        return $this->json($responseData, Response::HTTP_OK);
    }

    #[Route('/weekly', name: 'pers_access_stats_weekly', methods: ['GET'])]
    public function weeklyStatsByPers(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $dateStr = $request->query->get('date');
        if (empty($dateStr)) {
            return $this->json([
                'message' => 'Bad request !',
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            $date = (new \DateTime())::createFromFormat('d/m/Y', $dateStr);
        } catch (\Exception $e) {
            return $this->json([
                'message' => 'Bad request !',
            ], Response::HTTP_BAD_REQUEST);
        }

        // Calculer lundi et dimanche de la semaine
        $dayOfWeek = (int)$date->format('N'); // 1 = lundi, 7 = dimanche
        $monday = (clone $date)->modify('-' . ($dayOfWeek - 1) . ' days');
        $sunday = (clone $monday)->modify('+6 days');

        $connection = $em->getConnection();
        $sqlScript = PersAccessFirstInLastOut::getWeeklyAccessStats();
        $stmt = $connection->prepare($sqlScript);
        $stmt->bindValue(':monday', $monday->format('Y-m-d'));
        $stmt->bindValue(':sunday', $sunday->format('Y-m-d'));
        $result = $stmt->executeQuery();
        $accessWeeklyResult = $result->fetchAllAssociative();

        // Préparer labels et data
        $data = [];
        $dayMap = [];
        foreach ($accessWeeklyResult as $row) {
            $dayMap[$row['day_date']] = (int)$row['total'];
        }

        $current = clone $monday;
        while ($current <= $sunday) {
            $data[] = $dayMap[$current->format('Y-m-d')] ?? 0;
            $current->modify('+1 day');
        }

        return new JsonResponse([
            'data' => $data,
            'weekRange' => $monday->format('d/m/Y') . ' ➔ ' . $sunday->format('d/m/Y')
        ], Response::HTTP_OK);
    }

    #[Route('/monthly', name: 'pers_access_stats_monthly', methods: ['GET'])]
    public function monthlyStatsByPers(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $selectedYear = $request->query->get('year');
        if (empty($selectedYear) && !is_int($selectedYear)) {
            return $this->json([
                'message' => 'Bad request !',
            ], Response::HTTP_BAD_REQUEST);
        }

        $connection = $em->getConnection();
        $sqlScript = PersAccessFirstInLastOut::getMonthlyAccessStatsByYear();
        $stmt = $connection->prepare($sqlScript);
        $stmt->bindValue(':selectedYear', $selectedYear);
        $result = $stmt->executeQuery();
        $accessMonthlyResult = $result->fetchAllAssociative();

        // Initialiser tableau de 12 mois
        $data = array_fill(0, 12, 0);
        foreach ($accessMonthlyResult as $row) {
            $index = (int)$row['month_num'] - 1;
            $data[$index] = (int)$row['total'];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }

}
