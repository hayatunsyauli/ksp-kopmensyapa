<?php

namespace App\Models;

use CodeIgniter\Model;

class TariksimpananModel extends Model
{

    protected $table = 'penarikan_simpanan';
    protected $primaryKey = 'id_penarikan';
    protected $allowedFields = ['id_penarikan','id_simpanan','nominal_penarikan','tanggal_penarikan','ket'];

    public function allDataPenarikan($id_penarikan)
    {
        $query = $this->db->query("SELECT * FROM penarikan_simpanan ps 
            JOIN simpanan s ON s.id_simpanan = ps.id_simpanan
            JOIN anggota a ON a.no_anggota = s.no_anggota where ps.id_penarikan = $id_penarikan ");
        return $query->getRowArray();
    }

    public function lapPenarikanHarian($tgl,$bln,$thn)
    {
        return $this->db->table('penarikan_simpanan')
        ->join(
            'simpanan', 'simpanan.id_simpanan = penarikan_simpanan.id_simpanan'
        )->join(
            'anggota', 'anggota.no_anggota = simpanan.no_anggota'
        )->where(
            'DAY(tanggal_penarikan)',$tgl
        )->where(
            'MONTH(tanggal_penarikan)',$bln
        )->where(
            'YEAR(tanggal_penarikan)',$thn
        )->get()->getResultArray();
    }

    public function lapPenarikanBulanan($bln,$thn)
    {
        return $this->db->table('penarikan_simpanan')
        ->join(
            'simpanan', 'simpanan.id_simpanan = penarikan_simpanan.id_simpanan'
        )->join(
            'anggota', 'anggota.no_anggota = simpanan.no_anggota'
        )->where(
            'MONTH(tanggal_penarikan)',$bln
        )->where(
            'YEAR(tanggal_penarikan)',$thn
        )->get()->getResultArray();
    }

    public function lapPenarikanTahunan($thn)
    {
        return $this->db->table('penarikan_simpanan')
        ->join(
            'simpanan', 'simpanan.id_simpanan = penarikan_simpanan.id_simpanan'
        )->join(
            'anggota', 'anggota.no_anggota = simpanan.no_anggota'
        )->where(
            'YEAR(tanggal_penarikan)',$thn
        )->get()->getResultArray();
    }

}
