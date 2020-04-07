<?php

namespace App\Repository;

use App\Entity\SuratKelurahan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SuratKelurahan|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuratKelurahan|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuratKelurahan[]    findAll()
 * @method SuratKelurahan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuratKelurahanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuratKelurahan::class);
    }


    public function coutTahun($jumlTahun)
    {
        return $this->createQueryBuilder('p')
            ->select('count(p.tahun)')
            ->where('p.tahun =:tahun')
            ->setParameter('tahun',$jumlTahun)
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return SuratKelurahan[] Returns an array of SuratKelurahan objects
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
    public function findOneBySomeField($value): ?SuratKelurahan
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
