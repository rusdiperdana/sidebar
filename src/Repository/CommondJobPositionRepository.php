<?php

namespace App\Repository;

use App\Entity\CommondJobPosition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CommondJobPosition|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommondJobPosition|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommondJobPosition[]    findAll()
 * @method CommondJobPosition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommondJobPositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommondJobPosition::class);
    }

    // /**
    //  * @return CommondJobPosition[] Returns an array of CommondJobPosition objects
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
    public function findOneBySomeField($value): ?CommondJobPosition
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    //-------------------- Mobile Api Repository -----------------/////
    public function getDataRt($idRw, $jabatanRt){
        return $this->createQueryBuilder('p')
            ->where('p.Parent = :idRw')
            ->andWhere('p.Jabatan = :jabatanRt')
            ->setParameter('idRw', $idRw)
            ->setParameter('jabatanRt', $jabatanRt)
            ->getQuery()
            ->getResult();
    }

    public function getDataRw($idRw){
        return $this->createQueryBuilder('p')
            ->where('p.id = :idRw')
            ->setParameter('idRw', $idRw)
            ->getQuery()
            ->getResult();
    }

    public function checkRWExist($data){
        return $this->createQueryBuilder('p')
            ->where('p.Jabatan LIKE :data')
            ->setParameter('data', $data)
            ->getQuery()
            ->getResult();
    }


    public function checkRTExist($parent, $data){
        return $this->createQueryBuilder('p')
            ->where('p.Parent = :parent')
            ->andWhere('p.Jabatan = :data')
            ->setParameter('parent', $parent)
            ->setParameter('data', $data)
            ->getQuery()
            ->getResult();
    }
    // --------------------------************-------------------------//
}
