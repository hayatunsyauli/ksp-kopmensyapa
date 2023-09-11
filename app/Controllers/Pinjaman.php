<?php

namespace App\Controllers;

use App\Models\JenisPinjaman;
use App\Models\PinjamanModel;
use App\Models\PengajuanModel;
use App\Models\AnggotaModel;

// use App\Models\SimpanDetailModel;

class Pinjaman extends BaseController
{
    protected $jenisPinjaman;
    protected $pinjamanModel;
    protected $pengajuanModel;
    protected $anggotaModel;

    // protected $simpanDetailModel;

    public function __construct()
    {
        $this->jenisPinjaman = new JenisPinjaman();
        $this->pinjamanModel = new PinjamanModel();
        $this->pengajuanModel = new PengajuanModel();
        $this->anggotaModel = new AnggotaModel();

        // $this->simpanDetailModel = new SimpanDetailModel();
    }


    // ajukan Pinjaman Saya (anggota Personal)
    public function index()
    {
        $pinjaman = $this->pinjamanModel->dataPinjamanBy(session('no_anggota'));
        $angsuran = $this->pinjamanModel->hitungAngsuranBy(session('no_anggota'));
        $data = [
            'title' => 'Pinjaman',
            'pinjaman' => $pinjaman,
            'angsuran' => $angsuran,
            'judul' => 'Ajukan Pinjaman',
            'menu' => 'pinjaman',
            'submenu' => 'ajukan',
            'page' => 'pinjam/pinjamanSaya',
            'jumlahAnggota' => $this->anggotaModel->jmlAnggota(),
            'jumlahPinjaman' => $this->pinjamanModel->findAll(),
            'jumlahSimpanan' => $this->simpanModel->findAll(),
            'jumlahKas' => $this->kasModel->findAll(),

        ];

        return view('layout/tamplate-admin', $data);
    }

    public function pengajuan()
    {
        $pengajuan = $this->pinjamanModel->dataPengajuan(session('no_anggota'));
        $data = [
            'title' => 'Pengajuan Pinjaman',
            'pengajuan' => $pengajuan,
            'judul' => 'Ajukan Pinjaman',
            'menu' => 'pengajuan',
            'submenu' => 'ajukan',
            'page' => 'pinjam/pengajuan',

        ];

        return view('layout/tamplate-admin', $data);
    }

    public function rimayatPengajuan()
    {
        $data = [
            'title' => 'Riwayat Pengajuan',
            // 'setoranSaya' => $setoranSaya,
            'histori_penarikan' => $this->pinjamanModel->dataPengajuan(session('no_anggota')),
            'judul' => 'Riwayat Pengajuan Pinjaman',
            'menu' => 'pengajuan',
            'submenu' => 'riwayat-pengajuan',
            'page' => 'pinjam/rimayat-pengajuan',
        ];
        return view('layout/tamplate-admin',$data);
    }

}
