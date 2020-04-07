<?php
namespace App\Controller;
use App\Entity\CommondJobPosition;
use App\Entity\User;
use App\Service\suratService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;

class PegawaiController extends AbstractController
{
    /**
     * @Route("/pegawai", name="pegawai",methods={"GET","POST"})
     */
    public function index(suratService $service)
    {
        $data = $service->getDataPegawai('ROLE_ADMIN');
       return $this->render('pegawai/index.html.twig',array('data'=>$data));
    }

    /**
     * @Route("/tambah_pegawai", name="tambah_pegawai",methods={"GET","POST"})
     */
    public function tambahPegawai(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $ad =  new User();
        $form = $this->createFormBuilder($ad)
            ->add('email', EmailType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'email']])
            ->add('password', PasswordType::class,['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'password']])
            ->add('role',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Role_Admin/User']])
            ->add('phone',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'phone']])
            ->add('statusPegawai', ChoiceType::class,['label'=>false,'choices'=>
                [
                    'Aktif'=>'1',
                    'Tidak Aktif'=>'0'
                ],'attr' =>['class'=>'form-control']])
            ->add('ussername',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'ussername']])
            ->add('IdJobPosition',EntityType::class,[
                'attr'=>['class'=>'form-control'],
                'class'=>CommondJobPosition::class,
                'choice_label'=>'jabatan'
            ])
            ->add('namaPegawai',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Nama Pegawai']])
            ->add('token',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Token']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Tambah'])
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $password =  $passwordEncoder->encodePassword($ad, $ad->getPassword());
            $ad->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($ad);
            $em->flush();
            return $this->redirectToRoute('pegawai');
        }
        return $this->render('pegawai/tambahPegawai.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route("/edit{id}", name="edit_pegawai", methods={"GET","POST"})
     */
    public function edit(Request $request,$id)
    {
        $ad = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id'=>$id]);
        $form =$this->createFormBuilder($ad)
            ->add('email', EmailType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'email']])
            ->add('role',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Role_Admin/User']])
            ->add('phone',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'phone']])
            ->add('statusPegawai', ChoiceType::class,['label'=>false,'choices'=>
                [
                    'Aktif'=>'1',
                    'Tidak Aktif'=>'0'
                ],'attr' =>['class'=>'form-control']])
            ->add('ussername',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'ussername']])
            ->add('IdJobPosition',EntityType::class,[
                'attr'=>['class'=>'form-control'],
                'class'=>CommondJobPosition::class,
                'choice_label'=>'jabatan'
            ])
            ->add('namaPegawai',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Nama Pegawai']])
            ->add('token',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Token']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Update'])
            ->getForm();
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $this->addFlash('success', 'Data Berhasil Di Edit');
                return $this->redirectToRoute('pegawai');
            }
            return $this->render('pegawai/edit.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/indexRT", name="indexRT")
     */
    public function indexRT(suratService $service)
    {
        $data = $service->getDataRT(6);
        return $this->render('RT/index.html.twig',array('data'=>$data));
    }

    /**
     * @Route("/detailRT/{id}", name="detailRT", methods={"GET","POST"})
     */
    public function detailRT(Request $request,$id)
    {
        $file = File(__DIR__. '/../../file/img/RTRW/RT004.jpg');
        return $this->render('RT/detail.html.twig');
    }

    /**
     *  @Route("/indexRW", name="indexRW", methods={"GET","POST"})
     */
    public function indexRW(suratService $service)
    {
        $data = $service->getDataRW(7);
        return $this->render('RW/index.html.twig',array('data'=>$data));
    }

    /**
     * @Route("/detailRW/{id}", name="detailRW", methods={"GET","POST"})
     */
    public function detailRW(Request $request,$id)
    {
        $file = File(__DIR__. '/../../public/assets/signature/RT004.jpg');
        return $this->render('RW/detail.html.twig');
    }

    /**
     * @Route("/indexRTW", name="indexRTW", methods={"GET","POST"})
     */
    public function list(suratService $service)
    {
        $data = $service->getRTW();
        return $this->render('RTW/index.html.twig',array('data'=>$data));
    }

    /**
     * @Route("/detailRTW/{Ussername}", name="detailRTW", methods={"GET","POST"} )
     */
    public function detailRTW(Request $request,suratService $service,$Ussername)
    {
        $filename = $service->getIMG($Ussername);
        $filejabatan = $filename[1]->getFileName();
        $file = file_get_contents(__DIR__."/../../file/img/RTRW/surat_jabatan/$filejabatan");
        $filencd = base64_encode($file);
        return $this->render('RTW/detailJabatan.html.twig',array('filencd'=>$filencd));
    }

    /**
     * @Route("/detailSignature/{Ussername}", name="detailSignature",  methods={"GET","POST"})
     */
    public function detailSignature(suratService $service,Request $request,$Ussername)
    {
        $filenames = $service->getIMG($Ussername);
        $fileSignature= $filenames[0]->getFileName();
        $file = file_get_contents(__DIR__."/../../file/img/RTRW/surat_jabatan/$fileSignature");
        $filends = base64_encode($file);
        return $this->render('RTW/detailSignature.html.twig',array('filends'=>$filends));
    }

    /**
     * @Route("/editTalisman/{id}", name="editTalisman", methods={"GET","POST"})
     */
    public function editTalisman(Request $request,$id)
    {
        $ad = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id'=>$id]);
        $form = $this->createFormBuilder($ad)
            ->add('email', EmailType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'email']])
            ->add('role',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Role_Admin/User']])
            ->add('phone',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'phone']])
            ->add('statusPegawai', ChoiceType::class,['label'=>false,'choices'=>
                [
                    'Aktif'=>'1',
                    'Tidak Aktif'=>'0'
                ],'attr' =>['class'=>'form-control']])
            ->add('ussername',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'ussername']])
            ->add('IdJobPosition',EntityType::class,[
                'attr'=>['class'=>'form-control'],
                'class'=>CommondJobPosition::class,
                'choice_label'=>'jabatan'
            ])
            ->add('namaPegawai',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Nama Pegawai']])
            ->add('token',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Token']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Update'])
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Data Berhasil Di Edit');
            return $this->redirectToRoute('indexRTW');
        }
        return $this->render('RTW/approve.html.twig',array('form'=>$form->createView()));
    }
}
