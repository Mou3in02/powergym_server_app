<?php

namespace App\Controller;

use App\helpers\DateTimeFormatter;
use App\SQL\PersPersonSQL;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/dashboard')]
#[IsGranted("ROLE_ADMIN")]
class PersPersonController extends AbstractController
{
    #[Route('/pers-person', name: 'pers_person_index', methods: ['GET'])]
    public function index(EntityManagerInterface $em)
    {
        $connection = $em->getConnection();
        $sqlScript = PersPersonSQL::getAllInfo();
        $stmt = $connection->prepare($sqlScript);
        $result = $stmt->executeQuery();
        $persons = $result->fetchAllAssociative();

        $now = new \DateTime();
        $data = [];
        foreach ($persons as $person) {
            if (empty(trim($person['name'])) && empty(trim($person['last_name']))) {
                continue;
            }
            $data[] = [
                'id' => $person['id'],
                'fullname' => $person['name'] . ' ' . $person['last_name'],
                'create_time' => DateTimeFormatter::format($person['create_time']),
                'update_time' => DateTimeFormatter::format($person['update_time']),
                'start_time' => DateTimeFormatter::format($person['start_time'], 'd/m/Y'),
                'end_time' => DateTimeFormatter::format($person['end_time'], 'd/m/Y'),
                'active' => new \DateTime($person['end_time']) > $now ? 'Oui' : 'Non',
            ];
        }

        return $this->render('pers_person/index.html.twig', [
            'persons' => $data,
        ]);

    }
}
