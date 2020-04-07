<?php

namespace App\Controller;

use App\Entity\NdSurat;
use App\Entity\Penduduk;
use App\Service\suratService;
use App\Service\userInfo;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SuratKeteranganController extends AbstractController
{
    /**
     * @Route("/surat/keterangan", name="surat_keterangan")
     */
    public function index(suratService $service,userInfo $userInfo)
    {
        $idUser= $this->getUser()->getId();
        $jabatan = $userInfo->getJabatan($idUser)->getIdJobPosition()->getId();
        $datas = $service->suratberjalanKeterangan($jabatan,$idUser);
        return $this->render('surat_keterangan/index.html.twig',['datas'=>$datas]);
    }

    /**
     * @Route("/detailSk{id}", name="detailSk", methods={"GET","POST"})
     */
    public function detailSK($id,suratService $service,Request $request)
    {
        $ad = $this->getDoctrine()->getRepository(NdSurat::class)->findOneBy(['id'=>$id]);
        $form = $this->createFormBuilder($ad)
            ->add('noSuratRt',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noSuratRt']])
            ->add('noSuratRw',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noSuratRW']])
            ->add('noSuratKeterangan',TextType::class, ['label'=>false,'required'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noSuratKeterangan']])
            ->add('keterangan',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'keterangan']])
            ->add('pemohonSurat',EntityType::class,[
                'attr'=>['class'=>'form-control'],
                'class'=>Penduduk::class,
                'choice_label'=>'namaPenduduk'
            ])
            ->add('noPengajuan',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noPengajuan']])
            ->add('Tipe',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Tipe']])
            ->add('bodySurat',TextareaType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'body']])
            ->add('komentar',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Komentar']])
            ->add('approveSK', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Approve'])
            ->add('rejectSK', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Return'])
           ->getForm();
        $form->handleRequest($request);
        if($form->getClickedButton()=== $form->get('approveSK'))
        {
            $datas = $form->getData();
            $service->approveSk($datas);
        }
        elseif($form->getClickedButton()== $form->get('rejectSK'))
        {
            $datas = $form->getData();
            $service->submiSurat($datas);
        }
        return $this->render('surat_keterangan/detailSK.html.twig', array('form' => $form->createView()));
    }
}
