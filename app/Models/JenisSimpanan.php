<?php 

namespace App\Models;

use CodeIgniter\Model;

class JenisSimpanan extends Model{

	protected $table = 'jenis_simpanan';
	// protected $primaryKey = 'id_simpan_detail';
	protected $allowedFields = ['id','jenis_simpanan','jumlah','created_at'];
	
		// Simpanan pokok default
	public function simpananPkk(){
		$query = $this->db->query("SELECT * FROM jenis_simpanan where jenis_simpanan = 'Simpanan Pokok' OR jenis_simpanan = 'simpanan Pokok' OR jenis_simpanan = 'simpanan pokok' OR jenis_simpanan = 'Simpanan pokok'  ");
		return $query->getRowArray();
	}

}

 
?>