<?php

namespace App\Repository;

use App\Entity\NdPenerima;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NdPenerima|null find($id, $lockMode = null, $lockVersion = null)
 * @method NdPenerima|null findOneBy(array $criteria, array $orderBy = null)
 * @method NdPenerima[]    findAll()
 * @method NdPenerima[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NdPenerimaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NdPenerima::class);
    }


    // /**
    //  * @return NdPenerima[] Returns an array of NdPenerima objects
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
    public function findOneBySomeField($value): ?NdPenerima
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
