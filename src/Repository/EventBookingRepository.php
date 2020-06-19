<?php

namespace App\Repository;

use App\Entity\EventBooking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EventBooking|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventBooking|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventBooking[]    findAll()
 * @method EventBooking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventBookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventBooking::class);
    }

    // /**
    //  * @return EventBooking[] Returns an array of EventBooking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventBooking
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
