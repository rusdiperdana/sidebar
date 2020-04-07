<?php

namespace App\Controller;

use App\Entity\NdKataDasar;
use App\Service\suratService;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;

class KataDasarController extends AbstractController
{
    /**
     * @Route("/kata/dasar", name="kata_dasar")
     */
    public function index(suratService $service)
    {
        $data = $service->getKata();
        return $this->render('kata_dasar/index.html.twig',array('data'=>$data));
    }

    /**
     * @Route("/tambahKata", name="tambahKata", methods={"GET","POST"})
     */
    public function tambahKata(Request $request)
    {
        $ad = new NdKataDasar();
        $form = $this->createFormBuilder($ad)
            ->add('kataDasar',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Kata Dasar']])
            ->add('keterangan',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Keterangan']])
            ->add('statusKata', ChoiceType::class,['label'=>false,'choices'=>
                [
                    'Aktif'=>'1',
                    'Tidak Aktif'=>'0'
                ],'attr' =>['class'=>'form-control']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Tambah'])
            ->getForm();
             $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ad);
                $em->flush();
                return $this->redirect('kata_dasar');
            }
             return $this->render('kata_dasar/tambahKata.html.twig', array('form' => $form->createView()));
    }
}
