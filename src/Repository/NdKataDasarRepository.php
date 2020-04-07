<?php

namespace App\Repository;

use App\Entity\NdKataDasar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NdKataDasar|null find($id, $lockMode = null, $lockVersion = null)
 * @method NdKataDasar|null findOneBy(array $criteria, array $orderBy = null)
 * @method NdKataDasar[]    findAll()
 * @method NdKataDasar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NdKataDasarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NdKataDasar::class);
    }



    public function getKata()
    {
        return $this->createQueryBuilder('p')
            ->where('p.statusKata =1')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return NdKataDasar[] Returns an array of NdKataDasar objects
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
    public function findOneBySomeField($value): ?NdKataDasar
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
