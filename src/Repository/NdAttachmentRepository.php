<?php

namespace App\Repository;

use App\Entity\NdAttachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NdAttachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method NdAttachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method NdAttachment[]    findAll()
 * @method NdAttachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NdAttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NdAttachment::class);
    }

    // /**
    //  * @return NdAttachment[] Returns an array of NdAttachment objects
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
    public function findOneBySomeField($value): ?NdAttachment
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
