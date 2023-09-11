<?php 

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model{

	public function loginPtg($email,$password){
		return $this->db->table('petugas')->where([
			'username' => $email,
			'password' => $password,
		])->get()->getRowArray();
	}

	public function loginAng($email,$password){
		return $this->db->table('anggota')
		->where(
			"(nrp='$email' OR email='$email')")
		->where(
			'password', $password)
		->get()->getRowArray();
	}

}

 
?>