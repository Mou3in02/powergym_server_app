<?php

namespace App\Controller;

use App\SQL\PerPersonSQL;
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
        $sqlScript = PerPersonSQL::getAllInfo();
        $stmt = $connection->prepare($sqlScript);
        $result = $stmt->executeQuery();
        $persons = $result->fetchAllAssociative();

        $data = [];
        foreach ($persons as $person) {
            if (empty(trim($person['name'])) && empty(trim($person['last_name']))) {
                continue;
            }
            $data[] = [
                'id' => $person['id'],
                'name' => $person['name'] . ' ' . $person['last_name'],
                'createdAt' => $person['create_time'],
            ];
        }

        return $this->render('pers_person/index.html.twig', [
            'persons' => $data,
        ]);

    }
}
