<?php

namespace App\Repository;

use App\Entity\StudentRiddleResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudentRiddleResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentRiddleResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentRiddleResult[]    findAll()
 * @method StudentRiddleResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRiddleResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentRiddleResult::class);
    }

    // /**
    //  * @return StudentRiddleResult[] Returns an array of StudentRiddleResult objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StudentRiddleResult
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
