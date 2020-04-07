<?php

namespace App\Repository;

use App\Entity\SuratRT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SuratRT|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuratRT|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuratRT[]    findAll()
 * @method SuratRT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuratRTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuratRT::class);
    }


    // /**
    //  * @return SuratRT[] Returns an array of SuratRT objects
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
    public function findOneBySomeField($value): ?SuratRT
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
