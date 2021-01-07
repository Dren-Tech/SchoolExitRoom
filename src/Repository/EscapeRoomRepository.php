<?php

namespace App\Repository;

use App\Entity\EscapeRoom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EscapeRoom|null find($id, $lockMode = null, $lockVersion = null)
 * @method EscapeRoom|null findOneBy(array $criteria, array $orderBy = null)
 * @method EscapeRoom[]    findAll()
 * @method EscapeRoom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EscapeRoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EscapeRoom::class);
    }

    // /**
    //  * @return EscapeRoom[] Returns an array of EscapeRoom objects
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
    public function findOneBySomeField($value): ?EscapeRoom
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
