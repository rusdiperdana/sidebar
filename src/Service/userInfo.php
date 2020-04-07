<?php


namespace App\Service;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class userInfo
{
    private $entityManager;
    private $session;

    public function __construct(SessionInterface $session,EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
    }

    public function getJabatan($idUser):?User
    {
        $joni = $this->entityManager->getRepository(User::class);
        $jab = $joni->getJabatan($idUser);
        return $jab;
    }

    public function getJabatanByIdStruktur($idStruktur):? User
    {
        $repo =$this->entityManager->getRepository(User::class);
        $struktur =$repo->findOneBy(['IdJobPosition'=>$idStruktur]);
        return $struktur;
    }

}