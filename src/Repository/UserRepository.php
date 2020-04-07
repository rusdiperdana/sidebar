<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }


    public function getAlls()
    {
             return $this->createQueryBuilder('p')
            ->where('p.statusPegawai = 1')
            ->getQuery()
            ->getResult();
    }

    public function findJabatanByIdUser($id)
    {
        return $this->createQueryBuilder('c')
            ->join('c.IdJobPosition','s')
            ->addSelect('s')
            ->andWhere('c.id = :val')
            ->andWhere('c.statusPegawai =1')
            ->setParameter('val',$id)
            ->getQuery()
            ->getOneOrNullResult();
    }
    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    public function getDataPegawai($data){
        return $this->createQueryBuilder('p')
            ->where('p.Role =:data ')
            ->setParameter('data', $data)
            ->getQuery()
            ->getResult();
    }

    public function getDataRT($data)
    {
        return $this->createQueryBuilder('p')
            ->where('p.IdJobPosition =:data')
            ->setParameter('data',$data)
            ->getQuery()
            ->getResult();
    }

    public function getDataRW($data)
    {
        return $this->createQueryBuilder('p')
            ->where('p.IdJobPosition =:data')
            ->setParameter('data',$data)
            ->getQuery()
            ->getResult();
    }

    public function getRTW()
    {
        return $this->createQueryBuilder('p')
            ->where('p.IdJobPosition = 6')
            ->orWhere('p.IdJobPosition = 7')
            ->andWhere('p.statusPegawai= 2')
            ->getQuery()
            ->getResult();
    }

    public function getJabatan($idUser)
    {
        return $this->createQueryBuilder('p')
           ->join('p.IdJobPosition','s')
            ->Where('p.id =:val')
            ->setParameter('val',$idUser)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getIdEmp($idUser)
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.id =:idUser')
            ->andWhere('p.statusPegawai = 1')
            ->setParameter('idUser',$idUser)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
