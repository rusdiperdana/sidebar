<?php

namespace App\Controller;

use App\Entity\TrackingItem;
use App\Service\suratService;
use App\Service\userInfo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OnProgressController extends AbstractController
{
    /**
     * @Route("/on/progress", name="on_progress", methods={"GET"})
     */
    public function index(suratService $service,userInfo $userInfo)
    {
        $idUser = $this->getUser()->getId();
        $jabatan = $userInfo->getJabatan($idUser);
        $datas = $service->progresSurat($idUser,$jabatan);
        return $this->render('on_progress/index.html.twig',['datas'=>$datas]);
    }

    /**
     * @Route("/trackingSurat", name="trackingSurat", methods={"GET"})
     */
    public function tracking(suratService $service,userInfo $userInfo,Request $request)
    {
        //intinya ambil join tracking dengan nd surat
        //setelah itu kita kurangin step dr ndsurat dngn step saat ini
        //step saat ini d ambil dr approve
        //jgn lupa pemeriksadaftarnya
        //ketika smua dapat masukin ke tracking item
        $iduser = $this->getUser()->getId();
        $jabtan = $userInfo->getJabatan($iduser);
        $track = $service->getTrackingSurat($iduser,$jabtan);
        foreach ($track as $ad)
        {
            $abc = $service->getCounPemeriksa($ad->getrefid());
            $suratstep =$ad->getrefid()->getStep();
            if($abc - $suratstep !=0)
            {
                $jabatans =$service->getPemeriksadaftarss($ad->getrefid(),$suratstep);
                foreach ($jabatans as $jabs)
                {
                    $data = $jabs->getApproverNama();
                    $date = $jabs->getApproverJabatan();
                }
                if($data === null)
                {
                    $ej = $userInfo->getJabatanByIdStruktur($date)->getNamePegawai();
                }
                else
                {
                    $ej = $userInfo->getJabatan($data)->getNamaPegawai();
                }
                $ab = new Trackingitem();
                $ab->setRefid($ad->getrefid()->getid());
                $ab->setTglBuat($ad->getrefid()->getTglBuat());
                $ab->setKeterangan($ad->getrefid()->getKeterangan());
                $ab->setStep($abc - $suratstep);
                $ab->setPemeriksadaftar($ej);
                $this->getDoctrine()->getManager()->persist($ab);
                $fullData[] = $ab;
            }
        }
        $this->getDoctrine()->getRepository(TrackingItem::class)->findAll();
        return $this->render('/on_progress/trackingSurat.html.twig',['ab'=>$fullData]);
    }
}
