<?php

namespace App\Controller;

use App\Entity\NdSurat;
use App\Entity\Penduduk;
use App\Service\suratService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ComposeSuratController extends AbstractController
{
    /** 
     * @Route("/compose/surat", name="compose_surat")
     */
    public function index(Request $request,suratService $service)
    {
        $ad = new NdSurat();
        $form = $this->createFormBuilder($ad)
            ->add('noSuratRt',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noSuratRt']])
            ->add('noSuratRw',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noSuratRW']])
            ->add('noSuratKeterangan',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noSuratKeterangan']])
            ->add('keterangan',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'keterangan']])
            ->add('pemohonSurat',EntityType::class,[
                'attr'=>['class'=>'form-control'],
               'class'=>Penduduk::class,
                'choice_label'=>'namaPenduduk'
            ])
           ->add('kepadadaftar', ChoiceType::class,
              [
                   'label' =>false,
                  'multiple' => true, // Attribute multiple itu isinya false/true aja, kalau true berarti multiple
                   'choices' => [
                      'Dedung' => '6'
                   ],
                   'data' => ['1'], //Ini isi data pake value datanya aja gak usah text nya, tapi dengan catatan harus ada value tsb di choice supaya bisa muncul
                   'attr' => ['class' => 'form-control'] //Attr itu yang nanti nya di pass ke object html misal: class ini
               ]
            )
           ->add('pemeriksadaftar', ChoiceType::class,
                [
                   'label' =>false,
                   'multiple' => true, // Attribute multiple itu isinya false/true aja, kalau true berarti multiple
                    'choices' => [
                        'Yulian Fathiniah' => '2',
                        'Abdul Mukmin' => '4'
                    ],
                    'data' => ['1','2'], //Ini isi data pake value datanya aja gak usah text nya, tapi dengan catatan harus ada value tsb di choice supaya bisa muncul
                   'attr' => ['class' => 'form-control'] //Attr itu yang nanti nya di pass ke object html misal: class ini
                ]
            )
            ->add('noPengajuan',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noPengajuan']])
            ->add('Tipe',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Tipe']])
            ->add('preview', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'cek Kata'])
            ->add('bodySurat',TextareaType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'body']])
            ->add('komentar',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Komentar']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Submit'])
               ->getForm();
        $form->handleRequest($request);
        if($form->getClickedButton()=== $form->get('submit'))
        {
            $datas = $form->getData();
            $service->submiSurat($datas);
        }
       else if($form->getClickedButton()== $form->get('preview'))
        {
            $datas = $form->get('bodySurat')->getData();
            $service->cekKata($datas);
        }
        return $this->render('compose_surat/index.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/detail/{id}", name="detail", methods={"GET","POST"})
     */
    public function detail(Request $request,$id,suratService $service)
    {

        $ad = $this->getDoctrine()->getRepository(NdSurat::class)->findOneBy(['id'=>$id]);
        $form = $this->createFormBuilder($ad)
            ->add('noSuratRt',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noSuratRt']])
            ->add('noSuratRw',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noSuratRW']])
            ->add('noSuratKeterangan',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noSuratKeterangan']])
            ->add('keterangan',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'keterangan']])
            ->add('pemohonSurat',EntityType::class,[
                'attr'=>['class'=>'form-control'],
                'class'=>Penduduk::class,
                'choice_label'=>'namaPenduduk'
            ])
            ->add('kepadadaftar', ChoiceType::class,
                [
                    'label' =>false,
                    'multiple' => true, // Attribute multiple itu isinya false/true aja, kalau true berarti multiple
                    'choices' => [
                        'Dedung' => '6'
                    ],
                    'data' => ['1'], //Ini isi data pake value datanya aja gak usah text nya, tapi dengan catatan harus ada value tsb di choice supaya bisa muncul
                    'attr' => ['class' => 'form-control'] //Attr itu yang nanti nya di pass ke object html misal: class ini
                ]
            )
            ->add('pemeriksadaftar', ChoiceType::class,
                [
                    'label' =>false,
                    'multiple' => true, // Attribute multiple itu isinya false/true aja, kalau true berarti multiple
                    'choices' => [
                        'Yulian Fathiniah' => '2',
                        'Abdul Mukmin' => '4'
                    ],
                    'data' => ['1','2'], //Ini isi data pake value datanya aja gak usah text nya, tapi dengan catatan harus ada value tsb di choice supaya bisa muncul
                    'attr' => ['class' => 'form-control'] //Attr itu yang nanti nya di pass ke object html misal: class ini
                ]
            )
            ->add('noPengajuan',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'noPengajuan']])
            ->add('Tipe',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Tipe']])
            ->add('bodySurat',TextareaType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'body']])
            ->add('komentar',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Komentar']])
            ->add('approve', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Approve'])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Submit'])
            ->add('return', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Return'])
            /*->add('preview', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Preview'])
           */ ->getForm();
        $form->handleRequest($request);
        if($form->getClickedButton()=== $form->get('approve'))
        {
            $datas = $form->getData();
            $service->approveSurat($datas);
        }
        else if($form->getClickedButton()== $form->get('submit'))
        {
            $datas = $form->getData();
            $service->submiSurat($datas);
        }
        else if ($form->getClickedButton()== $form->get('return'))
        {
            $datas = $form->getData();
            $service->returnSurat($datas);
        }
        return $this->render('on_progress/detail.html.twig', array('form' => $form->createView()));
    }

}
