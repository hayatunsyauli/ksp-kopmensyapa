<?php

namespace App\Models;

use CodeIgniter\Model;

class KasModel extends Model
{
    protected $table = 'kas';
    protected $primaryKey ='id_kas';
    protected $allowedFields = ['id_kas','uraian','id_uraian','ke','kas_debit','kas_credit','status','tanggal_kas'];

    public function getAllKas() {
        $query = $this->db->query("SELECT * FROM kas k JOIN kas_uraian ku ON k.id_uraian = ku.id_uraian ORDER by id_kas DESC ");
        return $query->getResultArray();
    }

    public function getAllKasbyStatusDebet() {
        $query = $this->db->query("SELECT * FROM kas k JOIN kas_uraian ku ON k.id_uraian = ku.id_uraian where status = 'Debet' ORDER by id_kas DESC ");
        return $query->getResultArray();
    }
    public function getAllKasbyStatusKredit() {
        $query = $this->db->query("SELECT * FROM kas k JOIN kas_uraian ku ON k.id_uraian = ku.id_uraian where status = 'Kredit' ORDER by id_kas DESC ");
        return $query->getResultArray();
    }

    public function allDataKas($id_kas)
    {
        $query = $this->db->query("SELECT * FROM kas k JOIN kas_uraian ku ON k.id_uraian = ku.id_uraian where id_kas = $id_kas ");
        return $query->getRowArray();
    }

    public function lapKasBulanan($bln,$thn)
    {
        return $this->db->table('kas')
        ->join('kas_uraian', 'kas_uraian.id_uraian = kas.id_uraian')
        ->where('MONTH(kas.tanggal_kas)',$bln)->where('YEAR(kas.tanggal_kas)',$thn)->get()->getResultArray();
    }

    public function lapKasTahunan($thn)
    {
        return $this->db->table('kas')
        ->join('kas_uraian', 'kas_uraian.id_uraian = kas.id_uraian')
        ->where('YEAR(kas.tanggal_kas)',$thn)->get()->getResultArray();
    }

    public function lapKasBulananDebet($bln,$thn)
    {
        return $this->db->table('kas')
        ->join('kas_uraian', 'kas_uraian.id_uraian = kas.id_uraian')
        ->where('status','Debet')
        ->where('MONTH(kas.tanggal_kas)',$bln)
        ->where('YEAR(kas.tanggal_kas)',$thn)->get()->getResultArray();
    }

    public function lapKasTahunanDebet($thn)
    {
        return $this->db->table('kas')
        ->join('kas_uraian', 'kas_uraian.id_uraian = kas.id_uraian')
        ->where('status','Debet')
        ->where('YEAR(kas.tanggal_kas)',$thn)->get()->getResultArray();
    }

    public function lapKasBulananKredit($bln,$thn)
    {
        return $this->db->table('kas')
        ->join('kas_uraian', 'kas_uraian.id_uraian = kas.id_uraian')
        ->where('status','Kredit')
        ->where('MONTH(kas.tanggal_kas)',$bln)
        ->where('YEAR(kas.tanggal_kas)',$thn)->get()->getResultArray();
    }

    public function lapKasTahunanKredit($thn)
    {
        return $this->db->table('kas')
        ->join('kas_uraian', 'kas_uraian.id_uraian = kas.id_uraian')
        ->where('status','Kredit')
        ->where('YEAR(kas.tanggal_kas)',$thn)->get()->getResultArray();
    }

    // public function lapKasBulanan($bln,$thn)
    // {
    //     // code...
    // }
    
}
