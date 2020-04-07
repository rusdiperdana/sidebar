<?php

namespace App\Controller\API_AndroidMobile;

use App\Entity\CommondSignature;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\User;
use App\Controller\API_AndroidMobile\Service\AuthService;

class AuthAPIController extends  AbstractController{
    /**
     * @Route("/api/logins", name="loginAPI")
     * @Method({"POST"})
     */
    public function login(Request $request, AuthService $APIService){
        //Status Login
        // Tidak Aktif = 0
        // Aktif = 1

        // Status Pegawai
        // Tidak Aktif = 0;
        // Aktif = 1;
        // Sedang Dalam Verifikasi = 2;

        $response = ['error' => false];
        $usernames = $request->get('Ussername');
        $passwords = $request->get('password');
        $getUsername = $data = $this->getDoctrine()->getRepository(User::class)->findOneBy(['Ussername' => $usernames]);

        if($getUsername == null){
            $response['error'] = true;
            $response['message'] = 'Username Tidak Terdaftar';

            return $this->json($response);
        }
        // Untuk Filter User, admin tu tidak ada akses
        if($getUsername->getRole() != 'ROLE_USER' && $getUsername->getIdJobPosition()->getNamaPosisi() != 'RW' || $getUsername->getRole() != 'ROLE_USER' && $getUsername->getIdJobPosition()->getNamaPosisi() != 'RT'){
            $response['error'] = true;
            $response['message'] = $getUsername->getRole().' Tidak Memiliki Akses';
            return $this->json($response);
        }

        if($APIService->verifyEmployee($passwords, $getUsername->getUssername()) == false){
            $response['error'] = true;
            $response['message'] = 'Password Salah!';
            return $this->json($response);
        }

        if($getUsername->getStatusPegawai() == 2){
            $response['error'] = true;
            $response['message'] = 'Akun Anda Sedang Dalam Proses Verifikasi, Infromasi Persetujuan Akses Akan Di Kirimkan Melalui Email!';
            return $this->json($response);
        }
        if($getUsername->getStatusPegawai() == 0){
            $response['error'] = true;
            $response['message'] = 'Akun Sudah Tidak Aktif';
            return $this->json($response);
        }

        // Ubah Status Login
//        $APIService->changeStatusLogin($getUsername->getId(), 1);

        $response['error'] = false;
        $response['message'] = 'Success Login';
        $response['data'] = [
            'Id' => $getUsername->getId(),
            'Nama' => $getUsername->getNamaPegawai(),
            'Email' => $getUsername->getEmail(),
            'Job Position' => $getUsername->getIdJobPosition()->getJabatan()
        ];
        $response['IdEmployee'] = $getUsername->getId();
        $response['IdJobPos'] = $getUsername->getIdJobPosition()->getId();

        return $this->json($response);
    }

    /**
     * @Route("/api/register", name="registerAPI")
     * @Method({"POST"})
     */
    public function register(Request $request, AuthService $authService){
            $response = ['error' => false];

            $namaPegawai = $request->get('NamaPegawai');
            $ussername = $request->get('Ussername');
            $password = $request->get('password');
            $email = $request->get('email');
            $phone = $request->get('phone');
            $rw = $request->get('rw');
            $rt = $request->get('rt');
            $files = $request->files->get('file');
            $files2 = $request->files->get('files');

            // Cek Username are present
            if($authService->getUsernameData($ussername) != null){
                $response['error'] = true;
                $response['message'] = 'Username Telah Digunakan, Masukkan Yang Lain!';
                return $this->json($response);
            }
            // Cek Email must primary
            if($authService->getEmailData($email) != null){
                $response['error'] = true;
                $response['message'] = 'Email Telah Digunakan, Masukkan Email Aktif Yang Lain!';
                return $this->json($response);
            }

            // Cek phone must primary
            if($authService->getPhone($phone) != null){
                $response['error'] = true;
                $response['message'] = 'No Telepon Telah Digunakan, Masukkan No Telepon Aktif Yang Lain!';
                return $this->json($response);
            }

            // Check RW
            $dtRW = $authService->NormalisasiRW($rw);
            if($dtRW == null){
                $response['error'] = true;
                $response['message'] = 'Masukkan Data RW Dengan Benar!';
                return $this->json($response);
            }

            $getRW = $authService->checkRWExist($dtRW);

            if($getRW == null){
                $response['error'] = true;
                $response['message'] = 'RW Yang Anda Masukkan Tidak Terdaftar!';
                return $this->json($response);
            }

            if($rt != null){
                $dtRT = $authService->NormalisasiRT($rt);
                if($dtRT == null){
                    $response['error'] = true;
                    $response['message'] = 'RT Tidak Terdaftar!';
                    return $this->json($response);
                }else{
                    $getRT = $authService->checkRTExist($getRW[0]->getId(), $dtRT);
                    if($getRT == null){
                        $response['error'] = true;
                        $response['message'] = 'RT Tidak Terdaftar!';
                        return $this->json($response);
                    }
                }
            }


            $encryptPass = $authService->encryptEmployee($password);

            $em = $this->getDoctrine()->getManager();
            $allData = new User();
            $allData->setUssername($ussername);
            $allData->setPassword($encryptPass);
            $allData->setEmail($email);
            $allData->setRole('ROLE_USER');
            $allData->setPhone($phone);
            $allData->setNamaPegawai($namaPegawai);
            $allData->setStatusPegawai(2);
            if($rt != null){
                $allData->setIdJobPosition($getRT[0]);
            }else{
                $allData->setIdJobPosition($getRW[0]);
            }


            $destination = $path1b =  __DIR__ . '/../../../file/img/RTRW/signature';
            $originalFilename = pathinfo($files->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = 'Sig-'.uniqid().'.'.$files->guessExtension();
            $files->move($destination, $fileName);

            $destinations = $path1a =  __DIR__ . '/../../../file/img/RTRW/surat_jabatan';
            $originalFilenames = pathinfo($files2->getClientOriginalName(), PATHINFO_FILENAME);
            $fileNames = 'SJ-'.uniqid().'.'.$files2->guessExtension();
            $files2->move($destinations, $fileNames);

            $dataFile1 = $this->getDoctrine()->getManager();
            $CommondSig1 = new CommondSignature();
            $CommondSig1->setFileName($fileName);
            $CommondSig1->setUssername($ussername);
            $dataFile1->persist($CommondSig1);
            $dataFile1->persist($CommondSig1);
            $dataFile1->flush();

            $dataFile2 = $this->getDoctrine()->getManager();
            $CommondSig2 = new CommondSignature();
            $CommondSig2->setFileName($fileNames);
            $CommondSig2->setUssername($ussername);
            $dataFile2->persist($CommondSig2);
            $dataFile2->flush();

            $em->persist($allData);
            $em->flush();


            $response['message'] = "Hai $namaPegawai, Registrasi Anda Telah Berhasil, Persetujuan Akses Akan Dikirim Melalui Email";
            return $this->json($response);

            // UPLOAD FIX


//            $path2a = __DIR__ . '/../../../file/img/RTRW/tempPoint/' .$surJabName;
//            $path2b =  __DIR__ . '/../../../file/img/RTRW/surat_jabatan/' .$surJabName;
//            $path2Decode = base64_decode($suratJabatan);
//            file_put_contents($path2a, $path2Decode);
//            $authService->compress_image($path2a,$path2b,50);

            // TOKEN BELOMM!!!!!!!!!!!!!!!

    }

    /**
     * @Route("/api/forgetPassword", name="forgetPasswordAPI")
     * @Method({"POST"})
     */
    public function forgetPassword(Request $request, AuthService $authService){

        $response = ['error' => false];

        $email = $request->get('email');
        $noTelepon = $request->get('phone');

        $getEmail = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);

        if($getEmail == null) {
            $response['error'] = true;
            $response['message'] = 'Email Tidak Terdaftar!';
            return $this->json($response);
        }

        $getTelepon = $getEmail->getPhone();
        if($getTelepon != $noTelepon){
            $response['error'] = true;
            $response['message'] = 'No Telepon Tidak Terdaftar!';
            return $this->json($response);
        }

        $originalPass = $authService->generateRandomString(10);
        $username = $getEmail->getUssername();
        $encryptPass = $authService->encryptEmployee($originalPass);

        $em = $this->getDoctrine()->getManager();
        $getEmail->setPassword($encryptPass);
        $em->persist($getEmail);
        $em->flush();

        $response['message'] = 'Pemulihan Password Anda Berhasil, Cobalah Periksa Email Anda Beberapa Saat Lagi Untuk Mendapatkan Username dan Password Baru!';
        $response['data'] = ['username' => $username,'password' => $originalPass, 'email' => $getEmail->getEmail()];
        return $this->json($response);

    }

    /**
     * @Route("/api/test", name="testAPI")
     * @Method({"POST"})
     */
    public function test(Request $request, AuthService $authService){

        $files = $request->files->get('file');
        $destination = $path1b =  __DIR__ . '/../../../file/img/RTRW/signature';
        $originalFilename = pathinfo($files->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = 'test-'.uniqid().'.'.$files->guessExtension();
        $files->move($destination, $fileName);
        return $this->json('UPLOAD SUCCESS');

    }
}