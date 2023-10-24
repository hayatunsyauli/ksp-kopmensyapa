<?php 

namespace App\Models;

use CodeIgniter\Model;

class JenisPinjaman extends Model{

	protected $table = 'jenis_pinjaman';
	// protected $primaryKey = 'id_simpan_detail';
	protected $allowedFields = ['id','jenis_pinjaman','tanggal','jasa1','jasa2','kurang1_dari','kurang2_dari'];

	public function PinjamanByPendek()
	{
		$query = $this->db->query("SELECT jenis_pinjaman FROM jenis_pinjaman WHERE id = 1");
        return $query->getRowArray();
    }
	public function PinjamanByPanjang()
	{
		$query = $this->db->query("SELECT jenis_pinjaman FROM jenis_pinjaman WHERE id = 2");
        return $query->getRowArray();
    }
	public function PinjamanByBkd()
	{
		$query = $this->db->query("SELECT jenis_pinjaman FROM jenis_pinjaman WHERE id = 3");
        return $query->getRowArray();
    }

}

 
?>