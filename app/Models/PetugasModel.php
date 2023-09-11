<?php 

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model{

	protected $table = 'petugas';
	protected $primaryKey ='id_petugas';
	// protected $useTimestamps = true;
	protected $allowedFields = ['id_petugas','username','password','nama','level'];

	public function id(){
		$idp = $this->table('petugas');
		$idp->selectMax('id_petugas','kodemax');
		$qry = $idp->get();

		if ($qry->getNumRows()>0) {
			foreach ($qry->getResult() as $key){
				$kd = '';
				$ambildata = substr($key->kodemax, -3);
				$increment = intval($ambildata)+1;
				$kd = sprintf('%03s',$increment);
			}
		}else{
			$kd = '001';
		}
		return "PT".$kd;
	}

	public function getAllPengajuan()
	{
		$query = $this->db->query("SELECT * FROM pengajuan_pinjaman pp JOIN jenis_pinjaman jp ON pp.id_jenis_pinjaman = jp.id JOIN anggota ang ON pp.no_anggota = ang.no_anggota ORDER by id_pengajuan DESC");
        return $query->getResultArray();
	}

	public function dataPetugasById($petugas)
	{
		// $query = $this->db->query("SELECT * FROM petugas where id_petugas = $petugas");
        

        return $this->db->table('petugas')->where('id_petugas', $petugas)->get()->getRowArray();
	}

	// public function getPetugas($id_petugas){
	// 	$query = $this->db->query("SELECT * FROM petugas where id_petugas = $id_petugas");
	// 	return $query->getResultArray();
	// }

	// public function getPetugasById($idpetugas){
 //        $query = $this->db->query("SELECT * FROM petugas where id_petugas = $idpetugas");
 //        return $query->getRowArray();
 //    }

}

 
?>