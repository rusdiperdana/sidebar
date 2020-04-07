<?php

namespace App\Controller;

use App\Service\suratService;
use App\Service\userInfo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class KotakMasukController extends AbstractController
{
    /**
     * @Route("/kotak/masuk", name="kotak_masuk")
     */
    public function index(suratService $service,userInfo $userInfo)
    {
        $idUser = $service->getUser()->getId();
        $jabatan = $userInfo->getJabatan($idUser);
        $datas = $service->getSuratMasuk($idUser,$jabatan);
        return $this->render('kotak_masuk/index.html.twig',['datas'=>$datas]);
    }
}
