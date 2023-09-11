<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController{

	public function __construct(){
        $this->authModel = new AuthModel();
	}

	public function login(){
        // $auth = $this->authModel->findAll();
        $data = [
            'title' => 'KOPMENSYAPA | Login',
            'validation' => \Config\Services::validation(),
            // 'auth' => $auth
        ];

        return view('auth/login',$data);
	}

	public function cek_login_ptg(){


		$validate = $this->validate([
			'username' => [
				'label' => 'Username',
				'rules' => 'required',
				'errors' => ['required' => 'Email Tidak Boleh Kosong!']
			],
			'password' => [
				'label' => 'Password',
				'rules' => 'required',
				'errors' => ['required' => '{field} Tidak Boleh Kosong!']
			],

		]) ;

		if (!$validate) {
			session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
			return redirect()->to(base_url('auth/login'));
		}

		$captcha_response = trim($this->request->getPost('g-recaptcha-response'));
		if ($captcha_response != '' ) {
			$keySecret = '6LevST4mAAAAAK1Lse9ndE65P_DhDfb0GxDueIy8';
			
			$startProses = curl_init();
			curl_setopt($startProses, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($startProses, CURLOPT_POST,true);
			curl_setopt($startProses, CURLOPT_POSTFIELDS, [
				'secret' => $keySecret,
				'response' => $this->request->getPost('g-recaptcha-response'),
			]);
			curl_setopt($startProses, CURLOPT_RETURNTRANSFER, true);

			$receiveData = curl_exec($startProses);

			$finalResponse = json_decode($receiveData, true);
			
			if ($finalResponse['success']) {
				
				$email = $this->request->getPost('username');
				$password = htmlspecialchars(md5($this->request->getPost('password')));
				$cek = $this->authModel->loginPtg($email,$password);
				if ($cek) {
					session()->set('id_petugas', $cek['id_petugas']);
					session()->set('nama', $cek['nama']);
					session()->set('username', $cek['username']);
					session()->set('level', $cek['level']);
				}
			}else{
				// if data tidak cocok
				session()->setFlashdata('gagal','Login Gagal!, Username atau Password tidak cocok!');
				return redirect()->to(base_url('auth/login'));
			}
		}else{
			session()->setFlashdata('gagal','Validasi reCAPTCHA gagal');
			return redirect()->to(base_url('auth/login'));
		}
		//jika tidak valid
		session()->setFlashdata('gagal','Login Gagal!, Username atau Password tidak cocok!');
		return redirect()->to(base_url('auth/login'));
	}


	public function cek_login_ang(){
	 	
		$validate = $this->validate([
			'email' => [
				'label' => 'email',
				'rules' => 'required',
				'errors' => ['required' => 'NRP atau  Tidak Boleh Kosong!']
			],
			'password' => [
				'label' => 'Password',
				'rules' => 'required',
				'errors' => ['required' => '{field} Tidak Boleh Kosong!']
			],
		]);

		if (!$validate) {
			session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
			return redirect()->to(base_url('auth/login'));
		}

		$captcha_response = trim($this->request->getPost('g-recaptcha-response'));
		if ($captcha_response != '' ) {
			$keySecret = '6LevST4mAAAAAK1Lse9ndE65P_DhDfb0GxDueIy8';
			
			$startProses = curl_init();
			curl_setopt($startProses, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
			curl_setopt($startProses, CURLOPT_POST,true);
			curl_setopt($startProses, CURLOPT_POSTFIELDS, [
				'secret' => $keySecret,
				'response' => $this->request->getPost('g-recaptcha-response'),
			]);
			curl_setopt($startProses, CURLOPT_RETURNTRANSFER, true);

			$receiveData = curl_exec($startProses);

			$finalResponse = json_decode($receiveData, true);
			
			if ($finalResponse['success']) {
				
				$email = $this->request->getPost('email');
				$password = htmlspecialchars(md5($this->request->getPost('password')));
				// $password = $this->request->getPost('password');
				$cek = $this->authModel->loginAng($email,$password);
				if ($cek) {
					session()->set('no_anggota', $cek['no_anggota']);
					session()->set('nama', $cek['nama']);
					session()->set('email', $cek['email']);
					// session()->set('no_anggota', $cek['no_anggota']);
					session()->set('level', 'Anggota');
				}
			}else{
				// if data tidak cocok
				session()->setFlashdata('gagal','Login Gagal!, Username atau Password tidak cocok!');
				return redirect()->to(base_url('auth/login'));
			}
		}else{
			session()->setFlashdata('gagal','Validasi reCAPTCHA gagal');
			return redirect()->to(base_url('auth/login'));
		}
		//jika tidak valid
		session()->setFlashdata('gagal','Login Gagal!, Username atau Password tidak cocok!');
		return redirect()->to(base_url('auth/login'));
	}

	public function logout(){

		// session()->remove('log');
		session()->remove('nama');
		session()->remove('username');
		session()->remove('level');
		session()->remove('id_petugas');
		
		session()->setFlashdata('pesan','Logout Berhasil!');
		return redirect()->to(base_url('auth/login'));
	}
	public function logoutAng(){

		// session()->remove('log');
		session()->remove('nama');
		session()->remove('email');
		session()->remove('level');
		session()->remove('no_anggota');
		
		session()->setFlashdata('pesan','Logout Berhasil!');
		return redirect()->to(base_url('auth/login'));
	}
}
   