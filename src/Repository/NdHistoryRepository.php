<?php

namespace App\Repository;

use App\Entity\NdHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NdHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method NdHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method NdHistory[]    findAll()
 * @method NdHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NdHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NdHistory::class);
    }

    // /**
    //  * @return NdHistory[] Returns an array of NdHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NdHistory
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
