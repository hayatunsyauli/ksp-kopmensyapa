<?php 

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model{

	protected $table = 'anggota';
	protected $primaryKey ='no_anggota';
	protected $allowedFields = ['no_anggota','nrp','nama',
								'alamat','unit_kerja',
								'jabatan','nohp','email',
								'password','status_anggota','status_pengajuan','status_kerja',
								'profil'];

// ID Otomatis
	public function no_anggota(){
		$idp = $this->table('anggota');
		$idp->selectMax('no_anggota','kodemax');
		$qry = $idp->get();
		$kd = "";
		if ($qry->getNumRows()>0) {
			foreach ($qry->getResult() as $k) {
				$ambildata = substr($k->kodemax, -4);
				$tmp = intval($ambildata)+1;
				$kd = sprintf("%04s",$tmp);
			}
		}else{
			$kd = "0001";
		}
		date_default_timezone_set('Asia/Jakarta');
		return date('Ym').$kd;
	}

	public function jmlAnggotaAktif()	{
		$query = $this->db->query("SELECT * FROM anggota where status_anggota = 'Aktif'");
		return $query->getNumRows();
	}
	public function jmlAnggota()	{
		$query = $this->db->query("SELECT * FROM anggota where status_anggota = 'Tidak Aktif'");
		return $query->getNumRows();
	}

	public function getAnggota($no_anggota){
		$query = $this->db->query("SELECT * FROM anggota where no_anggota = $no_anggota");
		return $query->getResultArray();
	}

	public function getAnggotaById($no_anggota){
	$query = $this->db->query("SELECT * FROM anggota where no_anggota = $no_anggota");
		return $query->getRowArray();
	}

	public function lapAnggotaBySts($sts){
        return $this->db->table('anggota')->where('status_anggota',$sts)->get()->getResultArray();
	}

	// $query = $this->db->query("SELECT * FROM pengajuan_pinjaman pp JOIN jenis_pinjaman jp ON pp.id_jenis_pinjaman = jp.id WHERE id_pengajuan =$id_pengajuan");
        // return $query->getRow();

	// public function getAnggotaById($nrp = false){
	// // $query = $this->db->query("SELECT * FROM anggota where no_anggota = $no_anggota");
	// // 	return $query->getRowArray();

	// 	if ($nrp == false) {
	// 		return $this->findAll();
	// 	}

	// 	return $this->where(['nrp' =>$nrp])->first();
	
	// }

// join input anggota dan simpanan pokok


	public function lapTagihan($bln,$thn)
    {	
		$query = $this->db->query("
			SELECT anggota.no_anggota, anggota.nama,
			       COALESCE(a_sukarela.debet, 0) AS simpanan_sukarela,
			       COALESCE(a_panjang.angsuran_pembayaran, 0) AS pinjaman_panjang,
			       COALESCE(a_barang.angsuran_pembayaran, 0) AS pinjaman_barang,
			       COALESCE(a_wajib.debet, 0) AS simpanan_wajib
			FROM anggota
			LEFT JOIN (
			    SELECT no_anggota, SUM(debet) AS debet
			    FROM simpanan_detail
			    WHERE id_jenis_simpanan = 3
			    AND MONTH(tanggal) = $bln
			      AND YEAR(tanggal) = $thn
			      AND sts_setor = 'Otomatis'
			    GROUP BY no_anggota
			) a_sukarela ON anggota.no_anggota = a_sukarela.no_anggota
			LEFT JOIN (
			    SELECT no_anggota, SUM(angsuran_pembayaran) AS angsuran_pembayaran
			    FROM angsuran
			    WHERE id_jenis_pinjaman = 2
			      AND MONTH(tgl_angsuran) = $bln
			      AND YEAR(tgl_angsuran) = $thn
			    GROUP BY no_anggota
			) a_panjang ON anggota.no_anggota = a_panjang.no_anggota
			LEFT JOIN (
			    SELECT no_anggota, SUM(angsuran_pembayaran) AS angsuran_pembayaran
			    FROM angsuran
			    WHERE id_jenis_pinjaman = 3
			      AND MONTH(tgl_angsuran) = $bln
			      AND YEAR(tgl_angsuran) = $thn
			    GROUP BY no_anggota
			) a_barang ON anggota.no_anggota = a_barang.no_anggota
			LEFT JOIN (
			    SELECT no_anggota, SUM(debet) AS debet
			    FROM simpanan_detail
			    WHERE id_jenis_simpanan = 2
			    AND MONTH(tanggal) = $bln
			      AND YEAR(tanggal) = $thn
			    GROUP BY no_anggota
			) a_wajib ON anggota.no_anggota = a_wajib.no_anggota;
			");

       return $query->getResultArray();
    }
}
 
?>
