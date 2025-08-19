<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PersEntryController extends AbstractController
{
    #[Route('/dashboard/pers-entry/chart', name: 'pers_entry_chart')]
    public function chart(Request $request, Connection $connection): Response
    {
        // Récupérer tous les clients distincts
        $clients = $connection->fetchFirstColumn("
            SELECT DISTINCT TRIM(name) || ' ' || TRIM(last_name) AS full_name
            FROM acc_firstin_lastout
            ORDER BY full_name
        ");

        $selectedClient = $request->query->get('client');

        // Tableau fixe des mois en français
        $months = [
            '01' => 'Janvier',
            '02' => 'Février',
            '03' => 'Mars',
            '04' => 'Avril',
            '05' => 'Mai',
            '06' => 'Juin',
            '07' => 'Juillet',
            '08' => 'Août',
            '09' => 'Septembre',
            '10' => 'Octobre',
            '11' => 'Novembre',
            '12' => 'Décembre',
        ];

        $labels = array_values($months);
        $values = array_fill(0, 12, 0); // 12 mois = toutes valeurs à 0

        if ($selectedClient) {
            $parts = explode(' ', $selectedClient, 2);
            $firstName = $parts[0] ?? '';
            $lastName = $parts[1] ?? '';

            // Récupérer le nombre d’entrées groupées par mois
            $sql = "
                SELECT TO_CHAR(create_time, 'MM') AS month_num,
                       COUNT(*) AS total
                FROM acc_firstin_lastout
                WHERE TRIM(name) = :firstName
                  AND TRIM(last_name) = :lastName
                GROUP BY TO_CHAR(create_time, 'MM')
                ORDER BY TO_CHAR(create_time, 'MM')
            ";
            $rows = $connection->fetchAllAssociative($sql, [
                'firstName' => $firstName,
                'lastName' => $lastName,
            ]);

            foreach ($rows as $row) {
                $monthNum = $row['month_num']; // ex: '01'
                $index = (int)$monthNum - 1;
                $values[$index] = (int)$row['total'];
            }
        }

        return $this->render('pers_entry/chart.html.twig', [
            'clients' => $clients,
            'selectedClient' => $selectedClient,
            'labels' => json_encode($labels),
            'values' => json_encode($values),
            'today' => new \DateTime(),
        ]);
    }

    #[Route('/dashboard/pers-entry/weekly-chart', name: 'pers_entry_weekly_chart')]
    public function weeklyChart(Request $request, Connection $connection): JsonResponse
    {
        $dateStr = $request->query->get('date');
        $date = $dateStr ? new \DateTime($dateStr) : new \DateTime();

        // Calculer lundi et dimanche de la semaine
        $dayOfWeek = (int)$date->format('N'); // 1 = lundi, 7 = dimanche
        $monday = (clone $date)->modify('-' . ($dayOfWeek - 1) . ' days');
        $sunday = (clone $monday)->modify('+6 days');

        // Requête : compter le nombre de clients par jour
        $sql = "
            SELECT create_time::date AS day_date,
                   COUNT(*) AS total
            FROM acc_firstin_lastout
            WHERE create_time::date BETWEEN :monday AND :sunday
            GROUP BY create_time::date
            ORDER BY create_time::date
        ";
        $rows = $connection->fetchAllAssociative($sql, [
            'monday' => $monday->format('Y-m-d'),
            'sunday' => $sunday->format('Y-m-d'),
        ]);

        // Préparer labels et data
        $labels = [];
        $data = [];
        $dayMap = [];
        foreach ($rows as $row) {
            $dayMap[$row['day_date']] = (int)$row['total'];
        }

        $current = clone $monday;
        while ($current <= $sunday) {
            $labels[] = $current->format('l'); // Nom complet du jour en anglais
            $data[] = $dayMap[$current->format('Y-m-d')] ?? 0;
            $current->modify('+1 day');
        }

        return new JsonResponse([
            'labels' => $labels,
            'data' => $data,
            'week_range' => $monday->format('d/m/Y') . ' ➔ ' . $sunday->format('d/m/Y')
        ]);
    }
    #[Route('/dashboard/pers-entry/total-monthly', name: 'pers_entry_total_monthly')]
    public function totalMonthly(Connection $connection): JsonResponse
    {
        // Requête : compter toutes les entrées par mois
        $sql = "
        SELECT TO_CHAR(create_time, 'MM') AS month_num,
               COUNT(*) AS total
        FROM acc_firstin_lastout
        GROUP BY TO_CHAR(create_time, 'MM')
        ORDER BY TO_CHAR(create_time, 'MM')
    ";
        $rows = $connection->fetchAllAssociative($sql);

        // Initialiser tableau de 12 mois
        $data = array_fill(0, 12, 0);
        foreach ($rows as $row) {
            $index = (int)$row['month_num'] - 1;
            $data[$index] = (int)$row['total'];
        }

        return new JsonResponse(['data' => $data]);
    }

}
