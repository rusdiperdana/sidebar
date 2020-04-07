<?php

namespace App\Repository;

use App\Entity\CommondSignature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CommondSignature|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommondSignature|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommondSignature[]    findAll()
 * @method CommondSignature[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommondSignatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommondSignature::class);
    }


    public function getIMG($data)
    {
        return $this->createQueryBuilder('p')
            ->where('p.Ussername = :val')
            ->setParameter('val',$data)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return CommondSignature[] Returns an array of CommondSignature objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommondSignature
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
