<?php

namespace App\Controller;

use App\Repository\PaymentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment_index')]
    public function index(PaymentRepository $paymentRepository): Response
    {
        $sessions = $paymentRepository->findSessionsWithPerson();
        $currentYear = (new \DateTime())->format('Y');

        return $this->render('payment/index.html.twig', [
            'sessions' => $sessions,
            'currentYear' => $currentYear,
        ]);
    }

    /**
     * ✅ Page Statistiques (contient les 3 graphiques)
     */
    #[Route('/payment/charts', name: 'app_payment_charts')]
    public function charts(PaymentRepository $paymentRepository): Response
    {
        $sessions = $paymentRepository->findSessionsWithPerson();

        // Préparer la semaine courante
        $today = new \DateTime();
        $dayOfWeek = (int)$today->format('N');
        $monday = (clone $today)->modify('-'.($dayOfWeek - 1).' days');
        $sunday = (clone $monday)->modify('+6 days');

        $labelsWeek = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
        $valuesWeek = array_fill(0, 7, 0);

        foreach ($sessions as $session) {
            $startDate = $session->getStartTime();
            if ($startDate && $startDate >= $monday && $startDate <= $sunday) {
                $dayIndex = ((int)$startDate->format('N')) - 1;
                $valuesWeek[$dayIndex]++;
            }
        }

        // Mois (année courante)
        $currentYear = (new \DateTime())->format('Y');
        $labelsMonths = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
        $valuesMonths = array_fill(1, 12, 0);

        foreach ($sessions as $session) {
            $startDate = $session->getStartTime();
            if ($startDate && $startDate->format('Y') == $currentYear) {
                $valuesMonths[(int)$startDate->format('n')]++;
            }
        }

        // Années
        $dataYears = [];
        foreach ($sessions as $session) {
            $startDate = $session->getStartTime();
            if ($startDate) {
                $y = $startDate->format('Y');
                $dataYears[$y] = ($dataYears[$y] ?? 0) + 1;
            }
        }
        ksort($dataYears);

        return $this->render('payment/chart.html.twig', [
            // 👇 ajout du weekDate pour le champ input
            'weekDate'     => $today->format('Y-m-d'),

            'labelsWeek'   => json_encode($labelsWeek),
            'valuesWeek'   => json_encode($valuesWeek),
            'labelsMonths' => json_encode($labelsMonths),
            'valuesMonths' => json_encode(array_values($valuesMonths)),
            'labelsYears'  => json_encode(array_keys($dataYears)),
            'valuesYears'  => json_encode(array_values($dataYears)),
            'currentYear'  => $currentYear,
        ]);
    }

    /**
     * ✅ API - Semaine
     */
    #[Route('/payment/chart/week', name: 'app_payment_chart_week')]
    public function chartWeek(PaymentRepository $paymentRepository, Request $request): JsonResponse
    {
        $sessions = $paymentRepository->findSessionsWithPerson();

        $weekDate = $request->query->get('weekDate') ?: (new \DateTime())->format('Y-m-d');
        $selectedDate = new \DateTime($weekDate);
        $dayOfWeek = (int)$selectedDate->format('N');
        $monday = (clone $selectedDate)->modify('-'.($dayOfWeek - 1).' days');
        $sunday = (clone $monday)->modify('+6 days');

        $labels = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
        $values = array_fill(0, 7, 0);

        foreach ($sessions as $session) {
            $startDate = $session->getStartTime();
            if ($startDate && $startDate >= $monday && $startDate <= $sunday) {
                $dayIndex = ((int)$startDate->format('N')) - 1;
                $values[$dayIndex]++;
            }
        }

        return new JsonResponse([
            'labels' => $labels,
            'values' => $values,
        ]);
    }

    /**
     * ✅ API - Mois
     */
    #[Route('/payment/chart/month', name: 'app_payment_chart_month')]
    public function chartMonth(PaymentRepository $paymentRepository, Request $request): JsonResponse
    {
        $sessions = $paymentRepository->findSessionsWithPerson();

        $year = $request->query->get('year') ?: (new \DateTime())->format('Y');
        $labels = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
        $values = array_fill(1, 12, 0);

        foreach ($sessions as $session) {
            $startDate = $session->getStartTime();
            if ($startDate && $startDate->format('Y') == $year) {
                $values[(int)$startDate->format('n')]++;
            }
        }

        return new JsonResponse([
            'labels' => $labels,
            'values' => array_values($values),
        ]);
    }

    /**
     * ✅ API - Année
     */
    #[Route('/payment/chart/year', name: 'app_payment_chart_year')]
    public function chartYear(PaymentRepository $paymentRepository): JsonResponse
    {
        $sessions = $paymentRepository->findSessionsWithPerson();

        $data = [];
        foreach ($sessions as $session) {
            $startDate = $session->getStartTime();
            if ($startDate) {
                $y = $startDate->format('Y');
                $data[$y] = ($data[$y] ?? 0) + 1;
            }
        }
        ksort($data);

        return new JsonResponse([
            'labels' => array_keys($data),
            'values' => array_values($data),
        ]);
    }
}
