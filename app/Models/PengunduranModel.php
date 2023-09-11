<?php

namespace App\Models;

use CodeIgniter\Model;

class PengunduranModel extends Model
{
    protected $table         = 'pengunduran_anggota';
    protected $primaryKey    = 'id_pengunduran';
    protected $allowedFields = ['id_pengunduran','no_anggota','status_pengunduran','tgl_pengajuan','tanggal','tgl_verifikasi','ket'];

    public function GetAllPengunduran()
    {
        $query = $this->db->query("SELECT * FROM pengunduran_anggota pa JOIN anggota ang ON pa.no_anggota = ang.no_anggota ORDER by pa.id_pengunduran DESC");
        return $query->getResultArray();
    }

    public function getAllPengunduranAnggota($no_anggota)
    {
        $query = $this->db->query("SELECT * FROM pengunduran_anggota pa JOIN anggota ang ON pa.no_anggota = ang.no_anggota where pa.no_anggota = $no_anggota");
        return $query->getResultArray();
    }

    public function pengunduranById($id_pengunduran)
    {
       $query = $this->db->query("SELECT * FROM pengunduran_anggota where id_pengunduran = $id_pengunduran ORDER BY id_pengunduran DESC LIMIT 1");
        return $query->getRow();
    }
}
