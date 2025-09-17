<?php

namespace App\Controller;

use App\Entity\PersSession;
use App\Form\PersSessionType;
use App\SQL\PersSessionSQL;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/dashboard')]
#[IsGranted("ROLE_ADMIN")]
class PersSessionController extends AbstractController
{
    #[Route('/pers-session/index', name: 'pers_session_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $seances = $entityManager->getRepository(PersSession::class)->findBy(['isDeleted' => false]);

        return $this->render('pers_session/index.html.twig', [
            'seances' => $seances,
        ]);
    }

    #[Route('/pers-session/add', name: 'pers_session_add', methods: ['POST', 'GET'])]
    public function addSession(Request $request, EntityManagerInterface $em): Response
    {
        $session = new PersSession();
        $form = $this->createForm(PersSessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->setCreatedBy($this->getUser());
            $session->setCreatedAt(new \DateTime());

            $em->persist($session);
            $em->flush();

            $this->addFlash('success', 'Séance ajoutée avec succès.');

            return $this->redirectToRoute('pers_session_add');
        }

        return $this->render('pers_session/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/pers-session/chart', name: 'pers_session_chart', methods: ['GET'])]
    public function chart(Request $request, Connection $connection): Response
    {
        // 📊 Cas AJAX pour graphique hebdomadaire
        if ($request->query->has('date')) {
            $dateParam = $request->query->get('date');

            $selectedDate = $dateParam ? \DateTime::createFromFormat('Y-m-d', $dateParam) : new \DateTime();
            if (!$selectedDate) {
                $selectedDate = new \DateTime();
            }

            $monday = (clone $selectedDate)->modify('monday this week')->setTime(0, 0, 0);
            $sunday = (clone $monday)->modify('+6 days')->setTime(23, 59, 59);

            $sql = PersSessionSQL::getWeeklyChartBar();
            $stmt = $connection->prepare($sql);
            $results = $stmt->executeQuery([
                'start' => $monday->format('Y-m-d 00:00:00'),
                'end' => $sunday->format('Y-m-d 23:59:59'),
            ])->fetchAllAssociative();

            $days = [
                'Monday'    => 'Lundi',
                'Tuesday'   => 'Mardi',
                'Wednesday' => 'Mercredi',
                'Thursday'  => 'Jeudi',
                'Friday'    => 'Vendredi',
                'Saturday'  => 'Samedi',
                'Sunday'    => 'Dimanche'
            ];
            $labels = [];
            $data = [];

            $labels = [];
            $data = [];

            foreach ($days as $eng => $fr) {
                $labels[] = $fr;
                $found = false;
                foreach ($results as $row) {
                    $dbDay = trim($row['day_label']); // Postgres ajoute des espaces
                    if (strtolower($dbDay) === strtolower($eng)) {
                        $data[] = (int)$row['total'];
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

        // 📊 Graphique mensuel (nombre de clients)
        $sql = PersSessionSQL::getMonthlyChartBar();
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

        // 📊 Graphique mensuel (total des prix)
        $sqlPie = PersSessionSQL::getTotalPriceChartBar();
        $dataPie = $connection->fetchAllAssociative($sqlPie);

        $dataPieMap = [];
        foreach ($dataPie as $row) {
            $dataPieMap[$row['month_number']] = (float)$row['total_price'];
        }

        $pieLabels = [];
        $pieValues = [];
        foreach ($allMonths as $num => $name) {
            $pieLabels[] = $name;
            $pieValues[] = $dataPieMap[$num] ?? 0;
        }

        return $this->render('pers_session/chart.html.twig', [
            'labels' => json_encode($labels),
            'values' => json_encode($values),
            'pieLabels' => json_encode($pieLabels),
            'pieValues' => json_encode($pieValues),
        ]);
    }
}
