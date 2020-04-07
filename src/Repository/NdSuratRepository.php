<?php

namespace App\Repository;

use App\Entity\NdSurat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NdSurat|null find($id, $lockMode = null, $lockVersion = null)
 * @method NdSurat|null findOneBy(array $criteria, array $orderBy = null)
 * @method NdSurat[]    findAll()
 * @method NdSurat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NdSuratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NdSurat::class);
    }

    public function getTotalket($noKeterangan)
    {
        return $this->createQueryBuilder('s')
            ->select('count(s.noSuratKeterangan)')
            ->where('s.noSuratKeterangan =: no')
            ->setParameter('no',$noKeterangan)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return NdSurat[] Returns an array of NdSurat objects
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
    public function findOneBySomeField($value): ?NdSurat
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
