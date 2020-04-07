<?php

namespace App\Repository;

use App\Entity\NdReader;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NdReader|null find($id, $lockMode = null, $lockVersion = null)
 * @method NdReader|null findOneBy(array $criteria, array $orderBy = null)
 * @method NdReader[]    findAll()
 * @method NdReader[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NdReaderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NdReader::class);
    }


    public function getSuratMasuk($employee,$jabatan)
    {
        return $this->createQueryBuilder('p')
            ->join('p.refid','s')
            ->addSelect('s')
            ->where('p.readerNama =:employee')
            ->orWhere('p.readerJabatan in (:idjabatan)')
            ->andWhere('s.IdSuratStatus = 2')
            ->setParameter('employee',$employee)
            ->setParameter('idjabatan',$jabatan)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return NdReader[] Returns an array of NdReader objects
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
    public function findOneBySomeField($value): ?NdReader
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
