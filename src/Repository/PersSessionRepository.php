<?php

namespace App\Repository;

use App\Entity\PersSession;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PersSession>
 */
class PersSessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersSession::class);
    }

    /**
     * @return PersSession[]
     */
    public function getSessionByDate(string $date)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.createdAt >= :date AND p.createdAt <= :date')
            ->andWhere('p.isDeleted = :isDeleted')
            ->setParameters(
                new ArrayCollection([
                    new Parameter('date', $date),
                    new Parameter('isDeleted', false),
                ])
            )
            ->getQuery()
            ->getResult();
    }

    public function countSessionByDate(string $date): int
    {
        $startDate = new \DateTime($date . ' 00:00:00');
        $endDate = new \DateTime($date . ' 23:59:59');

        return $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->where('p.createdAt BETWEEN :startDate AND :endDate')
            ->andWhere('p.isDeleted = :isDeleted')
            ->setParameters(
                new ArrayCollection([
                    new Parameter('startDate', $startDate),
                    new Parameter('endDate', $endDate),
                    new Parameter('isDeleted', false),
                ])
            )
            ->getQuery()
            ->getSingleScalarResult();
    }

}
