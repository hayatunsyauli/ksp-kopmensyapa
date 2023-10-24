<?php

namespace App\Models;

use CodeIgniter\Model;

class AngsuranModel extends Model
{
    protected $table         = 'angsuran';
    protected $primaryKey    = 'id_angsuran';
    protected $allowedFields = ['id_angsuran','id_pinjaman','id_petugas','id_jenis_pinjaman','no_anggota','tgl_angsuran','angsuran_pembayaran','ket'];

    public function dataAngsuranById($id_pinjaman)
    {
        return $this->db->table('angsuran')->join(
            'pinjaman', 'pinjaman.id_pinjaman = angsuran.id_pinjaman'
        )->where([
            'angsuran.id_pinjaman' => $id_pinjaman
        ])->get()->getResultArray();
    }

    public function countAngsuranByAnggota($no_anggota, $id_pinjaman)
    {
        // return $this->db->table('angsuran')->join(
        //     'pinjaman', 'pinjaman.id_pinjaman = angsuran.id_pinjaman'
        // )->join(
        //     'anggota', 'anggota.no_anggota = pinjaman.no_anggota'
        // )->where([
        //     'pinjaman.no_anggota' => $no_anggota
        // ])->get()->getNumRows();

        return $this->db->table('pinjaman')->join(
            'angsuran', 'angsuran.id_pinjaman = pinjaman.id_pinjaman'
        )->join(
            'anggota', 'anggota.no_anggota = pinjaman.no_anggota'
        )->where([
            'pinjaman.no_anggota' => $no_anggota
        ])->where([
            'angsuran.id_pinjaman' => $id_pinjaman
        ])->get()->getNumRows();
    } 
    
    public function dataAngsuranByIdPengajuan($id_pengajuan)
    {
        return $this->db->table('pengajuan_pinjaman')->join(
            'pinjaman', 'pinjaman.id_pengajuan = pengajuan_pinjaman.id_pengajuan'
        )->join(
            'anggota', 'anggota.no_anggota = pinjaman.no_anggota'
        )->join(
        'angsuran', 'angsuran.id_pinjaman = pinjaman.id_pinjaman'
        )->where([
            'pinjaman.id_pengajuan' => $id_pengajuan
        ])->get()->getResultArray();
    }    

    public function dataAngsuranByIdPinjaman($id_pinjaman)
    {
        return $this->db->table('pengajuan_pinjaman')->join(
            'pinjaman', 'pinjaman.id_pengajuan = pengajuan_pinjaman.id_pengajuan'
        )->join(
            'anggota', 'anggota.no_anggota = pinjaman.no_anggota'
        )->join(
        'angsuran', 'angsuran.id_pinjaman = pinjaman.id_pinjaman'
        )->where([
            'pinjaman.id_pinjaman' => $id_pinjaman
        ])->get()->getResultArray();
    }

    public function dataStsPinjamByIdPengajuan($id_pengajuan)
    {
        return $this->db->table('pengajuan_pinjaman')->join(
            'pinjaman', 'pinjaman.id_pengajuan = pengajuan_pinjaman.id_pengajuan'
        )->where([
            'pinjaman.id_pengajuan' => $id_pengajuan
        ])->get()->getRowArray();
    }

    public function dataStsPinjamByIdPinjaman($id_pinjaman)
    {
        return $this->db->table('pengajuan_pinjaman')->join(
            'pinjaman', 'pinjaman.id_pengajuan = pengajuan_pinjaman.id_pengajuan'
        )->where([
            'pinjaman.id_pinjaman' => $id_pinjaman
        ])->get()->getRowArray();
    }

    public function cekAngsuran($id_pinjaman)
    {
        return $this->db->table('angsuran')->where([
            'id_pinjaman' => $id_pinjaman
        ])->LIMIT('1')->get()->getRow();

        // $query = $this->db->query("SELECT * FROM angsuran WHERE id_pinjaman = $id_pinjaman LIMIT 1");
        // return $query->getResultArray();
    }

    public function allDataAngsuran($id_angsuran)
    {
        return $this->db->table('angsuran')->join(
            'pinjaman', 'pinjaman.id_pinjaman = angsuran.id_pinjaman'
        )->join(
            'anggota', 'anggota.no_anggota = pinjaman.no_anggota'
        )->where([
            'angsuran.id_angsuran' => $id_angsuran
        ])->get()->getRowArray();
    }
}
