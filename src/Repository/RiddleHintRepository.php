<?php

namespace App\Repository;

use App\Entity\RiddleHint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RiddleHint|null find($id, $lockMode = null, $lockVersion = null)
 * @method RiddleHint|null findOneBy(array $criteria, array $orderBy = null)
 * @method RiddleHint[]    findAll()
 * @method RiddleHint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RiddleHintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RiddleHint::class);
    }

    // /**
    //  * @return RiddleHint[] Returns an array of RiddleHint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RiddleHint
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
