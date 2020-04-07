<?php

namespace App\Service;
use App\Entity\CommondSignature;
use App\Entity\NdApprover;
use App\Entity\NdHistory;
use App\Entity\NdKataDasar;
use App\Entity\NdPenerima;
use App\Entity\NdReader;
use App\Entity\NdSurat;
use App\Entity\NdTracking;
use App\Entity\StatusSurat;
use App\Entity\SuratKelurahan;
use App\Entity\SuratRT;
use App\Entity\SuratRW;
use App\Entity\User;
use App\Repository\SuratRTRepository;
use App\Repository\SuratRWRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\CssSelector\Parser\Reader;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class suratService
{
    private $isLogged;
    private $user;
    private $entityManager;
    private $session;
    private $userInfo;

    public function __construct(TokenStorageInterface $tokenStorage,
                                SessionInterface $session,
                                EntityManagerInterface $entityManager, userInfo $userInfo)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->user = $tokenStorage->getToken()->getUser();
        if (is_object($this->user)) {
            $this->isLogged = true;
        } else {
            $this->isLogged = false;
        }
        $this->userInfo = $userInfo;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getIdEmp($idUser)
    {
        $joni = $this->entityManager->getRepository(User::class);
        $data = $joni->getIdEmp($idUser);
        return $data;
    }

    public function getDataPegawai($data)
    {
        $joni = $this->entityManager->getRepository(User::class);
        $data = $joni->getDataPegawai($data);
        return $data;
    }

    public function getDataRT($data)
    {
        $joni = $this->entityManager->getRepository(User::class);
        $data = $joni->getDataRT($data);
        return $data;
    }

    public function getDataRW($data)
    {
        $joni = $this->entityManager->getRepository(User::class);
        $data = $joni->getDataRW($data);
        return $data;
    }

    public function getRTW()
    {
        $joni = $this->entityManager->getRepository(User::class);
        $data = $joni->getRTW();
        return $data;
    }

    public function getIMG($data)
    {
        $joni = $this->entityManager->getRepository(CommondSignature::class);
        $deu = $joni->getIMG($data);
        return $deu;
    }

    public function getKata()
    {
        $joni = $this->entityManager->getRepository(NdKataDasar::class);
        $deu = $joni->getKata();
        return $deu;
    }

    public function progresSurat($jabatan, $employee)
    {
        $joni = $this->entityManager->getRepository(NdApprover::class);
        $deu = $joni->findSuratBerjalan($jabatan, $employee);
        return $deu;
    }

    public function suratberjalanKeterangan($jabatan, $idemp)
    {
        $doni = $this->entityManager->getRepository(NdApprover::class);
        $deu = $doni->suratBerjalanKeterangan($jabatan, $idemp);
        return $deu;
    }

    public function getCounPemeriksa($idsurat)
    {
        $joni = $this->entityManager->getRepository(NdApprover::class);
        $data = $joni->getTotal($idsurat);
        return $data;
    }

    public function getSuratMasuk($employee, $jabatan)
    {
        $joni = $this->entityManager->getRepository(NdReader::class);
        $due = $joni->getSuratMasuk($employee, $jabatan);
        return $due;
    }

    public function getTotalTahun($jumtahun)
    {
        $joni = $this->entityManager->getRepository(SuratKelurahan::class);
        $data = $joni->coutTahun($jumtahun);
        return $data;
    }

    public function getTotalSketerangan($jumket)
    {
        $joni = $this->entityManager->getRepository(NdSurat::class);
        $data = $joni->getTotalket($jumket);
        return $data;
    }

    public function getPemeriksadaftarss($refid,$sequence)
    {
        $joni = $this->entityManager->getRepository(NdApprover::class);
        $data = $joni->getPemeriksadaftar($refid,$sequence);
        return $data;
    }

    public function getTrackingSurat($employee,$jabatan)
    {
        $joni = $this->entityManager->getRepository(NdTracking::class);
        $data = $joni->trackingSurat($employee,$jabatan);
        return $data;
    }

    public function cekKata(String $dataBody)
    {
        //toleransi itu atau kesalahn shortest
        $input = explode(' ', $dataBody);
        $dictionary = $this->entityManager->getRepository(NdKataDasar::class)->findAll();
        foreach ($input as $output) {
            $shortest = -1;
            foreach ($dictionary as $word) {
                $lev = levenshtein($output, $word->getKataDasar());
//                dd($lev);
                if ($lev == 0) {
                    $closest = $word->getKataDasar();
                    $shortest = 0;
                } else if ($lev <= $shortest || $shortest < 0) {
                    $closest = $word->getKataDasar();
                    $shortest = $lev;
                }

            }
            echo "$output\n";
            if ($shortest == 0) {
                echo ": $closest\n" . '<br/>';
            } else if ($shortest <= 3) {
                echo ": $closest?\n" . '<br/>';
            } else {
                echo ": null\n" . '<br/>';
            }
        }
    }


    public function submiSurat(NdSurat $ndSurat)
    {
        $this->entityManager->beginTransaction();
        $ndSurat->setStep(1);
        if ($ndSurat->getId() == null) {
            $status = $this->entityManager->getRepository(StatusSurat::class)->find(1);
            $ndSurat->setNoSuratRt($ndSurat->getNoSuratRt());
            $ndSurat->setNoSuratRw($ndSurat->getNoSuratRw());
            $ndSurat->setNoSuratKeterangan($ndSurat->getNoSuratKeterangan());
            $ndSurat->setKeterangan($ndSurat->getKeterangan());
            $ndSurat->setPemohonSurat($ndSurat->getPemohonSurat());
            $ndSurat->setBodySurat($ndSurat->getBodySurat());
            $ndSurat->setNoPengajuan($ndSurat->getNoPengajuan());
            $ndSurat->setTipe($ndSurat->getTipe());
            //  $struktur = $this->userInfo->getJabatanByIdStruktur($ndSurat->get);
            /* $ndSurats->setPengirimNamaText('Rita');*/
            $ndSurat->setTglBuat(new \DateTime());
            $ndSurat->setCreatedAt(new \DateTime());
            $ndSurat->setStep($ndSurat->getStep());
            $ndSurat->setIdSuratStatus($status);
            $this->entityManager->persist($ndSurat);

            foreach ($ndSurat->getKepadadaftar() as $kpd) {
                $struktur = $this->userInfo->getJabatanByIdStruktur($kpd);
                $kepada = new NdReader();
                $kepada->setRefid($ndSurat);
                $kepada->setReaderJabatan($struktur->getIdJobPosition()->getId());
                $kepada->setReaderNama($struktur->getId());
                $kepada->setReaderStatus(0);
                $this->entityManager->persist($kepada);
                $this->entityManager->flush($kepada);
            }
            $idusers = $this->getUser()->getId();
            $jabatan = $this->userInfo->getJabatan($idusers)->getIdJobPosition()->getId();
            if ($jabatan == 3)//ini misahin sequence penulis dengan pemeriksa
            {
                $pemeriksa = new NdApprover();
                $pemeriksa->setApproverJabatan($jabatan);
                $pemeriksa->setApproverNama($idusers);
                $pemeriksa->setTipeApprover(0);
                $pemeriksa->setSequence(0);
                $pemeriksa->setRefid($ndSurat);
                $this->entityManager->persist($pemeriksa);
                $this->entityManager->flush($pemeriksa);

                $sequenceApp = 1;
                $arrPemeriksa = $ndSurat->getPemeriksadaftar();//ngambil total pemeriksa
                $getIdUserPemeriksa = [];//dapetin idjabatan pemeriksa yang d multiplelist
                for ($l = 0; $l < count($arrPemeriksa); $l++) {
                    $dat = $this->entityManager->getRepository(User::class)->findOneBy(['IdJobPosition' => $arrPemeriksa[$l + 1]]);
                    $getIdUserPemeriksa[] = $dat;
                }

                for ($i = 0; $i < count($arrPemeriksa); $i++) {
                    $pemeriksas = new NdApprover();
                    $pemeriksas->setApproverJabatan($arrPemeriksa[$i + 1]);
                    $pemeriksas->setApproverNama($getIdUserPemeriksa[$i]->getId());
                    $pemeriksas->setTipeApprover(1);
                    $pemeriksas->setSequence($sequenceApp++);
                    $pemeriksas->setRefid($ndSurat);
                    $this->entityManager->persist($pemeriksas);
                    $this->entityManager->flush($pemeriksas);
                }
            }
        }
        $idUser = $this->getUser()->getId();
        $jabatan = $this->userInfo->getJabatan($idUser)->getIdJobPosition()->getId();

        $komentar = new NdHistory();
        $komentar->setUserNama($idUser);
        $komentar->setKomentar($ndSurat->getKomentar());
        $komentar->setRefid($ndSurat);


        $komentar->setAksi('Submit');
        $komentar->setCreatedAt(new \DateTime());
        $this->entityManager->persist($komentar);
        $this->entityManager->flush($komentar);
        $track = new NdTracking();
        $track->setIdJabatan($jabatan);
        $track->setIdUser($idUser);
        $track->setRefid($ndSurat);
        $this->entityManager->persist($track);
        $this->entityManager->flush($track);
        $this->entityManager->commit();
    }

    public function approveSurat(NdSurat $ndSurat)
    {
        $this->entityManager->beginTransaction();
        $ndSurat->setStep($ndSurat->getStep() + 1);
        $step = $ndSurat->getStep();
        $abz = $this->getCounPemeriksa($ndSurat);
        if ($step >= $abz) {
            $res = $this->entityManager->getRepository(NdPenerima::class);
            $penerima = $res->findBy(['refid' => $ndSurat->getId()]);
            foreach ($penerima as $kpd) {
                $kepada = new NdReader();
                $kepada->setReaderNama($kpd->getPenerimaNama());
                $kepada->setReaderJabatan($kpd->getPenerimaJabatan());
                $kepada->setRefid($ndSurat->getId());
                $kepada->setReaderStatus(0);
                $this->entityManager->persist($kepada);
                $this->entityManager->flush($kepada);
            }
            $status = $this->entityManager->getRepository(StatusSurat::class)->find(2);
            $ndSurat->setIdSuratStatus($status);
            $this->entityManager->persist($status);
        } else {
            $status = $this->entityManager->getRepository(StatusSurat::class)->find(1);
            $ndSurat->setIdSuratStatus($status);
            $this->entityManager->persist($status);

            $idUser = $this->getUser()->getId();


            $komentar = new NdHistory();
            $komentar->setUserNama($idUser);
            $komentar->setKomentar($ndSurat->getKomentar());
            $komentar->setRefid($ndSurat);
            $komentar->setAksi('Approve');
            $komentar->setCreatedAt(new \DateTime());
            $this->entityManager->persist($komentar);
            $this->entityManager->flush($komentar);

        }
        $this->entityManager->persist($ndSurat);
        $this->entityManager->flush($ndSurat);
        $this->entityManager->commit();
    }

    public function returnSurat(NdSurat $ndSurat)
    {
        $this->entityManager->beginTransaction();
        $ndSurat->setStep($ndSurat->getStep());
        $ndSurat->setStep(0);
        $status = $this->entityManager->getRepository(StatusSurat::class)->find(3);
        $ndSurat->setIdSuratStatus($status);

        $idUser = $this->getUser()->getId();
        $komentar = new NdHistory();
        $komentar->setUserNama($idUser);
        $komentar->setKomentar($ndSurat->getKomentar());
        $komentar->setRefid($ndSurat);
        $komentar->setAksi('Return');
        $komentar->setCreatedAt(new \DateTime());
        $this->entityManager->persist($komentar);
        $this->entityManager->flush($komentar);


        $this->entityManager->persist($status);
        $this->entityManager->persist($status);
        $this->entityManager->persist($ndSurat);
        $this->entityManager->flush($ndSurat);
        $this->entityManager->commit();
    }

    public function approveSk(NdSurat $surat)
    {
        $this->entityManager->beginTransaction();
        $step = $surat->getStep();
        $abc = $this->getCounPemeriksa($surat);
        if ($step + 1 > $abc) {
            //generete nomor dsni
            /*$surat->setNoSuratKeterangan($surat->getNoSuratKeterangan());*/
            $date = new \DateTime();
            $currentYear = $date->format('Y');
            $findyear = $this->entityManager->getRepository(SuratKelurahan::class)->findOneBy(['tahun' => $currentYear]);
            if ($findyear != null) {
                $totaltahun = $this->getTotalTahun($currentYear) +1;
                $textNomer = $totaltahun . ".1/1.755.0/" . $currentYear;
                $surat->setStep($step + 1);
                $surat->setNoSuratKeterangan($textNomer);
                $this->entityManager->persist($surat);
                $ad = new SuratKelurahan();
                $ad->setTahun($currentYear);
                $ad->setCreatedAt(new \DateTime());
                $ad->setRefid($surat);
            } else {

                $textNomer = "1.1/1.755.0/" . $currentYear;
                $surat->setStep($step + 1);
                $surat->setNoSuratKeterangan($textNomer);
                $this->entityManager->persist($surat);
                $ad = new SuratKelurahan();
                $ad->setTahun($currentYear);
                $ad->setCreatedAt(new \DateTime());
                $ad->setRefid($surat);

            }
        } else {
            $surat->setStep($step + 1);
            $this->entityManager->persist($surat);
        }
        $this->entityManager->flush();
        $this->entityManager->commit();
    }

    public function returnSk(NdSurat $surat)
    {
        $surat->setRejectStep($surat->getStep());
        $surat->setStep(0);
        $ag = new NdHistory();
        $ag->setKomentar($surat->getKomentar());
        $ag->setRefid($surat);
        $ag->setAksi('Return');
        $ag->setCreatedAt(new \DateTime());
        $this->entityManager->persist($surat);
        $this->entityManager->flush($surat);
    }
}

