<?php 

namespace App\Models;

use CodeIgniter\Model;

class JenisPinjaman extends Model{

	protected $table = 'jenis_pinjaman';
	// protected $primaryKey = 'id_simpan_detail';
	protected $allowedFields = ['id','jenis_pinjaman','tanggal','jasa1','jasa2','kurang1_dari','kurang2_dari'];

	public function getJenisPinjaman($no_anggota)
	{
		
	}
	

}

 
?>