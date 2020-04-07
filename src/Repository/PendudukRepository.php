<?php

namespace App\Repository;

use App\Entity\Penduduk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Penduduk|null find($id, $lockMode = null, $lockVersion = null)
 * @method Penduduk|null findOneBy(array $criteria, array $orderBy = null)
 * @method Penduduk[]    findAll()
 * @method Penduduk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PendudukRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Penduduk::class);
    }

    // /**
    //  * @return Penduduk[] Returns an array of Penduduk objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Penduduk
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
