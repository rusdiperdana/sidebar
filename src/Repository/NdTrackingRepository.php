<?php

namespace App\Repository;

use App\Entity\NdTracking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NdTracking|null find($id, $lockMode = null, $lockVersion = null)
 * @method NdTracking|null findOneBy(array $criteria, array $orderBy = null)
 * @method NdTracking[]    findAll()
 * @method NdTracking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NdTrackingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NdTracking::class);
    }



    public function trackingSurat($employee,$jabatan)
    {
        return $this->createQueryBuilder('p')
            ->join('p.refid','s')
            ->addSelect('s')
            ->andwhere('p.idUser =:idemployee')
            ->orWhere('p.idJabatan =:idjabatan')
            ->setParameter('idemployee',$employee)
            ->setParameter('idjabatan', $jabatan)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return NdTracking[] Returns an array of NdTracking objects
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
    public function findOneBySomeField($value): ?NdTracking
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
