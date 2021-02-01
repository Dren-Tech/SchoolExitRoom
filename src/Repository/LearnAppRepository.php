<?php

namespace App\Repository;

use App\Entity\LearnApp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LearnApp|null find($id, $lockMode = null, $lockVersion = null)
 * @method LearnApp|null findOneBy(array $criteria, array $orderBy = null)
 * @method LearnApp[]    findAll()
 * @method LearnApp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LearnAppRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LearnApp::class);
    }

    // /**
    //  * @return LearnApp[] Returns an array of LearnApp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LearnApp
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
