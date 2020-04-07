<?php

namespace App\Repository;

use App\Entity\SuratRW;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SuratRW|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuratRW|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuratRW[]    findAll()
 * @method SuratRW[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuratRWRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuratRW::class);
    }


    public function getdataRW($data)
    {
        return $this->createQueryBuilder('p')
            ->where('p.IdJobPosition =:data')
            ->setParameter('data',$data)
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return SuratRW[] Returns an array of SuratRW objects
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
    public function findOneBySomeField($value): ?SuratRW
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
