<?php

namespace App\Controller;

use App\helpers\DateTimeFormatter;
use App\Service\ErrorLoggerService;
use App\SQL\PersAccessFirstInLastOut;
use App\SQL\PersAccessSQL;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Level;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/dashboard')]
class PersAccessController extends AbstractController
{
    #[Route(path: '/pers-access', name: 'pers_access_index', methods: ['GET'])]
    public function persAccess(EntityManagerInterface $em, ErrorLoggerService $errorLoggerService): Response
    {
        $accessResult = [];
        $now = new \DateTime();
        $currentDate = $now->setTime(0, 0)->format('Y-m-d');
        try {
            $connection = $em->getConnection();
            $sqlScript = PersAccessSQL::getAccessByDate();
            $stmt = $connection->prepare($sqlScript);
            $stmt->bindValue(':customDate', $currentDate);
            $result = $stmt->executeQuery();
            $accessResult = $result->fetchAllAssociative();
        } catch (\Exception $exception) {
            $errorLoggerService->logError($exception, Level::Critical);
        }

        $data = [];
        foreach ($accessResult as $item) {
            if (empty(trim($item['name'])) && empty(trim($item['last_name']))) {
                continue;
            }
            $data[] = [
                'name' => $item['name'] . ' ' . $item['last_name'],
                'create_time' => $item['create_time'],
                'dev_alias' => $item['dev_alias'],
            ];
        }

        return $this->render('pers_access/index.html.twig', [
            'data' => $data,
        ]);
    }

    #[Route(path: '/pers-access/filter', name: 'pers_access_filter', methods: ['POST'])]
    public function getPersAccessByFilter(Request $request, EntityManagerInterface $em, ErrorLoggerService $errorLoggerService): JsonResponse
    {
        $filterData = $request->getContent();
        $filterData = json_decode($filterData, true);
        $customDate = $filterData['customDate'] ?? null;
        $eventTime = $filterData['eventTime'] ?? null;
        $name = $filterData['name'] ?? null;

        if (empty($customDate)) {
            return $this->json([
                'message' => 'Date is required !',
            ], Response::HTTP_BAD_REQUEST);
        }
        try {
            $customDate = (new \DateTime($customDate))->format('Y-m-d');
        } catch (\Exception $e) {
            return $this->json([
                'message' => 'Invalid date format !',
            ], Response::HTTP_BAD_REQUEST);
        }

        $accessResult = [];
        try {
            $connection = $em->getConnection();
            $sqlScript = PersAccessSQL::getAccessByFilter($eventTime, $name);
            $stmt = $connection->prepare($sqlScript);
            // Set required filter
            $stmt->bindValue(':customDate', $customDate);
            // Check optional filter
            if ($eventTime && in_array($eventTime, [PersAccessSQL::DEV_ALIAS_ENTREE, PersAccessSQL::DEV_ALIAS_SORTIE], true)) {
                $stmt->bindValue(':eventTime', $eventTime);
            }
            if (!empty($name)) {
                $stmt->bindValue(':name', '%' . trim($name) . '%');
            }
            $result = $stmt->executeQuery();
            $accessResult = $result->fetchAllAssociative();
        } catch (\Exception $e) {
            $errorLoggerService->logError($e, Level::Critical);
        }

        $data = [];
        foreach ($accessResult as $item) {
            if (empty(trim($item['name'])) && empty(trim($item['last_name']))) {
                continue;
            }
            $data[] = [
                'name' => $item['name'] . ' ' . $item['last_name'],
                'create_time' => $item['create_time'],
                'dev_alias' => $item['dev_alias'],
            ];
        }

        return $this->json($data, Response::HTTP_OK);
    }

    #[Route(path: '/pers-access-v2', name: 'pers_access_v2_index', methods: ['GET'])]
    public function persAccessV2(EntityManagerInterface $em, ErrorLoggerService $errorLoggerService): Response
    {
        $accessResult = [];
        $now = new \DateTime();
        $currentDate = $now->setTime(0, 0)->format('Y-m-d');
        try {
            $connection = $em->getConnection();
            $sqlScript = PersAccessFirstInLastOut::getAccessByDate();
            $stmt = $connection->prepare($sqlScript);
            $stmt->bindValue(':customDate', $currentDate);
            $result = $stmt->executeQuery();
            $accessResult = $result->fetchAllAssociative();
        } catch (\Exception $exception) {
            $errorLoggerService->logError($exception, Level::Critical);
        }

        $data = [];
        foreach ($accessResult as $item) {
            if (empty(trim($item['name'])) && empty(trim($item['last_name']))) {
                continue;
            }
            $data[] = [
                'id' => $item['id'],
                'name' => $item['name'] . ' ' . $item['last_name'],
                'create_time' => DateTimeFormatter::format($item['create_time']),
                'event_time_in' => DateTimeFormatter::format($item['first_in_time']),
                'event_time_out' => DateTimeFormatter::format($item['last_out_time']),
            ];
        }

        return $this->render('pers_access/index_v2.twig', [
            'data' => $data,
        ]);
    }

    #[Route(path: '/pers-access-v2/filter', name: 'pers_access_v2_filter', methods: ['POST'])]
    public function getPersAccessV2ByFilter(Request $request, EntityManagerInterface $em, ErrorLoggerService $errorLoggerService): JsonResponse
    {
        $filterData = $request->getContent();
        $filterData = json_decode($filterData, true);
        $customDate = $filterData['customDate'] ?? null;
        $name = $filterData['name'] ?? null;

        if (!empty($customDate)) {
            try {
                $dateObj = \DateTime::createFromFormat('d/m/Y', $customDate);
                $customDate = $dateObj->format('Y-m-d');
            } catch (\Exception $e) {
                return $this->json([
                    'message' => 'Invalid date format !',
                ], Response::HTTP_BAD_REQUEST);
            }
        }

        $accessResult = [];
        try {
            $connection = $em->getConnection();
            $sqlScript = PersAccessFirstInLastOut::getAccessByFilter($customDate, $name);
            $stmt = $connection->prepare($sqlScript);
            // Check optional filter
            if (!empty($customDate)) {
                $stmt->bindValue(':customDate', $customDate);
            }
            if (!empty($name)) {
                $stmt->bindValue(':name', '%' . trim($name) . '%');
            }
            $result = $stmt->executeQuery();
            $accessResult = $result->fetchAllAssociative();
        } catch (\Exception $e) {
            $errorLoggerService->logError($e, Level::Critical);
        }

        $data = [];
        foreach ($accessResult as $item) {
            if (empty(trim($item['name'])) && empty(trim($item['last_name']))) {
                continue;
            }
            $data[] = [
                'id' => $item['id'],
                'name' => $item['name'] . ' ' . $item['last_name'],
                'create_time' => DateTimeFormatter::format($item['create_time']),
                'event_time_in' => DateTimeFormatter::format($item['first_in_time']),
                'event_time_out' => DateTimeFormatter::format($item['last_out_time']),
            ];
        }

        return $this->json($data, Response::HTTP_OK);
    }
}
