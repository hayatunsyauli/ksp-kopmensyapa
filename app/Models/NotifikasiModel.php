<?php

namespace App\Models;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';
    protected $allowedFields = ['id_referensi','judul','detail','no_anggota','level','level_b','level_c','is_read','created_at'];

    public function notifikasiByAnggota($no_anggota)
    {
        // $query = $this->db->query("SELECT * FROM notifikasi where no_anggota = $no_anggota and is_read = 0 ORDER by created_at DESC");
        // return $query->getResultArray();
        return $this->db->table('notifikasi')
        ->join('notif_referensi', 'notif_referensi.id_referensi = notifikasi.id_referensi')
        ->where('no_anggota',$no_anggota)->where('is_read',0)
        ->orderBy('notifikasi.created_at DESC')
        ->get()->getResultArray();
    }
    public function allNotifikasiByAnggota($no_anggota)
    {
        $query = $this->db->query("SELECT * FROM notifikasi where no_anggota = $no_anggota ORDER by created_at DESC");
        return $query->getResultArray();
    }
    public function allNotifikasiLimitByAnggota($no_anggota)
    {
        $query = $this->db->query("SELECT * FROM notifikasi where no_anggota = $no_anggota ORDER by created_at DESC LIMIT 3");
        return $query->getResultArray();
    }
    public function allNotifikasiLimit()
    {
        $query = $this->db->query("SELECT * FROM notifikasi where level = 1 OR level_b = 1 OR level_c = 1 ORDER by created_at DESC LIMIT 3");
        return $query->getResultArray();
    }    
    public function countNotifikasiByAnggota($no_anggota)
    {
        $query = $this->db->query("SELECT * FROM notifikasi where no_anggota = $no_anggota AND is_read = 0 ORDER by created_at DESC");
        // $notif_count = count($query)->getResultArray();
        return $query->getNumRows();
    }

    public function notifikasiByLevelSek()
    {
        // $query = $this->db->query("SELECT * FROM notifikasi where level_c = '1' and is_read = 0 ORDER by created_at DESC");
        // return $query->getResultArray();
        return $this->db->table('notifikasi')
        ->join('notif_referensi', 'notif_referensi.id_referensi = notifikasi.id_referensi')
        ->where('level_c',1)->where('is_read',0)
        ->orderBy('notifikasi.created_at DESC')
        ->get()->getResultArray();
    }    
    public function allNotifikasiByLevelSek()
    {
        $query = $this->db->query("SELECT * FROM notifikasi where level_c = '1' ORDER by created_at DESC");
        return $query->getResultArray();
    }    
    public function countNotifikasiBylevelSek()
    {
        $query = $this->db->query("SELECT * FROM notifikasi where level_c = '1' and is_read = 0 ORDER by created_at DESC");
        // $notif_count = count($query)->getResultArray();
        return $query->getNumRows();
    }    

    public function notifikasiByLevelBen()
    {
        // $query = $this->db->query("SELECT * FROM notifikasi where level_b = '1' and is_read = 0 ORDER by created_at DESC");
        // return $query->getResultArray();
        return $this->db->table('notifikasi')
        ->join('notif_referensi', 'notif_referensi.id_referensi = notifikasi.id_referensi')
        ->where('level_b',1)->where('is_read',0)
        ->orderBy('notifikasi.created_at DESC')
        ->get()->getResultArray();
    }
    public function allNotifikasiByLevelBen()
    {
        $query = $this->db->query("SELECT * FROM notifikasi where level_b = '1' ORDER by created_at DESC");
        return $query->getResultArray();
    }    
    public function countNotifikasiBylevelBen()
    {
        $query = $this->db->query("SELECT * FROM notifikasi where level_b = '1' and is_read = 0 ORDER by created_at DESC");
        return $query->getNumRows();
    }
    
    public function notifikasiByLevelKetu()
    {
        // $query = $this->db->query("SELECT * FROM notifikasi where level = '1' and is_read = 0 ORDER by created_at DESC");
        // return $query->getResultArray();
        return $this->db->table('notifikasi')
        ->join('notif_referensi', 'notif_referensi.id_referensi = notifikasi.id_referensi')
        ->where('level',1)->where('is_read',0)
        ->orderBy('notifikasi.created_at DESC')
        ->get()->getResultArray();
    }
    public function allNotifikasiByLevelKetu()
    {
        $query = $this->db->query("SELECT * FROM notifikasi where level = '1' ORDER by created_at DESC");
        return $query->getResultArray();
    }    
    public function countNotifikasiBylevelKetu()
    {
        $query = $this->db->query("SELECT * FROM notifikasi where level = '1' and is_read = 0 ORDER by created_at DESC");
        return $query->getNumRows();
    }
}
