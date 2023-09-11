<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PetugasModel;
use App\Models\JenisPinjaman;
use App\Models\JenisSimpanan;
use App\Models\PinjamanModel;
use App\Models\PengajuanModel;
use App\Models\AnggotaModel;
use App\Models\SimpanModel;
use App\Models\AngsuranModel;
use App\Models\SimpanDetailModel;
use App\Models\TariksimpananModel;
use App\Models\KasModel;
use App\Models\NotifikasiModel;
use App\Models\ProfilKopModel;

class Bendahara extends BaseController
{
    protected $petugasModel;
    protected $jenisPinjaman;
    protected $jenisSimpanan;
    protected $pinjamanModel;
    protected $pengajuanModel;
    protected $anggotaModel;
    protected $simpanModel;
    protected $angsuranModel;
    protected $simpanDetailModel;
    protected $tarikSimpananModel;
    protected $kasModel;
    protected $notifikasiModel;
    protected $profilKopM;
   
    public function __construct(){
        $this->petugasModel     = new PetugasModel();
        $this->jenisPinjaman    = new JenisPinjaman();
        $this->jenisSimpanan    = new JenisSimpanan();
        $this->pinjamanModel    = new PinjamanModel();
        $this->pengajuanModel   = new PengajuanModel();
        $this->anggotaModel     = new AnggotaModel();
        $this->angsuranModel    = new AngsuranModel();
        $this->simpanModel      = new SimpanModel();
        $this->simpanDetailModel = new SimpanDetailModel();
        $this->tarikSimpananModel = new TariksimpananModel();
        $this->kasModel         = new KasModel();
        $this->notifikasiModel  = new NotifikasiModel();
        $this->profilKopM = new ProfilKopModel();
    }

    public function index()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Dashboard",
            'judul' => '',
            'menu' => 'dashboard',
            'menu2' => '',
            'submenu' => '',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'index',
            'footer' => 'layout/footer',
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
            'notif' => $notif_count,
            'allNotifikasi' => $this->notifikasiModel->allNotifikasiLimit(),
            'notifikasi' => $notifikasi,
        ];
        return view('layout/tamplate-admin',$data);
    }

    public function daftarPengajuan()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $pengajuan = $this->petugasModel->getAllPengajuan();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pengajuan",
            'judul' => 'Daftar Pengajuan Pinjaman',
            'pengajuan' => $pengajuan,
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'menu' => 'pinjaman',
            'menu2' => '',
            'submenu' => 'pengajuan',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'bendahara/daftar-pengajuan',
            'footer' => 'layout/footer',
        ];

        return view('layout/tamplate-admin', $data);
    }

    public function daftarPinjaman()
    {
        $pinjaman = $this->pinjamanModel->dataPinjamanByIdPinjaman();
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $profilkop = $this->profilKopM->find(1);
        $jenisPinjam = $this->jenisPinjaman->findAll();
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pinjaman",
            'judul'     => 'Data Pinjaman',
            'pinjaman' => $pinjaman,
            'jenisPinjam' => $jenisPinjam,
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'menu'      => 'pinjaman',
            'menu2' => '',
            'submenu'   => 'pinjaman',
            'header'    => 'layout/header',
            'page'      => 'bendahara/daftar-pinjaman',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',

        ];

        return view('layout/tamplate-admin', $data);
    }

    public function detailAngsuran($id_pinjaman)
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pinjaman",
            'judul' => 'Data Pinjaman',
            'angsuran' => $this->angsuranModel->dataAngsuranById($id_pinjaman),
            'pinjaman' => $this->pinjamanModel->find($id_pinjaman),
            // 'angsuran' => $this->pinjamanModel->hitungAngsuranByIdPinjaman($pinjaman),
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'menu' => 'pinjaman',
            'menu2' => '',
            'submenu' => 'pinjaman',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'bendahara/detail-angsuran',
            'footer' => 'layout/footer',


        ];

        return view('layout/tamplate-admin', $data);
    }

     public function setorAngsuran($id_pinjaman)
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pinjaman",
            'judul' => 'Data Transaksi',
            'pinjaman' => $this->pinjamanModel->allDataPinjamanById($id_pinjaman),
            'angsuran' => $this->pinjamanModel->hitungAngsuranSetorByIdPinjaman($id_pinjaman),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'menu' => 'pinjaman',
            'menu2' => '',
            'submenu' => 'pinjaman',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'bendahara/setor-angsuran',
            'footer' => 'layout/footer',

        ];
        return view('layout/tamplate-admin', $data);
    }

    public function prosesSetorAngsuran()
    {
        $id_pinjaman = $this->request->getVar('id_pinjaman');
        $this->angsuranModel->insert([
            'id_angsuran' => 'ASR'.date('YmdHis'),
            'id_pinjaman'=> $id_pinjaman,
            'id_petugas'=> $this->request->getVar('petugas'),
            'tgl_angsuran'  => date('Y-m-d H:i:s'),
            'angsuran_pembayaran'  => $this->request->getVar('jml_byr_angsuran'),
            'ket'  => 'Lunas',

        ]);

        $this->pinjamanModel->save([
            'id_pinjaman'=> $id_pinjaman,
            'status_pinjaman'  => $this->request->getVar('status_pinjaman'),
        ]);

        // notifikasi
        $no_anggota = $this->request->getVar('no_anggota');
        $this->notifikasiModel->insert([
            'id_referensi' => 202308003,
            'judul' => 'Angsuran pinjaman berhasil disetor.',
            'detail' => 'Pinjaman Anda '.$id_pinjaman.' telah berhasil disetor.',
            'no_anggota' => $no_anggota,
            'is_read' => 0,
        ]);

        session()->setFlashdata('pesan','Setoran Pinjaman berhasil ditambah');
        return redirect()->to('bendahara/daftarPinjaman');
    }

    /* 
        public function prosesSubmitLunasSetoran($id_pinjaman)
        // {
        //     $this->pinjamanModel->save([
        //         'id_pinjaman'      => $id_pinjaman,
        //         'status_pinjaman'  => 'Lunas',
        //     ]);

        //     session()->setFlashdata('pesan','Data berhasil disimpan');
        //     return redirect()->to('bendahara/pinjaman');
         }
     */

    public function setorLunas($id_pinjaman)
    {
        $cekAngsuran = $this->angsuranModel->cekAngsuran($id_pinjaman);
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $profilkop = $this->profilKopM->find(1);
        if (empty($cekAngsuran->id_pinjaman)) {
            $data = [
                'profilkop' => $profilkop,
                'title' => $profilkop['nama_kop']." | Pinjaman",
                'judul' => 'Data Transaksi',
                'pinjaman' => $this->pinjamanModel->allDataPinjamanById($id_pinjaman),
                'angsuran' => $this->pinjamanModel->hitungAngsuranSetorByIdPinjaman($id_pinjaman),
                'notif' => $notif_count,
                'notifikasi' => $notifikasi,
                'menu' => 'pinjaman',
                'menu2' => '',
                'submenu' => 'pinjaman',
                'header' => 'layout/header',
                'sidemenu' => 'layout/sidemenu',
                'page' => 'bendahara/setor-lunas',
                'footer' => 'layout/footer',

            ];

            return view('layout/tamplate-admin', $data);
        } else{
            session()->setFlashdata('gagal','Gagal Setor Secara Lunas.');
            return redirect()->to('bendahara/daftarPinjaman');
        }
        if (!empty($cekAngsuran->id_pinjaman)) {
            $data = [
                'profilkop' => $profilkop,
                'title' => $profilkop['nama_kop']." | Pinjaman",
                'judul' => 'Data Transaksi',
                'pinjaman' => $this->pinjamanModel->allDataPinjamanById($id_pinjaman),
                'angsuran' => $this->pinjamanModel->hitungAngsuranSetorByIdPinjaman($id_pinjaman),
                'notif' => $notif_count,
                'notifikasi' => $notifikasi,
                'menu' => 'pinjaman',
                'submenu' => 'pinjaman',
                'header' => 'layout/header',
                'sidemenu' => 'layout/sidemenu',
                'page' => 'bendahara/setor-lunas',
                'footer' => 'layout/footer',


            ];
        }else{
            session()->setFlashdata('gagal','Gagal Setor Secara Lunas.');
            return redirect()->to('bendahara/daftarPinjaman');

        }
        
    }

    public function prosesSetorLunas($id_pinjaman)
    {
        $this->angsuranModel->insert([
            'id_angsuran'   => 'ASR'.date('YmdHis'),
            'id_pinjaman'   => $id_pinjaman,
            'id_petugas'    => $this->request->getVar('petugas'),
            'tgl_angsuran'  => date('Y-m-d'),
            'angsuran_pembayaran'  => $this->request->getVar('jml_byr_angsuran'),
            'ket'           => $this->request->getVar('ket'),

        ]);

        $this->pinjamanModel->save([
            'id_pinjaman'      => $id_pinjaman,
            'status_pinjaman'  => 'Lunas',
        ]);

        // notifikasi
        $no_anggota = $this->request->getVar('no_anggota');
        $this->notifikasiModel->insert([
            'id_referensi' => 202308003,
            'judul' => 'Angsuran pinjaman berhasil disetor.',
            'detail' => 'Angsuran pinjaman Anda telah berhasil disetor.',
            'no_anggota' => $no_anggota,
            'is_read' => 0,
        ]);

        session()->setFlashdata('pesan','Data berhasil disimpan');
        return redirect()->to('bendahara/daftarPinjaman');
    }

    // Data Simpanan
    public function dataSimpanan()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $simpanNonAktif = $this->simpanModel->getSimpananAnggotaNonAktif();
        $simpan = $this->simpanModel->getSimpananAnggota();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            'judul' => 'Data Simpanan Anggota',
            'simpan' => $simpan,
            'simpannon' => $simpanNonAktif,
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'menu' => 'simpanan',
            'menu2' => '',
            'submenu' => 'simpanan',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'bendahara/daftar-simpanan',
            'footer' => 'layout/footer',
        ];

        return view('layout/tamplate-admin', $data);
    }
    public function simpananPokok()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $simpan = $this->simpanModel->getSimpananAnggota();
        $jnsSimpan = $this->jenisSimpanan->findAll();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            'judul' => 'Simpanan Pokok',
            'simpan' => $simpan,
            'jnsSimpan' => $jnsSimpan,
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'menu' => 'simpanan',
            'menu2' => 'reksimp',
            'submenu' => 'pokok',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'bendahara/daftar-simpanan-pokok',
            'footer' => 'layout/footer',
        ];

        return view('layout/tamplate-admin', $data);
    }
 
    public function simpananWajib()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $simpan = $this->simpanModel->getSimpananAnggota();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            'judul' => 'Simpanan Wajib',
            'simpan' => $simpan,
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'menu' => 'simpanan',
            'menu2' => 'reksimp',
            'submenu' => 'wajib',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'bendahara/daftar-simpanan-wajib',
            'footer' => 'layout/footer',
        ];

        return view('layout/tamplate-admin', $data);
    }
 
    public function simpananSS()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $simpan = $this->simpanModel->getSimpananAnggota();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            'judul' => 'Simpanan Sukarela',
            'simpan' => $simpan,
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'menu' => 'simpanan',
            'menu2' => 'reksimp',
            'submenu' => 'sukarela',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'bendahara/daftar-simpanan-ss',
            'footer' => 'layout/footer',
        ];

        return view('layout/tamplate-admin', $data);
    }
 
    public function setorAllSimpWajib()
     {
        /*
            $idSimpanan     = $this->request->getVar('idSimpanan');
            $no_anggota     = $this->request->getVar('noAnggota');

            $jmldata = is_countable($no_anggota);
            for ($i=0; $i < $jmldata ; $i++) { 
                $simpanWajib = $this->simpanModel->simpAllWajib($no_anggota);
            }     
        */
        $simpanWajib = $this->simpanModel->getSimpananAnggota();
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            'judul' => 'Setor Simpanan Wajib Semua Anggota',
            'simpWajib' => $simpanWajib,
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'jumlah_setor' => $this->simpanModel->getSimpananWajib(),
            'menu' => 'simpanan',
            'menu2' => '',
            'submenu' => 'simpanan',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'bendahara/daftar-setor-wajib',
            'footer' => 'layout/footer',
        ];
        return view('layout/tamplate-admin', $data);
     }
/**/

    public function prosesSetorAllWajib()
    {
        if ($this->request->isAJAX()) {
            $id_simpanan = $this->request->getVar('id_simpanan');
            $no_anggota = $this->request->getVar('no_anggota');
            $id_jenis_simpanan = $this->request->getVar('id_jenis_simpanan');
            $jumlah_setor = $this->request->getVar('jumlah_setor');
            $jumlah_simpanan_wajib = $this->request->getVar('jumlah_simpanan_wajib');

            $sts_setor = $this->request->getVar('status_setor');
            $status = $this->request->getVar('debet');
            $judul = $this->request->getVar('judul');
            $detail = $this->request->getVar('detail');
            // $isread = 0;

            // $simpananAnggota = $this->simpanModel->getSimpananAnggotaByNoanggota($id_simpanan);

            $jmlData = count($id_simpanan);

            for ($i=0; $i < $jmlData; $i++) { 
                $this->simpanDetailModel->insert([
                    'id_simpanan'   => $id_simpanan[$i],
                    'no_anggota'    => $no_anggota[$i],
                    'id_jenis_simpanan' => $id_jenis_simpanan[$i],
                    'debet'  => $jumlah_setor[$i],
                    'sts_setor'  => $sts_setor[$i],
                    'status'  => $status[$i],
                ]);

                $totalSW = $jumlah_simpanan_wajib[$i] + $jumlah_setor[$i];

                $this->simpanModel->save([
                    'id_simpanan'   => $id_simpanan[$i],
                    'simpanan_wajib'    => $totalSW,
                ]);

                // notifikasi
                $this->notifikasiModel->insert([
                    'id_referensi' => 202308008,
                    'judul' => $judul[$i],
                    'detail' => $detail[$i],
                    'no_anggota' => $no_anggota[$i],
                    // 'is_read' => $isread[$i],
                ]);

            }
            $msg = [
                'sukses' => "Setoran Simpanan Wajib telah berhasil ditambah!"
            ];

            echo json_encode($msg);

          }
      } 
    
    public function createSW($id_simpanan)
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $simpan = $this->simpanModel->findAll();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            'judul' => 'Setor Simpanan Wajib',
            'menu' => 'simpanan',
            'menu2' => '',
            'submenu' => 'simpanan',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'bendahara/simpanan-wajib',
            'footer' => 'layout/footer',
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'data_setoran' => $this->simpanModel->getSimpananById($id_simpanan),
            'simpan_wajib' => $this->simpanModel->getSimpananWajib(),
            'histori_setoran' => $this->simpanModel->historySetorSimpananWajib($id_simpanan),
            'validation' => \Config\Services::validation(),
        ];

        return view('layout/tamplate-admin', $data);
    }
/*
    public function prosesSetoranWajib()
    { //Aksi tambah setoran wajib
        $jumlah_setor = $this->request->getVar('jumlah_setor');
        $id_simpanan = $this->request->getVar('id_simpanan');

        $simpananAnggota = $this->simpanModel->getSimpananAnggotaByNoanggota($id_simpanan);

        if ($simpananAnggota->status_anggota == "Aktif") {
            $this->simpanDetailModel->insert([
                'id_simpanan' => $this->request->getVar('id_simpanan'),
                'jumlah_setor' => $jumlah_setor,
                'no_anggota' => $this->request->getVar('no_anggota'),
                'jenis_simpanan' => $this->request->getVar('jenis_simpanan')
            ]);

            // $this->simpanModel->tambahSetoranSimpananWajib($data);
            $qry = "UPDATE simpanan SET simpanan_wajib  = simpanan_wajib + ' $jumlah_setor' WHERE id_simpanan = '$id_simpanan'";

            $db     = \Config\Database::connect();
            $db->query($qry);
            session()->setFlashdata('pesan', 'Setoran Simpanan Wajib telah berhasil ditambah!');
            return redirect()->to('bendahara/dataSimpanan');

            // notifikasi
            $no_anggota = $this->request->getVar('no_anggota');
            $this->notifikasiModel->insert([
                'judul' => 'Setoran Simpanan Wajib.',
                'detail' => 'Simpanan Wajib Anda telah berhasil disetor.',
                'no_anggota' => $no_anggota,
                'is_read' => 0,
            ]);

        }else{
            session()->setFlashdata('gagal', 'Anggota tidak dapat melakukan transaksi setor wajib! Status anggota sudah <b>dinonaktifkan</b>');
            return redirect()->to('bendahara/createSW/'.$id_simpanan);
        }
        
    }
*/
    public function createSK($id_simpanan)
    { //   Form Setoran Sukarela
        // session();
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $simpan = $this->simpanModel->findAll();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            'judul' => 'Setor Simpanan Sukarela',
            'menu' => 'simpanan',
            'menu2' => '',
            'submenu' => 'simpanan',
            'page' => 'bendahara/simpanan-sukarela',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'footer' => 'layout/footer',
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'data_setoran' => $this->simpanModel->getSimpananById($id_simpanan),
            'simpanSukarela' => $this->simpanModel->getSimpananSukarela(),
            'histori_setoran' => $this->simpanModel->historySetorSimpananSukarela($id_simpanan),
            'jumlah_setor' => $this->simpanModel->jmlSimpanWajib(),
            'validation' => \Config\Services::validation(),
        ];

        return view('layout/tamplate-admin', $data);
    }

    public function prosesSetoranSukarela()
    { //Aksi tambah setoran Sukarela
        $jumlah_setor = $this->request->getVar('jumlah_setor');
        $id_simpanan = $this->request->getVar('id_simpanan');
        $no_anggota = $this->request->getVar('no_anggota');
        $sts_setor = $this->request->getVar('status_setor');

        $simpananAnggota = $this->simpanModel->getSimpananAnggotaByNoanggota($id_simpanan);

        if ($simpananAnggota->status_anggota == "Aktif") {
            $this->simpanDetailModel->insert([
                'id_simpanan' => $this->request->getVar('id_simpanan'),
                'debet' => $jumlah_setor,
                'no_anggota' => $no_anggota,
                'id_jenis_simpanan' => $this->request->getVar('jenis_simpanan'),
                'sts_setor' => $sts_setor,
                'status' => 'Debet',
            ]);

            // $this->simpanModel->tambahSetoranSimpananWajib($data);
            $qry = "UPDATE simpanan SET simpanan_sukarela  = simpanan_sukarela + ' $jumlah_setor' WHERE id_simpanan = '$id_simpanan'";

            $db     = \Config\Database::connect();
            $db->query($qry);

            // notifikasi
            $this->notifikasiModel->insert([
                'id_referensi' => 202308008,
                'judul' => 'Setoran Simpanan Sukarela.',
                'detail' => 'Transaksi Simpanan Sukarela Anda telah berhasil disetor.',
                'no_anggota' => $no_anggota,
            ]);
            session()->setFlashdata('pesan', 'Setoran Simpanan Sukarela telah berhasil ditambah!');
            return redirect()->to('bendahara/createSK/'.$id_simpanan);
        }else{
            session()->setFlashdata('gagal', 'Anggota tidak dapat melakukan transaksi setor Sukarela! Status anggota sudah <b>dinonaktifkan</b>');
            return redirect()->to('bendahara/createSK/'.$id_simpanan);
        }
        
    }

    public function ubahStatusSmp($id_simpanan)
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        // $status = $this->anggotaModel->find(session('no_anggota'));
        $simpan = $this->simpanModel->getSimpananAnggotaById($id_simpanan);
        $simpananAnggota = $this->simpanModel->getSimpananAnggotaByNoanggota($id_simpanan);
        $profilkop = $this->profilKopM->find(1);

        if ($simpananAnggota->status_anggota != "Aktif") {
            $data = [
                'profilkop' => $profilkop,
                'title' => $profilkop['nama_kop']." | Simpanan",
                'judul' => 'Ubah Status Simpanan',
                'simpan' => $simpan,
                'simpanan' => $this->simpanModel->find($id_simpanan),
                'notif' => $notif_count,
                'notifikasi' => $notifikasi,                
                'menu' => 'simpanan',
                'menu2' => '',
                'submenu' => 'simpanan',
                'page' => 'bendahara/ubah-status-simpanan',
                'header' => 'layout/header',
                'sidemenu' => 'layout/sidemenu',
                'footer' => 'layout/footer',
            ];
            return view('layout/tamplate-admin', $data);
        }else{
            session()->setFlashdata('gagal', 'Status simpanan tidak dapat diakses bila status Anggota masih Aktif');
            return redirect()->to('bendahara/dataSimpanan');
        }
    }

    public function prosesUbahStsSimp($id_simpanan)
    {
        $simpan_pokok   = $this->request->getVar('simpanan_pokok');
        $simpan_wajib   = $this->request->getVar('simpanan_wajib');
        $simpan_sukarela= $this->request->getVar('simpanan_sukarela');
        $status_simpanan   = $this->request->getVar('status_simpanan');
        $totalPenarikan = $this->request->getVar('total_simpanan');

        $simpananAnggota = $this->simpanModel->getSimpananAnggotaByNoanggota($id_simpanan);

        if ($simpananAnggota->status_anggota != "Aktif") {
            $this->tarikSimpananModel->insert([
                'id_simpanan' => $id_simpanan,
                'nominal_penarikan' => $totalPenarikan,
                'ket' => 'Simpanan Pokok, Simpanan Wajib, Simpanan Sukarela sudah ditarik total, anggota mengundurkan diri dari Koperasi',
            ]);
            
            $this->simpanModel
            ->where("id_simpanan", $id_simpanan)
            ->set('simpanan_pokok', 'simpanan_pokok - $simpan_pokok')
            ->set('simpanan_wajib', 'simpanan_wajib - $simpan_wajib')
            ->set('simpanan_sukarela', 'simpanan_sukarela - $simpan_sukarela')
            ->set('status_simpanan', $status_simpanan)
            ->update();

            // notifikasi
            $no_anggota = $this->request->getVar('no_anggota');
            $this->notifikasiModel->insert([
                'id_referensi' => 202308008,
                'judul' => 'Status Simpanan Anda berhasil diubah.',
                'detail' => 'Simpanan Pokok, Simpanan Wajib, Simpanan Sukarela sudah ditarik total, Anda telah mengundurkan diri dari Koperasi.',
                'no_anggota' => $no_anggota,
            ]);
           
            session()->setFlashdata('pesan', 'Simpanan Pokok, Simpanan Wajib, dan Simpanan Sukarela berhasil ditarik dan Status Simpanan berhasil diubah!');
            return redirect()->to('bendahara/dataSimpanan');
        }else{
            session()->setFlashdata('gagal', 'Status simpanan tidak dapat diakses bila status Anggota masih Aktif');
            return redirect()->to('bendahara/dataSimpanan');
        }
    }

// Penarikan Simpanan
    public function penarikan()
    { //--Penarikan
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Penarikan Simpanan",
            'judul' => 'Data Penarikan Simpanan Sukarela Anggota',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'page' => 'bendahara/daftar-penarikan-simpanan',
            'footer' => 'layout/footer',
            'menu' => 'simpanan',
            'menu2' => '',
            'submenu' => 'penarikan',
            'dataPenarikan' => $this->simpanModel->dataSimpananPenarikan(),
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
        ];

        return view('layout/tamplate-admin', $data);
    }

    public function tarikSimpananAnggota($id_simpanan)
    { //   Form Penarikan Simpanan Anggota
        // session();
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $simpan = $this->simpanModel->findAll();

        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Penarikan Simpanan",
            'judul' => 'Data Simpanan Sukarela Anggota',
            'menu' => 'simpanan',
            'menu2' => '',
            'submenu' => 'penarikan',
            'page' => 'bendahara/penarikan-simpanan-anggota',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'footer' => 'layout/footer',
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'simpanSukarela' => $this->simpanModel->getSimpananSukarela(),
            'data_setoran' => $this->simpanModel->getSimpananById($id_simpanan),
            'histori_penarikan' => $this->simpanModel->historyPenarikan($id_simpanan),
            'jumlah_setor' => $this->simpanModel->jmlSimpanWajib(),
            'validation' => \Config\Services::validation(),
        ];

        return view('layout/tamplate-admin', $data);
    }

    public function prosesPenarikanSimpanan($id_simpanan)
    { //Aksi Penarikan Simpanan Anggota
        $jumlah_tarik = $this->request->getVar('jumlah_tarikSimpanan');
        $id_simpanan = $this->request->getVar('id_simpanan');
        $simpanan = $this->simpanModel->find($id_simpanan);
        $no_anggota = $this->request->getVar('no_anggota');
        $cekStsAnggota = $this->anggotaModel->find($no_anggota);

        if (!empty($cekStsAnggota->status_anggota) && empty($simpanan['simpanan_sukarela'])) {
            if ($cekStsAnggota['status_anggota'] != "Aktif" && $simpanan['simpanan_sukarela'] >= $jumlah_tarik) {
                $this->simpanDetailModel->insert([
                    'id_simpanan' => $id_simpanan,
                    'kredit' => $jumlah_tarik,
                    'no_anggota' => $no_anggota,
                    'id_jenis_simpanan' => $this->request->getVar('jenis_simpanan'),
                    'sts_setor' => 'Manual',
                    'status' => 'Kredit',
                ]);

                // $this->tarikSimpananModel->insert([
                //     'id_simpanan' => $id_simpanan,
                //     'nominal_penarikan' => $jumlah_tarik,
                //     'ket' => '',
                // ]);

                $qry = "UPDATE simpanan SET simpanan_sukarela  = simpanan_sukarela - ' $jumlah_tarik' WHERE id_simpanan = '$id_simpanan'";
                
                $db     = \Config\Database::connect();
                $db->query($qry);

                // notifikasi
                $this->notifikasiModel->insert([
                    'id_referensi' => 202308008,
                    'judul' => 'Penarikan Simpanan Sukarela.',
                    'detail' => 'Transaksi Penarikan Simpanan Sukarela anda berhasil ditarik .',
                    'no_anggota' => $no_anggota,
                ]);
                session()->setFlashdata('pesan', 'Penarikan Simpanan berhasil ditarik!');
                return redirect()->to('bendahara/tarikSimpananAnggota/'.$id_simpanan);
                
            }else{
                session()->setFlashdata('gagal', 'Simpanan tidak bisa ditarik atau Simpanan tidak cukup');
                return redirect()->to('bendahara/tarikSimpananAnggota/'.$id_simpanan);

            }
        } else {
            if ($cekStsAnggota['status_anggota'] == "Aktif" && $simpanan['simpanan_sukarela'] >= $jumlah_tarik) {
                $this->simpanDetailModel->insert([
                    'id_simpanan' => $id_simpanan,
                    'kredit' => $jumlah_tarik,
                    'no_anggota' => $no_anggota,
                    'id_jenis_simpanan' => $this->request->getVar('jenis_simpanan'),
                    'sts_setor' => 'Manual',
                    'status' => 'Kredit',
                ]);
                // $this->tarikSimpananModel->insert([
                //     'id_simpanan' => $id_simpanan,
                //     'nominal_penarikan' => $jumlah_tarik,
                //     'ket' => '',
                // ]);

                $qry = "UPDATE simpanan SET simpanan_sukarela  = simpanan_sukarela - ' $jumlah_tarik' WHERE id_simpanan = '$id_simpanan'";
                
                $db     = \Config\Database::connect();
                $db->query($qry);

                // notifikasi
                $this->notifikasiModel->insert([
                    'judul' => 'Penarikan Simpanan Sukarela.',
                    'detail' => 'Simpanan Sukarela anda berhasil ditarik.',
                    'no_anggota' => $no_anggota,
                ]);

                session()->setFlashdata('pesan', 'Penarikan Simpanan berhasil ditarik!');
                return redirect()->to('bendahara/tarikSimpananAnggota/'.$id_simpanan);
            } else {
                session()->setFlashdata('gagal', 'Gagal menarik simpanan, simpanan anggota tidak cukup atau status anggota sudah tidak Aktif');
                return redirect()->to('bendahara/tarikSimpananAnggota/'.$id_simpanan);
            }
        }
    }
    
    public function cetakPinjamanAnggota($id_pinjaman)
    {
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pinjaman",
            'judul' => 'Data Pinjaman',
            'pengajuan' => $this->pengajuanModel->dataPengajuanByIdPinjaman($id_pinjaman),
            'status' => $this->angsuranModel->dataStsPinjamByIdPinjaman($id_pinjaman),
            'angsuran' => $this->angsuranModel->dataAngsuranByIdPinjaman($id_pinjaman),
            'menu' => 'pinjaman',
            'menu2' => '',
            'submenu' => 'pinjaman',
            'page' => 'bendahara/laporan/cetak-pjm-anggota',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'footer' => 'layout/footer',
        ];
        return view('layout-cetak/tamplate', $data);
    }

    public function cetakInvoiceAngsuran($id_angsuran)
    {
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pinjaman",
            'angsuran' => $this->angsuranModel->allDataAngsuran($id_angsuran),
            'page' => 'bendahara/laporan/cetak-invoice-pinjaman',
            'menu' => 'pinjaman',
            'menu2' => '',
            'submenu' => 'pinjaman',
        ];
        return view('layout-cetak/tamplate', $data);
    }

    public function cetakAllSimpanByAnggota($no_anggota)
    {
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            'judul' => 'Data Simpanan',
            'simpanan' => $this->simpanModel->getSimpananByAnggota($no_anggota),
            'menu' => 'simpanan',
            'menu2' => '',
            'submenu' => 'simpanan',
            'page' => 'bendahara/laporan/lap-simpan-anggota',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'footer' => 'layout/footer',
        ];
        return view('layout-cetak/tamplate', $data);
    }

    public function cetakInvoiceSimpanan($id_simpan_detail)//wajib & sukarela
    {
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            'simpanan' => $this->simpanModel->allDataSimpanan($id_simpan_detail),
            'page' => 'bendahara/laporan/cetak-invoice-simpanan',
            'menu2' => '',
            'menu' => 'simpanan',
            'submenu' => 'simpanan',

        ];
        return view('layout-cetak/tamplate', $data);
    }

    public function cetakInvoicePenarikan($id_penarikan)
    {
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            // 'penarikan' => $this->tarikSimpananModel->allDataPenarikan($id_penarikan),
            'penarikan' => $this->simpanDetailModel->allDataPenarikan($id_penarikan),
            'menu2' => '',
            'menu' => 'simpanan',

        ];
        return view('bendahara/laporan/cetak-invoice-penarikan', $data);
    }
    public function notifikasi()
    {
        // $level = session()->get('level');
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelBen();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelBen();
        $allNotifikasi = $this->notifikasiModel->allNotifikasiByLevelBen();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Notifikasi",
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'allnotifikasi' => $allNotifikasi,
            'judul' => 'Notifikasi Bendahara',
            'menu' => 'notifikasi',
            'menu2' => '',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'bendahara/notifikasi',

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
        return redirect()->to('bendahara/notifikasi');
    }

    public function deleteNotif($id_notifikasi)
    {
        $this->notifikasiModel->delete([
            'id_notifikasi' => $id_notifikasi,
        ]);
        session()->setFlashdata('gagal','Notif berhasil dihapus');
        return redirect()->to('bendahara/notifikasi');
    }
}
