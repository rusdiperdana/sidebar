<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class TestController extends AbstractController
{
    /**
     * @Route("/register", name="register_user")
     */
    public function register(UserPasswordEncoderInterface $passwordEncoder)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user =  new User();
        $user->setEmail('aduy@gmail.com');
        $user->setPassword($passwordEncoder->encodePassword($user,'jadul'));
        $user->setRole('ROLE_TATA_USAHA');
        $entityManager->persist($user);
        $entityManager->flush();
        return new Response(
            '<html><body>Test User Registered Succesfully</body></html>'
        );
       // return $this->render('test/index.html.twig');
    }

    /**
     * @Route("/index", name="index_ad")
     */
    public function index()
    {
        return $this->render('test/index.html.twig');
    }
}
