<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChartController extends AbstractController
{
    #[Route('/chart', name: 'chart', methods: ['GET'])]
    public function chart(Request $request, Connection $connection): Response
    {
        // Si la requête est AJAX (fetch JS) -> on renvoie les données du donut chart hebdo en JSON
        if ($request->query->has('date')) {
            $dateParam = $request->query->get('date');

            if ($dateParam) {
                try {
                    $selectedDate = new \DateTime($dateParam);
                } catch (\Exception $e) {
                    $selectedDate = new \DateTime();
                }
            } else {
                $selectedDate = new \DateTime();
            }

            $monday = (clone $selectedDate)->modify('monday this week')->setTime(0, 0, 0);
            $sunday = (clone $monday)->modify('+6 days')->setTime(23, 59, 59);

            // Nouvelle requête : nombre de clients par jour
            $sql = "
                SELECT TO_CHAR(date_time, 'Day') AS day_label,
                       TO_CHAR(date_time, 'YYYY-MM-DD') AS day_date,
                       COUNT(*) AS total
                FROM session_pers
                WHERE date_time BETWEEN :start AND :end
                GROUP BY day_label, day_date
                ORDER BY day_date
            ";

            $stmt = $connection->prepare($sql);
            $results = $stmt->executeQuery([
                'start' => $monday->format('Y-m-d 00:00:00'),
                'end' => $sunday->format('Y-m-d 23:59:59'),
            ])->fetchAllAssociative();

            // Générer les jours même s'ils sont absents
            $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
            $labels = [];
            $data = [];

            foreach ($days as $day) {
                $labels[] = ucfirst($day);
                $found = false;
                foreach ($results as $row) {
                    if (trim(strtolower($row['day_label'])) === strtolower($day)) {
                        $data[] = (int) $row['total'];
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $data[] = 0;
                }
            }

            return new JsonResponse(['labels' => $labels, 'data' => $data]);
        }

        // Sinon : requête normale -> on renvoie la page avec les données mensuelles
        $sql = "
            SELECT 
                TO_CHAR(date_time, 'MM') AS month_number,
                TO_CHAR(date_time, 'TMMonth') AS month_name,
                COUNT(*) AS total
            FROM session_pers
            GROUP BY TO_CHAR(date_time, 'MM'), TO_CHAR(date_time, 'TMMonth')
            ORDER BY TO_CHAR(date_time, 'MM')::int
        ";

        $data = $connection->fetchAllAssociative($sql);

        $allMonths = [
            '01' => 'Janvier', '02' => 'Février', '03' => 'Mars',
            '04' => 'Avril', '05' => 'Mai', '06' => 'Juin',
            '07' => 'Juillet', '08' => 'Août', '09' => 'Septembre',
            '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre',
        ];

        $dataMap = [];
        foreach ($data as $row) {
            $dataMap[$row['month_number']] = (int)$row['total'];
        }

        $labels = [];
        $values = [];
        foreach ($allMonths as $num => $name) {
            $labels[] = $name;
            $values[] = $dataMap[$num] ?? 0;
        }

        return $this->render('chart.html.twig', [
            'labels' => json_encode($labels),
            'values' => json_encode($values),
        ]);
    }
}
