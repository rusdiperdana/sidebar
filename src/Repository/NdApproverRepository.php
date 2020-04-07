<?php

namespace App\Repository;

use App\Entity\NdApprover;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NdApprover|null find($id, $lockMode = null, $lockVersion = null)
 * @method NdApprover|null findOneBy(array $criteria, array $orderBy = null)
 * @method NdApprover[]    findAll()
 * @method NdApprover[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NdApproverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NdApprover::class);
    }


    public function findSuratBerjalan($jabatan,$Employee)
    {
        return $this->createQueryBuilder('p')
            ->join('p.refid', 's')
            ->addSelect('s')
            ->where('p.ApproverJabatan in (:idjabatan)')
            ->orWhere('p.approverNama =:idemployee')
            ->andWhere('s.IdSuratStatus = 1')
            ->orWhere('s.IdSuratStatus = 3')
            ->andWhere('s.step =p.sequence')
            ->setParameter('idjabatan',$jabatan)
            ->setParameter('idemployee',$Employee)
            ->getQuery()
            ->getResult();
    }

    public function suratBerjalanKeterangan($jabatan,$employee)
    {
        return $this->createQueryBuilder('p')
            ->join('p.refid','s')
            ->addSelect('s')
            ->where('p.ApproverJabatan =:idjabatan')
            ->andWhere('p.approverNama =:idemployee')
            ->andWhere('s.step = p.sequence')
            ->setParameter('idjabatan',$jabatan)
            ->setParameter('idemployee',$employee)
            ->getQuery()
            ->getResult();
    }

    public function getTotal($idsurat)
    {
        return $this->createQueryBuilder('p')
            ->select('count(p.refid)')
            ->where('p.refid =:idsurat')
            ->setParameter('idsurat', $idsurat)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getPemeriksadaftar($refid,$sequence)
    {
        return $this->createQueryBuilder('p')
            ->where('p.refid=:refid')
            ->andWhere('p.sequence =:sequence')
            ->setParameter('refid',$refid)
            ->setParameter('sequence',$sequence)
            ->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return NdApprover[] Returns an array of NdApprover objects
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
    public function findOneBySomeField($value): ?NdApprover
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
