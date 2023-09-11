<?php 

namespace App\Models;

use CodeIgniter\Model;

class SimpanDetailModel extends Model{

	protected $table = 'simpanan_detail';
	protected $primaryKey = 'id_simpan_detail';
	protected $allowedFields = ['id_simpan_detail','id_simpanan','no_anggota','id_jenis_simpanan','debet','kredit','status','sts_setor'];

	
	public function getSimpananById($id_simpanan){
		// $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota a ON s.no_anggota = a.no_anggota JOIN simpanan_detail sd ON sd.id_jenis_pinjaman = s.id_jenis_simpanan OIN jenis_simpanan js ON js.id = s.id_jenis_simpanan where s.id_simpanan=$id_simpanan ");
		// return $query->getResultArray();

        return $this->db->table('simpanan_detail')
        ->join('anggota', 'anggota.no_anggota = simpanan.no_anggota')
        ->join('simpanan_detail', 'anggota.no_anggota = simpanan.no_anggota')
        ->where('DAY(tanggal)',$tgl)->where('MONTH(tanggal)',$bln)->where('YEAR(tanggal)',$thn)->get()->getResultArray();
	}

	public function getSimpananDetail($no_anggota)
	{
		return $this->db->table('simpanan_detail')
        // ->join('anggota', 'anggota.no_anggota = simpanan.no_anggota')
        // ->join('simpanan_detail', 'anggota.no_anggota = simpanan.no_anggota')
        ->where('no_anggota',$no_anggota)->get()->getResultArray();
	}

	public function allDataPenarikan($id_penarikan)
    {
    	return $this->db->table('simpanan_detail')
        ->join('anggota', 'anggota.no_anggota = simpanan_detail.no_anggota')
        // ->join('simpanan_detail', 'anggota.no_anggota = simpanan.no_anggota')
        ->where('id_simpan_detail',$id_penarikan)->get()->getRowArray();
        
        // $query = $this->db->query("SELECT * FROM penarikan_simpanan ps 
        //     JOIN simpanan s ON s.id_simpanan = ps.id_simpanan
        //     JOIN anggota a ON a.no_anggota = s.no_anggota where ps.id_penarikan = $id_penarikan ");
        // return $query->getRowArray();
    }
	

}

 
?>