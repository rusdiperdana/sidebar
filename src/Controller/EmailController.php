<?php

namespace App\Controller;

use App\Entity\Email;
use App\Service\suratService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    /**
     * @Route("/email", name="email", methods={"GET","POST"})
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $ad = new Email();
        $form = $this->createFormBuilder($ad)
            ->add('yourName',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'your Name']])
            ->add('email',EmailType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'Email']])
            ->add('subyek',TextType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'subyek']])
            ->add('pesan',TextareaType::class, ['label'=>false,'attr'=>['class'=>'form-control','placeholder'=>'pesan']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary mt-3 ml-3', 'style' => 'float: left'], 'label' => 'Tambah'])
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $email = $ad->getEmail();
            $subyek = $ad->getSubyek();
            $pesan = $ad->getPesan();
            $message = (new \Swift_Message('new contact'))
                ->setFrom('rusdiperdana28@gmail.com')
                ->setSubject($subyek)
                ->setTo('rusdiperdana357@gmail.com')
                ->setBody($pesan);
            $mailer->send($message);
           /* $em = $this->getDoctrine()->getManager();
            $ad->setYourName($ad->getYourName());
            $ad->setEmail(($ad->getEmail()));
            $ad->setSubyek($ad->getSubyek());
            $ad->setPesan($ad->getPesan());
            $em->persist($ad);
            $em->flush();*/
            return $this->redirectToRoute('email');
        }
        return $this->render('email/index.html.twig', array('form' => $form->createView()));
    }
}


