<?php

namespace App\Controller\API_AndroidMobile\Service;

use App\Entity\CommondJobPosition;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class AuthService{
    private $isLogged;
    private $user;
    private $entityManager;
    private $session;

    public function __construct(TokenStorageInterface $tokenStorage,
                                SessionInterface $session ,
                                EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->session=$session;
        $this->user = $tokenStorage->getToken()->getUser();
        if (is_object($this->user)) {
            $this->isLogged = true;
        }else{
            $this->isLogged = false;
        }
    }

    public function encryptEmployee($data){
        $pass = password_hash($data, PASSWORD_DEFAULT);
        return $pass;
    }
    public function verifyEmployee($data, $username){
        $getUser = $this->entityManager->getRepository(User::class)->findOneBy(['Ussername'=> $username]);
        $passwords = $getUser->getPassword();

        $pass = password_verify($data, $passwords);
        return $pass;
    }

    public function getRtPosition($idRw, $jabatanRt){
        $data = $this->entityManager->getRepository(CommondJobPosition::class);
        $idJobPos = $data->getDataRt($idRw, $jabatanRt);
        return $idJobPos[0];
    }

    public function getRwPosition($idRw){
        $data = $this->entityManager->getRepository(CommondJobPosition::class);
        $idJobPos = $data->getDataRw($idRw);
        return $idJobPos[0];
    }

    // ini nanti dipindahkan ke service
    public function objIdJobPosition($desc){
        $data = $this->entityManager->getRepository(CommondJobPosition::class)->findOneBy(['jabatan' => $desc]);
        return $data;
    }

//    public function objIdRole($id){
//        $data = $this->entityManager->getRepository(CommondRole::class)->find($id);
//        return $data;
//    }

    public function getUsernameData($username){
        $data = $this->entityManager->getRepository(User::class)->findOneBy(['Ussername' => $username]);
        return $data;
    }

    public function getEmailData($email){
        $data = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        return $data;
    }

    public function getPhone($phone){
        $data = $this->entityManager->getRepository(User::class)->findOneBy(['Phone' => $phone]);
        return $data;
    }

    public function changeStatusLogin($id, $code){
        $data = $this->entityManager->getRepository(User::class)->find($id);
        $data->setStatusLogin($code);
        $em = $this->entityManager;
        $em->persist($data);
        $em->flush();
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // TO CHECK RT / RW INPUT
    function checkRWExist($datas){
        $data = $this->entityManager->getRepository(CommondJobPosition::class);
        $getRt = $data->checkRWExist($datas);
        return $getRt;
    }

    function checkRTExist($parent, $datas){
        $data = $this->entityManager->getRepository(CommondJobPosition::class);
        $getRt = $data->checkRTExist($parent, $datas);
        return $getRt;
    }

    function NormalisasiRW($data){
        $upData = strtoupper($data);
        $new = str_split($upData);

        if($new[1] == 'W' && $new[0] == "R"){
            if(count($new) == 4 && is_numeric($new[3])){
                if($new[2] == "0" && (int)end($new) > "0"){ // RW01 RW 1
                    $ends = end($new);
                    $return = 'RW 0'.$ends;
                    return $return;
                }else if($new[2] == " " && (int)$new[3] > "0"){
                    $ends = end($new);
                    $return = 'RW 0'.$ends;
                    return $return;
                }else if(is_numeric($new[2]) && $new[2] != "0" && $new[3] != "0"){
                    $return = 'RW '.$new[2].$new[3];
                    return $return;
                }
                else if(is_numeric($new[2]) && $new[2] != " " && (int)$new[2] > "0" && (int)$new[3] == "0"){
                    $addElement = [" "];
                    array_splice($new, 2,0,$addElement);
                    $return = join("",$new);
                    return $return;
                }else{
                    return null;
                }
            }else if(count($new) == 5 && is_numeric($new[3]) && is_numeric($new[4])){ //RW 01
                if($new[2] == " " && $new[3] == "0" && end($new) != "0"){
                    $return = join("", $new);
                    return $return;
                }else if($new[2] == " " && $new[3] != "0" && $new[4] == "0"){ // RW 10
                    $return = 'RW '. $new[3]."0";
                    return $return;
                }else if($new[2] == " " && $new[3] != "0" && $new[4] != "0"){ // RW 10
                    $return = 'RW '. $new[3].$new[4];
                    return $return;
                }
                else if($new[2] == " " && $new[3] == "0" && $new[4] == "0"){
                    return null;
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    //Normalisasi RT
    function NormalisasiRT($data){
        $upData = strtoupper($data);
        $new = str_split($upData);
        if($new[1] == 'T' && $new[0] == "R"){
            if(count($new) == 3 && $new[2]){
                if(end($new) > 0){
                    $return = 'RT 00'.end($new);
                    return $return;
                }else{
                    return null;
                }
            }
            if(count($new) == 4 && is_numeric($new[3])){
                if($new[2] == "0" && end($new) > "0"){ // RW01 RW 1
                    $ends = end($new);
                    $return = 'RT 00'.$ends;
                    return $return;
                }else if($new[2] == " " && $new[3] != "0"){
                    $ends = end($new);
                    $return = 'RT 00'.$ends;
                    return $return;
                }else if($new[2] != " " && $new[2] > "0" && $new[3] == "0"){
                    $addElement = [" ", "0"];
                    array_splice($new, 2,0,$addElement);
                    $return = join("",$new);
                    return $return;
                }else{
                    return null;
                }
            }else if(count($new) == 5 && is_numeric($new[3]) && is_numeric($new[4])){ //RT 01
                if($new[2] == "0" && $new[3] == "0" && end($new) > "0"){
                    $return = 'RT '.$new[2].$new[3].$new[4];
                    return $return;
                }else if($new[2] == "0" && $new[3] > "0" && $new[4] == "0"){ // RT010
                    $return = 'RT 0'. $new[3]."0";
                    return $return;
                }else if($new[2] > "0" && $new[3] == "0" && $new[4] === "0"){
                    $return = 'RT '.$new[2].'00';
                    return $return;
                }else if($new[2] > "0" && $new[3] > "0" && $new[4] > "0"){
                    $return = 'RT '.$new[2].$new[3].$new[4];
                    return $return;
                }
                else if(is_numeric($new[2]) && $new[2] > "0" && $new[3] == "0" && $new[4] > "0"){
                    $return = 'RT '.$new[2].$new[3].$new[4];
                    return $return;
                }
                else if(is_numeric($new[2]) && $new[2] > "0" && $new[3] > "0" && $new[4] == "0"){
                    $return = 'RT '.$new[2].$new[3].$new[4];
                    return $return;
                }
                else if($new[2] == "0" && $new[3] > "0" && $new[4] > "0"){
                    $return = 'RT '.$new[2].$new[3].$new[4];
                    return $return;
                }
                else if($new[2] == " " && $new[3] == "0" && $new[4] > "0"){
                    $return = 'RT 00'.$new[4];
                    return $return;
                }
                else if($new[2] == " " && $new[3] > "0" && $new[4] == "0"){
                    $return = 'RT 0'.$new[3].$new[4];
                    return $return;
                }else if($new[2] == " " && $new[3] > "0" && $new[4] > "0"){
                    $return = 'RT 0'.$new[3].$new[4];
                    return $return;
                }
                else{
                    return null;
                }
            }else if(count($new) == 6 && is_numeric($new[3]) && is_numeric($new[4]) && is_numeric($new[5])){ //RT 001
                if($new[2] == " " && $new[3] == "0" && $new[4] == "0" && end($new) > "0"){
                    $return = join("", $new);
                    return $return;
                }else if($new[2] == " " && $new[3] == "0" && $new[4] > "0" && end($new) > "0"){
                    $return = join("", $new);
                    return $return;
                }else if($new[2] == " " && $new[3] > "0" && $new[4] > "0" && end($new) > "0"){
                    $return = join("", $new);
                    return $return;
                }else if($new[2] == " " && $new[3] == "0" && $new[4] == "0" && $new[5] == "0"){
                    return null;
                }
                else if($new[2] == " " && $new[3] > "0" && $new[4] >= "0" && $new[5] >= "0" ){ // RW 10
                    $return = 'RT '. $new[3].$new[4].$new[5];
                    return $return;
                }else{
                    return null;
                }
            }
            else{
                return null;
            }
        }else{
            return null;
        }
    }


    // For Image

    function compress_image($source_url, $destination_url, $quality) {

        $info = getimagesize($source_url);
        $fileSystem = new Filesystem();

        if ($info['mime'] == 'image/jpeg'){
            $image = imagecreatefromjpeg($source_url);
        }
        elseif ($info['mime'] == 'image/gif'){
            $image = imagecreatefromgif($source_url);
        }
        elseif ($info['mime'] == 'image/png'){
            $image = imagecreatefrompng($source_url);
        }
        $fileSystem->remove($source_url);
        imagejpeg($image, $destination_url, $quality);
        return $destination_url;
    }
}