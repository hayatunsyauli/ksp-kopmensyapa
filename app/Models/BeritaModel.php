<?php 

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model{

	protected $table = 'post';
	protected $primaryKey = 'id_post';
	protected $allowedFields = ['judul','nm_petugas','gambar','kontent','status','tanggal','slug'];


	public function getBerita($slug = false){
		if ($slug == false){
			return $this->findAll();
		}

		return $this->where(['slug' => $slug])->first();
	}

	public function judulberita($slug){
		$query = $this->db->query("SELECT judul FROM post WHERE slug = $slug ");
		return $query;
	}

} 
?>