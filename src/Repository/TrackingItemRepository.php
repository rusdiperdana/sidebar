<?php

namespace App\Repository;

use App\Entity\TrackingItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TrackingItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrackingItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrackingItem[]    findAll()
 * @method TrackingItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrackingItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrackingItem::class);
    }

    // /**
    //  * @return TrackingItem[] Returns an array of TrackingItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TrackingItem
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
