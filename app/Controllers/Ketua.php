<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PetugasModel;
use App\Models\JenisPinjaman;
use App\Models\PinjamanModel;
use App\Models\PengunduranModel;
use App\Models\PengajuanModel;
use App\Models\AnggotaModel;
use App\Models\SimpanModel;
use App\Models\SimpanDetailModel;
use App\Models\KasUraianModel;
use App\Models\KasModel;
use App\Models\NotifikasiModel;
use CodeIgniter\I18n\Time;
use App\Models\ProfilKopModel;

class Ketua extends BaseController
{
    protected $petugasModel;
    protected $jenisPinjaman;
    protected $pinjamanModel;
    protected $pengajuanModel;    
    protected $pengunduranModel;
    protected $anggotaModel;
    protected $simpanModel;
    protected $simpanDetailModel;
    protected $kasModel;
    protected $kasuraianModel;
    protected $notifikasiModel;
    protected $profilKopM;

    public function __construct()
    {
        $this->petugasModel     = new PetugasModel();
        $this->jenisPinjaman    = new JenisPinjaman();
        $this->pinjamanModel    = new PinjamanModel();
        $this->pengajuanModel   = new PengajuanModel();
        $this->pengunduranModel = new PengunduranModel();
        $this->anggotaModel     = new AnggotaModel();
        $this->simpanModel      = new SimpanModel();
        $this->simpanDetailModel = new SimpanDetailModel();
        $this->kasModel         = new KasModel();
        $this->kasuraianModel   = new KasUraianModel();
        $this->notifikasiModel    = new NotifikasiModel();
        $this->profilKopM = new ProfilKopModel();
    }

    public function index()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Dashboard',
            'judul'     => '',
            'menu'      => 'dashboard',
            'submenu'   => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'index',
            'dtpetugas' => $this->petugasModel->find(session('id_petugas')),
            'jumlahAnggotaAktif' => $this->anggotaModel->jmlAnggotaAktif(),
            'jumlahAnggota' => $this->anggotaModel->jmlAnggota(),
            'jumlahPinjaman' => $this->pinjamanModel->findAll(),
            'jumlahPinjaman' => $this->pinjamanModel->jumlahPinjaman(),
            'jumlahPinjamanPj' => $this->pinjamanModel->jumlahPinjamanByPanjang(),
            'jumlahPinjamanPd' => $this->pinjamanModel->jumlahPinjamanByPendek(),
            'jumlahPinjamanBkd' => $this->pinjamanModel->jumlahPinjamanByBkd(),
            'jumlahSimpanan' => $this->simpanModel->findAll(),
            'jumlahKas' => $this->kasModel->findAll(),
            'jumlahPengajuan' => $this->pengajuanModel->jumlahPengajuan(),
            'jumlahPengajuanDitolak' => $this->pengajuanModel->jumlahPengajuanDitolak(),
            'anggota' => $this->anggotaModel->findAll(),
            'notif'    => $notif_count,
            'allNotifikasi' => $this->notifikasiModel->allNotifikasiLimit(),
            'notifikasi' => $notifikasi,
        ];
        return view('layout/tamplate-admin',$data);
    }

// data anggota
    public function anggota(){
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $anggota = $this->anggotaModel->findAll();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Anggota',
            'anggota'   => $anggota,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'judul'     => 'Daftar data anggota',
            'menu'      => 'anggota',
            'submenu'   => 'subanggota',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'ketua/daftar-anggota',
        ];

        return view('layout/tamplate-admin', $data);
    }

// petugas
    public function petugas()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Petugas',
            'petugas'   => $this->petugasModel->findAll(),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'judul'     => 'Data Petugas Koperasi',
            'menu'      => 'petugas',
            'submenu'   => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'ketua/daftar-petugas',
        ];

        return view('layout/tamplate-admin',$data);
    }

    public function tambahPetugas(){
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Petugas',
            'id_petugas' => $this->petugasModel->id(),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'judul'     => 'Data Petugas Baru',
            'menu'      => 'petugas',
            'submenu'   => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'ketua/tambah-petugas',
        ];
        return view('layout/tamplate-admin',$data);

    }

    public function prosesTambahPetugas(){
        $this->petugasModel->insert([
            'id_petugas'=> $this->request->getVar('id'),
            'username'  => $this->request->getVar('username'),
            'password'  => htmlspecialchars(md5($this->request->getVar('password'))),
            'nama'      => $this->request->getVar('nama'),
            'level'     => $this->request->getVar('level')

        ]);
        session()->setFlashdata('pesan','Data berhasil disimpan');
        return redirect()->to('ketua/petugas');
    }

    public function editPetugas($id_petugas){
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Petugas',
            'id_petugas' => $this->petugasModel->find($id_petugas),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'judul'     => 'Data Petugas Baru',
            'menu'      => 'petugas',
            'submenu'   => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'ketua/edit-petugas',
        ];

        return view('layout/tamplate-admin',$data);
    }

    public function prosesEditPetugas($id_petugas){
        $this->petugasModel->save([
            'id_petugas'=> $this->request->getVar('id'),
            'username'  => $this->request->getVar('username'),
            'nama'      => $this->request->getVar('nama'),
            'level'     => $this->request->getVar('level')

        ]);
        session()->setFlashdata('pesan','Data petugas berhasil diupdate');
        return redirect()->to('ketua/petugas');
    }

    public function deletePtg($id_petugas){
        $this->petugasModel->delete($id_petugas);
        session()->setFlashdata('pesan','Petugas berhasil dihapus');
        return redirect()->to('ketua/petugas');
    }

// Data Pengajuan
    public function daftarPengajuan()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $pengajuan = $this->petugasModel->getAllPengajuan();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Pengajuan',
            'judul'     => 'Data Pengajuan Pinjaman',
            'pengajuan' => $pengajuan,
            'notif'     => $notif_count,
            'notifikasi'=> $notifikasi,
            'menu'      => 'pinjaman',
            'submenu'   => 'pengajuanPinjam',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'ketua/daftar-pengajuan',

        ];

        return view('layout/tamplate-admin', $data);
    }

    public function daftarPengunduranAnggota()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $pengajuan = $this->pengunduranModel->GetAllPengunduran();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Pengajuan',
            'judul'     => 'Data Pengunduran Anggota',
            'pengunduran' => $pengajuan,
            'notif'     => $notif_count,
            'notifikasi'=> $notifikasi,
            'menu'      => 'anggota',
            'submenu'   => 'pengunduran',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'ketua/daftar-pengunduran',

        ];

        return view('layout/tamplate-admin', $data);
    }

    public function prosesTerimaPengunduran($id_pengunduran)
    {
        $no_anggota = $this->request->getVar('no_anggota');
        $this->pengunduranModel->save([
            'id_pengunduran'      => $id_pengunduran,
            'status_pengunduran'  => '3',
            'tgl_verifikasi'    => date('Y-m-d H:i:s'),
            'ket'   => $this->request->getVar('ket'),
        ]);

        $this->anggotaModel->save([
            'no_anggota'      => $no_anggota,
            'status_anggota'  => '2',
        ]);
        
        $this->notifikasiModel->insert([
            'id_referensi' => 202308005,
            'judul' => 'Pengajuan Pengunduran Telah Diterima',
            'detail' => 'Pengajuan pengunduran diri anda telah <b>diterima</b>, Semua transaksi Simpan dan Pinjam tidak bisa di akses lagi. Riwayat transaksi sebelumnya masih dapat diakses',
            'no_anggota' => $no_anggota,
            'level_b' => 1,
            'is_read' => 0,
        ]);

        session()->setFlashdata('pesan','Pengunduran Berhasil diterima');
        return redirect()->to('ketua/daftarPengunduranAnggota');
    }

    public function prosesTerimaPinjaman($id_pengajuan)
    {
        $no_anggota = $this->request->getVar('no_anggota');
        $nama = $this->request->getVar('nama');
        $this->pengajuanModel->save([
            'id_pengajuan'      => $id_pengajuan,
            'status_pengajuan'  => 'Diterima',
            'tgl_verifikasi'    => date('Y-m-d H:i:s'),
        ]);

        $time = Time::parse(date('Y-m-d'));
        $thn_pjm = $time->getYear();
        $bln_pjm = $time->getMonth();
        $tgl_pjm = $time->getDay();
        $lm_angsur = $this->request->getVar('lama_angsuran');
        $tgl_tmp = date('Y-m-d H:i:s', mktime(0,0,0, $bln_pjm + $lm_angsur, $tgl_pjm, $thn_pjm)); 

        $this->pinjamanModel->insert([
            'id_pinjaman' => 'PJM'.date('YmdHis'),
            'no_anggota' => $no_anggota,
            'id_pengajuan' =>  $this->request->getVar('id_pengajuan'),
            'status_pinjaman' => 'Belum Lunas',
            'tgl_pinjam' => date('Y-m-d H:i:s'),
            'tgl_jth_tempo' => $tgl_tmp,
            'jml_pinjaman' =>  $this->request->getVar('bsr_pengajuan'),
            'jml_angsuran' => $this->request->getVar('angsuran_bulanan'),
            'jasa' => $this->request->getVar('jasa'),
        ]);

        $this->notifikasiModel->insert([
            'id_referensi' => 202308003,
            'judul' => 'Pengajuan Pinjaman Telah Diterima',
            // 'detail' => 'Pengajuan pinjaman anda telah <b>diterima</b>, silahkan lihat pada menu Pinjaman.',
            'detail' => 'Pengajuan pinjaman anda telah <b>diterima</b>, silahkan menjumpai petugas koperasi untuk melakukan akad Pinjaman.',
            'no_anggota' => $no_anggota,
            'is_read' => 0,
        ]);
        $this->notifikasiModel->insert([
            'id_referensi' => 202308007,
            'judul' => 'Pinjaman Baru',
            'detail' => 'Pengajuan pinjaman '.$nama.' ('.$no_anggota.') telah <b>diterima</b>, silahkan menghubungi anggota untuk segera melakukan akad Pinjaman.',
            // 'detail' => 'Pengajuan pinjaman anda telah <b>diterima</b>, silahkan datang ke Bendahara Koperasi untuk mengambil uang.',
            'level_b' => 1,
            'level' => 1,
            'level_c' => 1,
        ]);

        session()->setFlashdata('pesan','Pinjaman berhasil diterima');
        return redirect()->to('ketua/daftarPengajuan');
    }

    public function prosesTolakPengunduran($id) {
        $no_anggota = $this->request->getVar('no_anggota');

        $this->pengunduranModel->save([
            'id_pengunduran'      => $id,
            'status_pengunduran'  => '4',
            'tgl_verifikasi'    => date('Y-m-d H:i:s'),
            'ket'   => $this->request->getVar('ket'),
        ]);

        $this->notifikasiModel->insert([
            'id_referensi' => 202308005,
            'judul' => 'Pengajuan Pengunduran Ditolak',
            'detail' => 'Pengajuan pengunduran diri anda <b>ditolak</b>, silahkan cek keterangan lebih lanjut pada menu Profile.',
            'no_anggota' => $no_anggota,
            'is_read' => 0,
        ]);

        session()->setFlashdata('pesan','Pengunduran Berhasil Ditolak!');
        return redirect()->to('ketua/daftarPengunduranAnggota');
    }

    public function prosesTolakPinjaman($id_pengajuan) {
        $no_anggota = $this->request->getVar('no_anggota');

        $this->pengajuanModel->save([
            'id_pengajuan'      => $id_pengajuan,
            'status_pengajuan'  => '4',
            'tgl_verifikasi'    => date('Y-m-d H:i:s'),
            'pesan'   => $this->request->getVar('pesan'),
        ]);

        $this->notifikasiModel->insert([
            'id_referensi' => 202308001,
            'judul' => 'Pengajuan Pinjaman Ditolak',
            'detail' => 'Pengajuan Pinjaman  anda <b>ditolak</b>, silahkan cek keterangan lebih lanjut pada menu Pengajuan.',
            'no_anggota' => $no_anggota,
            'is_read' => 0,
        ]);

        session()->setFlashdata('pesan','Pangajuan pinjaman telah Ditolak!');
        return redirect()->to('ketua/daftarPengajuan');
    }

// Daftar Pinjaman
    public function daftarPinjaman()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Pengajuan',
            'judul'     => 'Data Pinjaman',
            'menu'      => 'pinjaman',
            'submenu'   => 'pinjaman',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'ketua/daftar-pinjaman',
            'pinjaman' => $this->pinjamanModel->dataPinjamanByIdPinjaman(),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];

        return view('layout/tamplate-admin', $data);
    }

// Data Simpanan
    public function dataSimpanan()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $simpan = $this->simpanModel->getSimpananAnggota();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Simpanan',
            'judul' => 'Data Simpanan Anggota',
            'simpan' => $simpan,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'menu' => 'simpanan',
            'submenu' => 'simpanan',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'ketua/daftar-simpanan',
            'footer' => 'layout/footer',


        ];

        return view('layout/tamplate-admin', $data);
    }

// Penarikan Simpanan
    public function penarikan()
    { //--Penarikan
        // $simpan = $this->simpanModel->findAll();
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Penarikan Simpanan',
            'judul' => 'Data Penarikan Simpanan Anggota',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'ketua/daftar-penarikan',
            'footer' => 'layout/footer',
            'menu' => 'simpanan',
            'submenu' => 'penarikan',
            'dataPenarikan' => $this->simpanModel->dataSimpananPenarikan(),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];

        return view('layout/tamplate-admin', $data);
    }

//Data Kas Account
    public function kas()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Kas Koperasi',
            'judul'     => '',
            'menu'      => 'kas',
            'submenu'   => 'kas-rekap',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'ketua/kas',
            'uraiann'   => $this->kasuraianModel->findAll(),
            'kas'       => $this->kasModel->getAllKas(),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        
        return view('layout/tamplate-admin',$data);
    }
    public function kasDebet()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Kas Koperasi',
            'judul'     => '',
            'menu'      => 'kas',
            'submenu'   => 'kas-debet',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'ketua/kas_debit',
            'uraiann'   => $this->kasuraianModel->findAll(),
            'kas'       => $this->kasModel->getAllKasbyStatusDebet(),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        
        return view('layout/tamplate-admin',$data);
    }

    public function kasCredit()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Kas Koperasi',
            'judul'     => '',
            'menu'      => 'kas',
            'submenu'   => 'kas-kredit',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'ketua/kas_credit',
            'uraiann'   => $this->kasuraianModel->findAll(),
            'kas'       => $this->kasModel->getAllKasbyStatusKredit(),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        
        return view('layout/tamplate-admin',$data);
    }

    public function cetakInvoiceKasDebet($id_kas)
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $nominalKas = $this->request->getVar('kasdebet');
        $word = terbilang($nominalKas);

        $data = [
            'title'     => 'Kas',
            'menu'      => 'simpanan',
            'submenu'   => 'simpanan',
            'kas'       => $this->kasModel->allDataKas($id_kas),
            'terbilang' => $word,
            'nominalKas'=>$nominalKas,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('kas/cetak-invoice-kas-debet', $data);
    }

    public function cetakInvoiceKasKredit($id_kas)
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $nominalKas = $this->request->getVar('kasdebet');
        $word = terbilang($nominalKas);

        $data = [
            'title'     => 'Kas',
            'menu'      => 'simpanan',
            'submenu'   => 'simpanan',
            'kas'       => $this->kasModel->allDataKas($id_kas),
            'terbilang' => $word,
            'nominalKas'=>$nominalKas,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('kas/cetak-invoice-kas-kredit', $data);
    }

    public function notifikasi()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $allNotifikasi = $this->notifikasiModel->allNotifikasiByLevelKetu();
        // $level = session()->get('level');
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'allnotifikasi' => $allNotifikasi,
            'judul' => 'Notifikasi Ketua',
            'menu' => 'notifikasi',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'ketua/notifikasi',

        ];

        return view('layout/tamplate-admin', $data);
    }

    public function prosesTandaSudahBaca($id_notifikasi)
    {
        $this->notifikasiModel->save([
            'id_notifikasi' => $id_notifikasi,
            'is_read' => 1
        ]);
        session()->setFlashdata('pesan','Notif berhasil diperharui');
        return redirect()->to('ketua/notifikasi');
    }

    public function deleteNotif($id_notifikasi)
    {
        $this->notifikasiModel->delete([
            'id_notifikasi' => $id_notifikasi,
        ]);
        session()->setFlashdata('gagal','Notif berhasil dihapus');
        return redirect()->to('ketua/notifikasi');
    }
}
