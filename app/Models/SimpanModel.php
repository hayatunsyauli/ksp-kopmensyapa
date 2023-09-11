<?php 

namespace App\Models;

use CodeIgniter\Model;

class SimpanModel extends Model{

	protected $table = 'simpanan';
	protected $primaryKey = 'id_simpanan';
	protected $allowedFields = ['id_simpanan','no_anggota','simpanan_pokok','simpanan_sukarela','simpanan_wajib','status_simpanan'];

	public function jmlSimpanWajib(){
		$jmlSimpanWajib = "50000";
		return $jmlSimpanWajib;
	}

    public function getSimpananAnggota()
    {
        $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota a ON s.no_anggota = a.no_anggota where status_simpanan = 'Belum Ditarik' and a.status_anggota = 'Aktif' ORDER by tanggal DESC");
        return $query->getResultArray();

        // return $this->db->table('simpanan')
        // ->join('anggota', 'anggota.no_anggota = simpanan.no_anggota')
        // ->join('simpanan_detail', 'anggota.no_anggota = simpanan.no_anggota')
        // ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
        // ->where('simpanan.status_simpanan','Belum Ditarik')
        // ->where('anggota.status_anggota','Aktif')
        // ->get()->getResultArray();
    }
    public function getSimpananAnggotaNonAktif()
    {
        $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota a ON s.no_anggota = a.no_anggota where a.status_anggota = 'Tidak Aktif' ORDER by tanggal DESC");
        return $query->getResultArray();
    }

    public function hitungSimpananAnggota()
    {
        $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota a ON s.no_anggota = a.no_anggota where status_simpanan = 'Belum Ditarik' ORDER by tanggal DESC");
        return $query->getNumRows();
    }

	public function getSimpananById($id_simpanan){
		$query = $this->db->query("SELECT * FROM simpanan s JOIN anggota a ON s.no_anggota = a.no_anggota where s.id_simpanan=$id_simpanan ");
		return $query->getResultArray();
	}

    public function getSimpananWajib(){
        // $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota a ON s.no_anggota = a.no_anggota where s.id_simpanan=$id_simpanan ");
        // return $query->getResultArray();
        $query = $this->db->query("SELECT * FROM jenis_simpanan where jenis_simpanan = 'Simpanan Wajib' OR jenis_simpanan = 'simpanan Wajib' OR jenis_simpanan = 'Simpanan wajib' OR jenis_simpanan = 'simpanan wajib'  ");
        return $query->getRowArray();
    }    
    public function getSimpananSukarela(){
        // $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota a ON s.no_anggota = a.no_anggota where s.id_simpanan=$id_simpanan ");
        // return $query->getResultArray();
        $query = $this->db->query("SELECT * FROM jenis_simpanan where jenis_simpanan = 'Simpanan Sukarela' OR jenis_simpanan = 'simpanan Sukarela' OR jenis_simpanan = 'Simpanan sukarela' OR jenis_simpanan = 'simpanan sukarela'  ");
        return $query->getRowArray();
    }

    public function historySetorSimpananWajib($id_simpanan){
        // $query = $this->db->query("SELECT * FROM simpanan s JOIN simpanan_detail sd ON s.id_simpanan = sd.id_simpanan where s.id_simpanan=$id_simpanan and sd.id_jenis_simpanan='Simpanan Wajib' ORDER by id_simpan_detail DESC ");
        // return $query->getResultArray();

        return $this->db->table('simpanan')
        ->join('simpanan_detail', 'simpanan_detail.id_simpanan = simpanan.id_simpanan')
        ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
        ->where('simpanan.id_simpanan',$id_simpanan)
        ->where('jenis_simpanan.jenis_simpanan','Simpanan Wajib')
        ->orderBy('id_simpan_detail DESC')
        ->get()->getResultArray();
        
        // ->join('anggota', 'anggota.no_anggota = simpanan.no_anggota')
        // ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
    }

    public function historySetorSimpananSukarela($id_simpanan){
        // $query = $this->db->query("SELECT * FROM simpanan s JOIN simpanan_detail sd ON s.id_simpanan = sd.id_simpanan where s.id_simpanan=$id_simpanan and sd.jenis_simpanan='Simpanan Sukarela' ORDER by id_simpan_detail DESC ");
        // return $query->getResultArray();

        return $this->db->table('simpanan')
        ->join('simpanan_detail', 'simpanan_detail.id_simpanan = simpanan.id_simpanan')
        ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
        ->where('simpanan.id_simpanan',$id_simpanan)
        ->where('jenis_simpanan.jenis_simpanan','Simpanan Sukarela')
        ->orderBy('id_simpan_detail DESC')
        ->get()->getResultArray();
    }

    public function dataSimpananPenarikan(){
        $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota ang ON s.no_anggota = ang.no_anggota");
        return $query->getResultArray();
    }

    public function historyPenarikan($id_simpanan){
        $query = $this->db->query("SELECT * FROM simpanan s JOIN simpanan_detail ps ON s.id_simpanan = ps.id_simpanan where s.id_simpanan=$id_simpanan and ps.status = 'Kredit' ORDER by ps.tanggal DESC");
        return $query->getResultArray();
    }

    public function historyPenarikanAnggota($no_anggota){
        $query = $this->db->query("SELECT * FROM simpanan s JOIN penarikan_simpanan ps ON s.id_simpanan = ps.id_simpanan  join anggota ang ON s.no_anggota = ang.no_anggota where ang.no_anggota=$no_anggota ORDER by ps.tanggal_penarikan DESC");
        return $query->getResultArray();
    }

    public function getSimpananByNoAnggota($no_anggota) {
        $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota a ON s.no_anggota = a.no_anggota where s.no_anggota = $no_anggota");
        return $query->getResultArray();
    }
        public function getSimpananByAnggota($no_anggota) {
        $query = $this->db->query("SELECT * FROM anggota a JOIN simpanan s ON s.no_anggota = a.no_anggota where a.no_anggota = $no_anggota");
        return $query->getRowArray();
    }

    // public function getRiwayatSetoranById($id_simpanan)
    // {
    //     $query = $this->db->query("SELECT * FROM simpanan_detail JOIN simpanan ON simpanan_detail.id_simpanan = simpanan.id_simpanan JOIN anggota ON simpanan.no_anggota = anggota.no_anggota where simpanan.id_simpanan=$id_simpanan ORDER by simpanan_detail.tanggal DESC");
    //     return $query->getResultArray();
    // }

    public function getRiwayatSetoranByAnggota($no_anggota)
    {
/*        $query = $this->db->query("SELECT * FROM simpanan_detail where no_anggota=$no_anggota ORDER by simpanan_detail.tanggal DESC");
        return $query->getResultArray();
*/
        return $this->db->table('simpanan_detail')
        ->join('anggota', 'anggota.no_anggota = simpanan_detail.no_anggota')
        ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
        ->where('simpanan_detail.no_anggota', $no_anggota)->orderBy('simpanan_detail.tanggal DESC')
        ->get()->getResultArray();
    }

    public function getSimpananBySK($id_simpanan)
    {
        $query = $this->db->query("SELECT simpanan_sukarela FROM simpanan WHERE id_simpanan=$id_simpanan");
        return $query->getResultArray();

    }

    public function getSimpananAnggotaById($id_simpanan)
    {
        $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota ang ON s.no_anggota = ang.no_anggota WHERE s.id_simpanan=$id_simpanan");
        return $query->getResultArray();
    }

    public function getSimpananAnggotaByNoanggota($id_simpanan)
    {
        $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota ang ON s.no_anggota = ang.no_anggota WHERE s.id_simpanan = $id_simpanan");
        return $query->getRow();
    }
    public function getAnggotaByNoanggota($id_simpanan)
    {
        $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota ang ON s.no_anggota = ang.no_anggota WHERE s.id_simpanan = $id_simpanan");
        return $query->getResultArray();
    }

    public function allDataSimpanan($id_simpan_detail)
    {
        // $query = $this->db->query("SELECT * FROM simpanan_detail s JOIN anggota a ON s.no_anggota = a.no_anggota where s.id_simpan_detail=$id_simpan_detail ");
        // return $query->getRowArray();
        return $this->db->table('simpanan_detail')
        ->join('anggota', 'anggota.no_anggota = simpanan_detail.no_anggota')
        ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
        ->where('simpanan_detail.id_simpan_detail', $id_simpan_detail)->get()->getRowArray();
    }

    public function lapSimpananHarian($tgl,$bln,$thn)
    {
        return $this->db->table('simpanan')
        ->join('anggota', 'anggota.no_anggota = simpanan.no_anggota')
        ->where('DAY(tanggal)',$tgl)->where('MONTH(tanggal)',$bln)->where('YEAR(tanggal)',$thn)->get()->getResultArray();
    }

    public function lapSimpananBulanan($bln,$thn)
    {
        return $this->db->table('simpanan')
        ->join('anggota', 'anggota.no_anggota = simpanan.no_anggota')
        ->where('MONTH(tanggal)',$bln)->where('YEAR(tanggal)',$thn)->get()->getResultArray();
        /*
        return $this->db->table('simpanan')
        ->join('simpanan_detail', 'simpanan_detail.id_simpanan = simpanan.id_simpanan')
        ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
        ->where('simpanan.id_simpanan',$id_simpanan)
        ->where('jenis_simpanan.jenis_simpanan','Simpanan Wajib')
        ->orderBy('id_simpan_detail DESC')
        ->get()->getResultArray();
        */
    }
    
    public function lapSimpanan($bln,$thn,$jns)
    {
        // return $this->db->table('simpanan')
        // ->join('anggota', 'anggota.no_anggota = simpanan.no_anggota')
        // ->where('MONTH(tanggal)',$bln)->where('YEAR(tanggal)',$thn)->get()->getResultArray();

        // return $this->db->table('simpanan_detail')
        return $this->db->table('simpanan')
        ->join('simpanan_detail', 'simpanan_detail.id_simpanan = simpanan.id_simpanan')
        ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
        ->join('anggota', 'anggota.no_anggota = simpanan_detail.no_anggota')
        ->where('MONTH(simpanan.tanggal)',$bln)
        ->where('YEAR(simpanan.tanggal)',$thn)
        ->where('simpanan_detail.id_jenis_simpanan',$jns)
        ->get()->getResultArray();

// ->orderBy('id_simpan_detail DESC')
        // ->get()->getResultArray();
    }



    public function lapSimpananTahunan($thn)
    {
        return $this->db->table('simpanan')
        ->join('anggota', 'anggota.no_anggota = simpanan.no_anggota')
        ->where('YEAR(simpanan.tanggal)',$thn)->get()->getResultArray();
    }

    public function simpAllWajib($no_anggota)
    {
        $query = $this->db->query("SELECT * FROM simpanan s JOIN anggota ang ON s.no_anggota = ang.no_anggota WHERE s.no_anggota = $no_anggota");
        return $query->getResultArray();
    }

    public function simpanWajibNow($id_simpanan)
    {
        $query = $this->db->query("SELECT simpanan_wajib FROM simpanan  WHERE id_simpanan IN $id_simpanan");
        return $query->getResultArray();
    }

    public function jumlahSimpananByAnggota($no_anggota)
    {
        return $this->db->table('simpanan')->where('no_anggota',$no_anggota)->get()->getResultArray();
    }

    public function lapTagihanWajib($bln,$thn)
    {
        return $this->db->table('simpanan_detail')
        ->join('anggota', 'anggota.no_anggota = simpanan_detail.no_anggota')
        ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
        ->where('simpanan_detail.id_jenis_simpanan',2)
        ->where('simpanan_detail.id_jenis_simpanan',3)
        ->where('anggota.status_anggota',1)
        ->where('MONTH(simpanan_detail.tanggal)',$bln)
        ->where('YEAR(simpanan_detail.tanggal)',$thn)
        ->get()->getResultArray();
    }

    public function lapTagihanSukarela($bln,$thn)
    {
        return $this->db->table('simpanan_detail')
        ->join('anggota', 'anggota.no_anggota = simpanan_detail.no_anggota')
        ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
        ->where('anggota.status_anggota',1)
        ->where('jenis_simpanan.id',3)
        ->where('simpanan_detail.sts_setor', 'Otomatis')
        ->where('MONTH(simpanan_detail.tanggal)',$bln)
        ->where('YEAR(simpanan_detail.tanggal)',$thn)
        ->groupBy('anggota.no_anggota')
        ->get()->getResultArray();
    }
    /*public function lapTagihanSukarela($bln,$thn)
    {
        return $this->db->table('anggota')
        ->join('simpanan_detail', 'simpanan_detail.no_anggota = anggota.no_anggota')
        ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
        ->where('anggota.status_anggota',1)
        ->where('jenis_simpanan.id',3)
        ->where('simpanan_detail.sts_setor', 'Otomatis')
        ->where('MONTH(simpanan_detail.tanggal)',$bln)
        ->where('YEAR(simpanan_detail.tanggal)',$thn)
        ->get()->getResultArray();
    }*/

    public function lapSimpananBulananAnggota($bln,$thn,$no_anggota)
    {
        return $this->db->table('simpanan_detail')
        ->join('anggota', 'anggota.no_anggota = simpanan_detail.no_anggota')
        ->join('jenis_simpanan', 'jenis_simpanan.id = simpanan_detail.id_jenis_simpanan')
        // ->where('jenis_simpanan.id',2)
        // ->where('jenis_simpanan.id',3)
        // ->where('','Otomatis')
        ->where('MONTH(simpanan_detail.tanggal)',$bln)
        ->where('YEAR(simpanan_detail.tanggal)',$thn)
        ->where('simpanan_detail.no_anggota',$no_anggota)
        ->get()->getResultArray();
    }

}

?>