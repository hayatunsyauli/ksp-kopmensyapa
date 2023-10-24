<?php

namespace App\Models;

use CodeIgniter\Model;

class PinjamanModel extends Model
{
    protected $table         = 'pinjaman';
    protected $primaryKey    = 'id_pinjaman';
    protected $allowedFields = ['id_pinjaman','no_anggota','id_pengajuan','id_jenis_pinjaman','status_pinjaman','tgl_pinjam','tgl_jth_tempo','jml_pinjaman','jasa','jml_angsuran',];

    public function getIdPinjamanbyAng($no_anggota)
    {
        return $this->db->table('pinjaman')->join(
            'anggota', 'anggota.no_anggota = pinjaman.no_anggota'
        )->where([
            'pinjaman.no_anggota' => $no_anggota
        ])->get()->getRowArray();
    }
    
    public function dataPengajuanByStatus($no_anggota)
    {
        $query = $this->db->query("SELECT * FROM pengajuan_pinjaman WHERE no_anggota = $no_anggota ORDER BY id_pengajuan DESC LIMIT 10");
        return $query->getRow();
    }

    public function dataPengajuanByStatusPinjaman($no_anggota)
    {
        $query = $this->db->query("SELECT * FROM pinjaman WHERE no_anggota=$no_anggota LIMIT 10");
        return $query->getRow();
    }

    public function dataPengunduranBystatus($no_anggota)
    {
        $query = $this->db->query("SELECT * FROM pengunduran_anggota WHERE no_anggota = $no_anggota ORDER by id_pengunduran DESC LIMIT  1");
        return $query->getRow();
    }

    public function insertPengajuan()
    {
        // $status = $this->session('no_anggota');
        $no_anggota = $_POST['no_anggota'];
        $bsr_pengajuan = $_POST['jumlah_pinjaman'];
        $tgl_pengajuan = $_POST['tgl_pengajuan'];

        $data = [
            'no_anggota' => $no_anggota,
            'bsr_pengajuan' => $bsr_pengajuan,
            'tgl_pengajuan' => $tgl_pengajuan,
        ];
        $this->$db->insert('pengajuan_pinjaman', $data);
    }

    public function deletePengajuan($data)
    {
        $this->db->table('pengajuan_pinjaman')->where('id_pengajuan', $data['id_pengajuan'])->delete($data);
    }

    public function updatePengajuan($data)
    {
        $this->db->table('pengajuan_pinjaman')->where('id_pengajuan', $data['id_pengajuan'])->update($data);
    }

    public function dataPengajuanByStatusJnsPjm($id_pengajuan)
    {
        $query = $this->db->query("SELECT * FROM pengajuan_pinjaman pp JOIN jenis_pinjaman jp ON pp.id_jenis_pinjaman = jp.id WHERE id_pengajuan =$id_pengajuan");
        return $query->getRow();
    }

    public function dataPinjamanBy($no_anggota)
    {
        $query = $this->db->query("SELECT * FROM pengajuan_pinjaman pp JOIN pinjaman p ON pp.id_pengajuan = p.id_pengajuan JOIN anggota ang ON p.no_anggota = ang.no_anggota where ang.no_anggota=$no_anggota");
        return $query->getResultArray();
    }

    public function hitungAngsuranBy($no_anggota)
    {
        $query = $this->db->query("SELECT * FROM angsuran asr JOIN pinjaman ang ON asr.id_pinjaman = ang.id_pinjaman where ang.no_anggota=$no_anggota");
        return $query->getNumRows();
    }

    public function hitungAngsuranSetorByIdPinjaman($id_pinjaman)
    {
        return $this->db->table('angsuran')->where(['id_pinjaman' => $id_pinjaman])->get()->getNumRows();
        // $query = $this->db->query("SELECT * FROM angsuran WHERE id_pinjaman=$id_pinjaman");
        // return $query->getNumRows();
    }

    public function dataPinjamanByIdPinjaman()
    {
        return $this->db->table('pinjaman')
        ->join(
            'pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan'
        )->join(
            'jenis_pinjaman', 'jenis_pinjaman.id = pengajuan_pinjaman.id_jenis_pinjaman'
        )->join(
            'anggota', 'pinjaman.no_anggota = anggota.no_anggota'
        )->orderBy('pinjaman.id_pinjaman DESC' )->get()->getResultArray();
    }

    public function allDataPinjamanById($id_pinjaman)
    {
        return $this->db->table('pinjaman')->join(
            'pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan'
        )->join(
            'jenis_pinjaman', 'jenis_pinjaman.id = pengajuan_pinjaman.id_jenis_pinjaman'
        )->join(
            'anggota', 'anggota.no_anggota = pinjaman.no_anggota'
        )->where([
            'pinjaman.id_pinjaman' => $id_pinjaman
        ])->get()->getResultArray();
    }

    public function dataAngsuranById($id_pinjaman)
    {
        $query = $this->db->query("SELECT * FROM pinjaman pp 
            JOIN angsuran asr ON pp.id_pinjaman = asr.id_pinjaman 
            where pp.id_pinjaman = `$id_pinjaman` ORDER BY asr.id_angsuran DESC");
        return $query->getResultArray();
    }

    public function lapPinjamanHarian($tgl,$bln,$thn)
    {
        return $this->db->table('pinjaman')
        ->join('anggota', 'anggota.no_anggota = pinjaman.no_anggota')
        ->where('DAY(tgl_pinjam)',$tgl)->where('MONTH(tgl_pinjam)',$bln)->where('YEAR(tgl_pinjam)',$thn)->get()->getResultArray();
    }
    public function lapPinjamanBulanan($bln,$thn)
    {
        return $this->db->table('pinjaman')
        ->join('anggota', 'anggota.no_anggota = pinjaman.no_anggota')
        ->where('MONTH(tgl_pinjam)',$bln)->where('YEAR(tgl_pinjam)',$thn)->get()->getResultArray();
    }
    public function lapPinjamanTahunan($thn)
    {
        return $this->db->table('pinjaman')
        ->join('anggota', 'anggota.no_anggota = pinjaman.no_anggota')
        ->where('YEAR(tgl_pinjam)',$thn)->get()->getResultArray();
    }
    
    public function lapPinjamBulanan($bln,$thn,$jns)//filter punya
    {
        return $this->db->table('pinjaman')
        ->join('anggota', 'anggota.no_anggota = pinjaman.no_anggota')
        ->join('pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan')
        ->join('jenis_pinjaman', 'jenis_pinjaman.id = pengajuan_pinjaman.id_jenis_pinjaman')
        ->where('MONTH(pinjaman.tgl_pinjam)',$bln)
        ->where('YEAR(pinjaman.tgl_pinjam)',$thn)
        ->where('pengajuan_pinjaman.id_jenis_pinjaman', $jns)
        ->get()->getResultArray();
    }

    public function lapPinjamTahunan($thn,$jns)
    {
        return $this->db->table('pinjaman')
        ->join('anggota', 'anggota.no_anggota = pinjaman.no_anggota')
        ->join('pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan')
        ->join('jenis_pinjaman', 'jenis_pinjaman.id = pengajuan_pinjaman.id_jenis_pinjaman')
        // ->where('MONTH(pinjaman.tgl_pinjam)',$bln)
        ->where('YEAR(pinjaman.tgl_pinjam)',$thn)
        ->where('pengajuan_pinjaman.id_jenis_pinjaman', $jns)
        ->get()->getResultArray();
    }

    public function jumlahPinjamanByAnggota($no_anggota)
    {
        return $this->db->table('pinjaman')
        ->join(
            'pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan'
        )->where('pinjaman.no_anggota',$no_anggota)->get()->getResultArray();
    }
    public function jumlahPinjamanByAnggotaPanjang($no_anggota)
    {
        return $this->db->table('pinjaman')
        ->join(
            'pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan'
        )->where('pinjaman.no_anggota',$no_anggota)->where('pengajuan_pinjaman.id_jenis_pinjaman', 2)->get()->getResultArray();
    }
    public function jumlahPinjamanByAnggotaPendek($no_anggota)
    {
        return $this->db->table('pinjaman')
        ->join(
            'pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan'
        )->where('pinjaman.no_anggota',$no_anggota)->where('pengajuan_pinjaman.id_jenis_pinjaman', 1)->get()->getResultArray();
    }
    public function jumlahPinjamanByAnggotaBkd($no_anggota)
    {
        return $this->db->table('pinjaman')
        ->join(
            'pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan'
        )->where('pinjaman.no_anggota',$no_anggota)->where('pengajuan_pinjaman.id_jenis_pinjaman', 3)->get()->getResultArray();
    }

    public function jumlahPinjaman()
    {
        return $this->db->table('pinjaman')
        ->join(
            'pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan'
        )->get()->getResultArray();
    }
    public function jumlahPinjamanByPanjang()
    {
        return $this->db->table('pinjaman')
        ->join(
            'pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan'
        )->where('pengajuan_pinjaman.id_jenis_pinjaman', 2)
        ->where('pengajuan_pinjaman.status_pengajuan', 'Diterima')->get()->getResultArray();
    }
    public function jumlahPinjamanByPendek()
    {
        return $this->db->table('pinjaman')
        ->join(
            'pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan'
        )->where('pengajuan_pinjaman.id_jenis_pinjaman', 1)
        ->where('pengajuan_pinjaman.status_pengajuan', 'Diterima')->get()->getResultArray();
    }
    public function jumlahPinjamanByBkd()
    {
        return $this->db->table('pinjaman')
        ->join(
            'pengajuan_pinjaman', 'pengajuan_pinjaman.id_pengajuan = pinjaman.id_pengajuan'
        )->where('pengajuan_pinjaman.id_jenis_pinjaman', 3)
        ->where('pengajuan_pinjaman.status_pengajuan', 'Diterima')->get()->getResultArray();
    }
}

