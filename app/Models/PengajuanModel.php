<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanModel extends Model
{
    protected $table         = 'pengajuan_pinjaman';
    protected $primaryKey    = 'id_pengajuan';
    protected $allowedFields = ['id_pengajuan','no_anggota','tgl_pengajuan','status_pengajuan','bsr_pengajuan','id_jenis_pinjaman','lama_angsuran','pesan','jml_emas','tgl_verifikasi','tgl_veri_sekretaris'];

    public function getAllPengajuan()
    {
        $query = $this->db->query("SELECT * FROM pengajuan_pinjaman pp JOIN jenis_pinjaman jp ON pp.id_jenis_pinjaman = jp.id JOIN anggota ang ON pp.no_anggota = ang.no_anggota ORDER by id_pengajuan DESC");
        return $query->getResultArray();
    }
    
    public function dataPengajuan($no_anggota)
    {  
        return $this->db->table('pengajuan_pinjaman')->join(
            'jenis_pinjaman', 'jenis_pinjaman.id = pengajuan_pinjaman.id_jenis_pinjaman'
        )->where([
            'pengajuan_pinjaman.no_anggota' => $no_anggota
        ])->orderBy('pengajuan_pinjaman.id_pengajuan DESC')->get()->getResultArray();
    }
    
    public function dataPengajuanByStatusPengajuan($no_anggota)
    {
        $query = $this->db->query("SELECT * FROM pengajuan_pinjaman WHERE no_anggota = $no_anggota LIMIT 1");
        return $query->getResultArray();
    }

    public function dataPengajuanById($id_pengajuan)
    {
        return $this->db->table('pengajuan_pinjaman')->join(
            'pinjaman', 'pinjaman.id_pengajuan = pengajuan_pinjaman.id_pengajuan'
        )->join(
            'anggota', 'anggota.no_anggota = pinjaman.no_anggota'
        )->where([
            'pinjaman.id_pengajuan' => $id_pengajuan
        ])->get()->getRowArray();
    }

    public function dataPengajuanByIdPinjaman($id_pinjaman)
    {
        return $this->db->table('pengajuan_pinjaman')->join(
            'pinjaman', 'pinjaman.id_pengajuan = pengajuan_pinjaman.id_pengajuan'
        )->join(
            'anggota', 'anggota.no_anggota = pinjaman.no_anggota'
        )->where([
            'pinjaman.id_pinjaman' => $id_pinjaman
        ])->get()->getRowArray();
    }
    

    public function dataPengajuanByIdPengajuan($id_pengajuan)
    {
        return $this->db->table('pengajuan_pinjaman')->join(
            'anggota', 'anggota.no_anggota = pengajuan_pinjaman.no_anggota'
        )->where([
            'pengajuan_pinjaman.id_pengajuan' => $id_pengajuan
        ])->get()->getRowArray();
    }

    public function lapPengajuanHarian($tgl,$bln,$thn)
    {
        return $this->db->table('pengajuan_pinjaman')->where('DAY(tgl_pengajuan)',$tgl)->where('MONTH(tgl_pengajuan)',$bln)->where('YEAR(tgl_pengajuan)',$thn)->get()->getResultArray();
    }
    public function lapPengajuanBulanan($bln,$thn)
    {
        return $this->db->table('pengajuan_pinjaman')->where('MONTH(tgl_pengajuan)',$bln)->where('YEAR(tgl_pengajuan)',$thn)->get()->getResultArray();
    }
    public function lapPengajuanTahunan($thn)
    {
        return $this->db->table('pengajuan_pinjaman')->where('YEAR(tgl_pengajuan)',$thn)->get()->getResultArray();
    }
    
    public function jumlahPengajuanByAnggota($no_anggota)
    {
        return $this->db->table('pengajuan_pinjaman')->where('no_anggota',$no_anggota)->where('status_pengajuan', 'Diterima')->get()->getResultArray();
    }

    public function jumlahPengajuan()
    {
        return $this->db->table('pengajuan_pinjaman')->where('status_pengajuan', 'Diterima')->get()->getResultArray();
    }
    public function jumlahPengajuanDitolak()
    {
        return $this->db->table('pengajuan_pinjaman')->where('status_pengajuan', 'Ditolak')->get()->getResultArray();
    }


}

