<?php

namespace App\Repository;

use App\Entity\StatusSurat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StatusSurat|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatusSurat|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatusSurat[]    findAll()
 * @method StatusSurat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatusSuratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatusSurat::class);
    }

    // /**
    //  * @return StatusSurat[] Returns an array of StatusSurat objects
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
    public function findOneBySomeField($value): ?StatusSurat
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
