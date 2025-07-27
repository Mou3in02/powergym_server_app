<?php

namespace App\Controller;

use App\Service\ErrorLoggerService;
use App\SQL\PersAccessSQL;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Level;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/dashboard')]
class PersAccessController extends AbstractController
{

    #[Route(path: '/pers-access', name: 'pers_access_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em, ErrorLoggerService $errorLoggerService): Response
    {
        $accessResult = [];
        $now = new \DateTime('2024-09-21');
        $currentDate = $now->setTime(0,0)->format('Y-m-d');
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
                'id' => $item['id'],
                'name' => $item['name'] . ' ' . $item['last_name'],
                'create_time' => $item['create_time'],
                'update_time' => $item['update_time'],
                'event_time' => $item['event_time'],
                'dev_alias' => $item['dev_alias'],
            ];
        }

        return $this->render('pers_access/index.html.twig', [
            'data' => $data,
        ]);
    }
}
