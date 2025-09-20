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

    #[Route('/payment/charts', name: 'app_payment_charts')]
    public function charts(PaymentRepository $paymentRepository, Request $request): Response
    {
        $sessions = $paymentRepository->findSessionsWithPerson();

        // --- Graphique hebdomadaire ---
        $weekDate = $request->query->get('weekDate') ?: (new \DateTime())->format('Y-m-d');
        $selectedDate = new \DateTime($weekDate);
        $dayOfWeek = (int)$selectedDate->format('N'); // 1=lundi ... 7=dimanche
        $monday = (clone $selectedDate)->modify('-'.($dayOfWeek - 1).' days');
        $sunday = (clone $monday)->modify('+6 days');

        $weekLabels = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
        $byWeek = array_fill(0, 7, 0);

        foreach ($sessions as $session) {
            $startDate = $session->getStartTime();
            if (!$startDate) continue;
            if ($startDate >= $monday && $startDate <= $sunday) {
                $dayIndex = ((int)$startDate->format('N')) - 1; // 0 = lundi
                $byWeek[$dayIndex]++;
            }
        }

        // --- Graphique par mois ---
        $year = $request->query->get('year') ?: (new \DateTime())->format('Y');
        $months = array_fill(1, 12, 0);
        $monthNames = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
        $months = array_fill(1, 12, 0);

        foreach ($sessions as $session) {
            $startDate = $session->getStartTime();
            if (!$startDate) continue;
            if ($startDate->format('Y') == $year) {
                $months[(int)$startDate->format('n')]++;
            }
        }

        // --- Graphique par années ---
        $byYear = [];
        foreach ($sessions as $session) {
            $startDate = $session->getStartTime();
            if (!$startDate) continue;
            $y = $startDate->format('Y');
            $byYear[$y] = ($byYear[$y] ?? 0) + 1;
        }
        ksort($byYear);

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'labelsWeek'   => $weekLabels,
                'valuesWeek'   => $byWeek,
                'labelsMonths' => $monthNames,
                'valuesMonths' => array_values($months),
                'labelsYears'  => array_keys($byYear),
                'valuesYears'  => array_values($byYear),
            ]);
        }

        return $this->render('payment/chart.html.twig', [
            'weekDate'       => $weekDate,
            'labelsWeek'     => json_encode($weekLabels),
            'valuesWeek'     => json_encode($byWeek),
            'currentYear'    => $year,
            'labelsMonths'   => json_encode($monthNames),
            'valuesMonths'   => json_encode(array_values($months)),
            'labelsYears'    => json_encode(array_keys($byYear)),
            'valuesYears'    => json_encode(array_values($byYear)),
        ]);
    }
}
