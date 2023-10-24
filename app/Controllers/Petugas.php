<?php

namespace App\Controllers;

use App\Models\PetugasModel;
use App\Models\AnggotaModel;
use App\Models\PengajuanModel;
use App\Models\PinjamanModel;
use App\Models\JenisPinjaman;
use App\Models\SimpanModel;
use App\Models\TariksimpananModel;
use App\Models\AngsuranModel;
use App\Models\KasModel;
use App\Models\NotifikasiModel;
use App\Models\ProfilKopModel;

use CodeIgniter\I18n\Time;

class Petugas extends BaseController
{
    protected $petugasModel;
    protected $pengajuanModel;
    protected $pinjamanModel;
    protected $jenisPinjaman;
    protected $simpanModel;
    protected $tarikSimpananModel;
    protected $angsuranModel;
    protected $kasModel;
    protected $notifikasiModel;
    protected $profilKopM;
   
    public function __construct(){
        $this->petugasModel     = new PetugasModel();
        $this->pengajuanModel   = new PengajuanModel();
        $this->anggotaModel     = new AnggotaModel();
        $this->jenisPinjaman    = new JenisPinjaman();
        $this->pinjamanModel    = new PinjamanModel();
        $this->simpanModel      = new SimpanModel();
        $this->tarikSimpananModel= new TariksimpananModel();
        $this->angsuranModel    = new AngsuranModel();
        $this->kasModel         = new KasModel();
        $this->notifikasiModel    = new NotifikasiModel();
        $this->profilKopM = new ProfilKopModel();
     }

    public function cetakPengajuanAngg($id_pengajuan)
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul'     => '',
            'menu'      => '',
            'pengajuan' => $this->pengajuanModel->dataPengajuanByIdPengajuan($id_pengajuan),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'submenu'   => '',
            'menu2' => '',
            'page'      => 'laporan/cetak-pgj-anggota',
        ];
        return view('layout-cetak/tamplate',$data);
    }

// Profil Petugas
    public function profile()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $petugas = session()->get('id_petugas');
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul'     => 'Profile Petugas',
            'menu'      => '',
            'menu2' => '',
            'submenu'   => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'petugas/profil',
            'petugas' => $this->petugasModel->dataPetugasById($petugas),
            'validation' => \Config\Services::validation(),  
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,];
        return view('layout/tamplate-admin',$data);
    }

    public function prosesGantiPassword($id_petugas)
    {
        $passBaru = $this->request->getVar('passwordBaru');
        $passUlang = $this->request->getVar('ulangPass');
        if (!$this->validate([
            'passwordBaru' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Wajib di Isi!',
                ]
            ],
            'ulangPass' => [
                'rules' => 'required|matches[passwordBaru]',
                'errors' => [
                    'required' => 'Password Wajib di Isi!',
                    'matches' => 'Password tidak cocok!',
                ]
            ],

        ])) {
        
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to('/petugas/profile/')->withInput();
        }

        // $id = $this->input->post('id');
        $data = $this->petugasModel->save([
            'id_petugas' => $id_petugas,
            'password' => htmlspecialchars(md5($passBaru)),
        ]);
        session()->setFlashdata('pesan','Password berhasil diubah');
        return redirect()->to('/petugas/profile');
    }

// Laporan Pengajuan
    public function laporanPengajuan()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul'     => 'laporan Pengajuan',
            'menu'      => 'lapSimpanan',
            'menu2'     => '',
            'submenu'   => 'laporanPengajuan',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'laporan/laporan-pengajuan',
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout/tamplate-admin',$data);
    }

    public function laporanPengajuanHarian()
    {
        $tgl = $this->request->getVar('tanggal');
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul'     => 'Laporan Pengajuan Harian',
            'menu'      => 'pengajuan',
            'menu2' => '',
            'submenu'   => 'laporanPengajuan',
            'page'      => 'laporan/lap-pengajuan',
            'harian'    => $this->pengajuanModel->lapPengajuanHarian($tgl,$bln,$thn),
            'tgl'       => $tgl.'-'.$bln.'-'.$thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate',$data);
    }

    public function laporanPengajuanBulanan()
    {
        $bln    = $this->request->getVar('bulan');
        $thn    = $this->request->getVar('tahun');
        $tanggal = $thn.'-'.$bln;
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul' => 'Laporan Pengajuan Bulanan',
            'menu'  => 'pengajuan',
            'menu2' => '',
            'submenu'=> 'laporanPengajuan',
            'page'  => 'laporan/lap-pengajuan',
            'harian'=> $this->pengajuanModel->lapPengajuanBulanan($bln,$thn),
            'bulan' => $bln.'-'.$thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate',$data);
    }

    public function laporanPengajuanTahunan()
    {
        $thn = $this->request->getVar('tahun');
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul'     => 'Laporan Pengajuan Tahunan',
            'menu'      => 'pengajuan',
            'menu2' => '',
            'submenu'   => 'laporanPengajuan',
            'page'      => 'laporan/lap-pengajuan',
            'harian'    => $this->pengajuanModel->lapPengajuanTahunan($thn),
            'tahun'     => $thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate',$data);
    }

// Laporan Anggota
    public function laporanAnggota()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul'     => 'Laporan Anggota',
            'menu'      => 'lapSimpanan',
            'menu2' => '',
            'submenu'   => 'lapAnggota',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'laporan/laporan-anggota',
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout/tamplate-admin',$data);
    }

    public function laporanAnggotaStatus()
    {
        $sts = $this->request->getVar('status');
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul'     => 'Data Anggota',
            'menu'      => 'pengajuan',
            'menu2' => '',
            'submenu'   => 'laporanPengajuan',
            'page'      => 'laporan/lap-anggota-status',
            'harian'    => $this->anggotaModel->lapAnggotaBySts($sts),
            'status'    => $sts,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate-table-lc',$data);
    }   

    public function laporanAllAnggota()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title'     => $profilkop['nama_kop'],
            'harian'    => $this->anggotaModel->findAll(),
            'judul'     => 'Data Anggota',
            'menu'      => 'pengajuan',
            'menu2' => '',
            'submenu'   => 'laporanPengajuan',
            'page'      => 'laporan/lap-all-anggota',
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate-table-lc',$data);
    }

// Laporan Pinjaman
    public function laporanPinjaman()
    {        
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $pinjaman = $this->pinjamanModel->dataPinjamanByIdPinjaman();
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul'     => 'Laporan Pinjaman',
            'menu'      => 'lapSimpanan',
            'menu2' => '',
            'submenu'   => 'lapPinjaman',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'page'      => 'laporan/laporan-pinjaman',
            'footer'    => 'layout/footer',
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'pinjaman' => $pinjaman,
        ];
        return view('layout/tamplate-admin',$data);
    }

    public function laporanPinjamanHarian()
    {
        $tgl = $this->request->getVar('tanggal');
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul'     => 'Laporan Pengajuan Harian',
            'menu'      => 'pengajuan',
            'menu2' => '',
            'submenu'   => 'laporanPengajuan',
            'page'      => 'laporan/lap-pinjaman',
            'harian'    => $this->pinjamanModel->lapPinjamanHarian($tgl,$bln,$thn),
            'tanggal'       => $tgl.'-'.$bln.'-'.$thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate-table-lc',$data);
    }

    public function laporanPinjamanBulanan()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $tanggal = $thn.'-'.$bln;
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul' => 'Laporan Pinjaman Bulanan',
            'menu'  => 'pengajuan',
            'menu2' => '',
            'submenu'=> 'laporanPengajuan',
            'page'  => 'laporan/lap-pinjaman',
            'harian'=> $this->pinjamanModel->lapPinjamanBulanan($bln,$thn),
            'bulan'   => $bln.'-'.$thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate-table-lc',$data);
    }

    public function laporanPinjamanTahunan()
    {
        $thn = $this->request->getVar('tahun');
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul'  => 'Laporan Pinjaman Tahunan',
            'menu'   => 'pengajuan',
            'menu2' => '',
            'submenu'=> 'laporanPengajuan',
            'page'   => 'laporan/lap-pinjaman',
            'harian' => $this->pinjamanModel->lapPinjamanTahunan($thn),
            'tahun'  => $thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate-table-lc',$data);
    }

// filter Pinjaman 
    public function viewLapBulanPinjaman()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $jns = $this->request->getVar('jns');
        $data = [
            'pinjaman' =>$this->pinjamanModel->lapPinjamBulanan($bln,$thn,$jns),
            // 'simpan' =>$this->simpanModel->lapSimpanan($bln,$thn,$jns),
            'bulan' => $bln .'-'. $thn,
            'jenis' =>$this->jenisPinjaman->find($jns),
            'page' => 'bendahara/laporan/v_lap_pinjaman',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

    public function viewLapTahunPinjaman()
    {
        // $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $jns = $this->request->getVar('jns');
        $data = [
            'pinjaman' =>$this->pinjamanModel->lapPinjamTahunan($thn,$jns),
            // 'simpan' =>$this->simpanModel->lapSimpanan($bln,$thn,$jns),
            'tahun' => $thn,
            'jenis' =>$this->jenisPinjaman->find($jns),
            'page' => 'bendahara/laporan/v_lap_pinjaman',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

// filter Simpan Pokok/Wajib/Sukarela
    public function viewLapBulanPokok()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        // $jns = $this->request->getVar('jns');
        $data = [
            'simpan' =>$this->simpanModel->lapSimpananBulanan($bln,$thn),
            // 'simpan' =>$this->simpanModel->lapSimpanan($bln,$thn,$jns),
            'bulan' => $bln .'-'. $thn,
            // 'jenis' => $jns,
            'page' => 'bendahara/laporan/v_lap_sim_pokok',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

    public function viewLapTahunPokok()
    {
        // $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $data = [
            'simpan' =>$this->simpanModel->lapSimpananTahunan($thn),
            // 'bulan' => $bln,
            'tahun' => $thn,
            'page' => 'bendahara/laporan/v_lap_sim_pokok',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

    public function viewLapBulanWajib()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $data = [
            'simpan' =>$this->simpanModel->lapSimpananBulanan($bln,$thn),
            'bulan' => $bln .'-'. $thn,
            'page' => 'bendahara/laporan/v_lap_sim_wajib',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

    public function viewLapTahunWajib()
    {
        // $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $data = [
            'simpan' =>$this->simpanModel->lapSimpananTahunan($thn),
            // 'bulan' => $bln,
            'tahun' => $thn,
            'page' => 'bendahara/laporan/v_lap_sim_wajib',
            'title'=> '',    ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

    public function viewLapBulanSk()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $data = [
            'simpan' =>$this->simpanModel->lapSimpananBulanan($bln,$thn),
            'bulan' => $bln .'-'. $thn,
            'page' => 'bendahara/laporan/v_lap_sim_wajib',
            'title'=> '',    ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

    public function viewLapTahunSk()
    {
        // $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $data = [
            'simpan' =>$this->simpanModel->lapSimpananTahunan($thn),
            // 'bulan' => $bln,
            'tahun' => $thn,
            'page' => 'bendahara/laporan/v_lap_sim_sk',
            'title'=> '',    ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

// Laporan Simpanan
    public function laporanSimpanan()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul' => 'Laporan Simpanan',
            'menu'  => 'lapSimpanan',
            'menu2' => '',
            'submenu' => 'lapSimpanan',
            'page'  => 'laporan/laporan-simpanan',
            'header'=> 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'footer'=> 'layout/footer',
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout/tamplate-admin',$data);
    }


    public function laporanSimpananHarian()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $tgl = $this->request->getVar('tanggal');
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul' => 'Laporan Simpanan Harian',
            'page'  => 'laporan/lap-simpanan',
            'harian'=> $this->simpanModel->lapSimpananHarian($tgl,$bln,$thn),
            'tanggal'=> $tgl.'-'.$bln.'-'.$thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate',$data);
    }

    public function laporanSimpananBulanan()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $tanggal = $thn.'-'.$bln;
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul'  => 'Laporan Simpanan Bulanan',
            'page'   => 'laporan/lap-simpanan',
            'harian' => $this->simpanModel->lapSimpananBulanan($bln,$thn),
            'bulan'  => $bln.'-'.$thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate',$data);
    }

    public function laporanSimpananTahunan()
    {
        $thn = $this->request->getVar('tahun');
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul' => 'Laporan Simpanan Tahunan',
            'page'  => 'laporan/lap-simpanan',
            'harian' => $this->simpanModel->lapSimpananTahunan($thn),
            'tahun' => $thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate',$data);
    }

// Laporan Penarikan
    public function laporanPenarikan()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul' => 'Laporan Penarikan',
            'menu' => 'lapSimpanan',
            'menu2' => '',
            'submenu' => 'lapPenarikan',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'footer' => 'layout/footer',
            'page' => 'laporan/laporan-penarikan',
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,

        ];
        return view('layout/tamplate-admin',$data);
    }

    public function laporanPenarikanHarian()
    {
        $tgl = $this->request->getVar('tanggal');
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'harian' => $this->tarikSimpananModel->lapPenarikanHarian($tgl,$bln,$thn),
            'judul' => 'Laporan Penarikan Harian',
            'menu' => 'pengajuan',
            'menu2' => '',
            'submenu' => 'laporanPengajuan',
            'page' => 'laporan/lap-penarikan',
            'tanggal' => $tgl.'-'.$bln.'-'.$thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate',$data);
    }

    public function laporanPenarikanBulanan()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $tanggal = $thn.'-'.$bln;
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'harian' => $this->tarikSimpananModel->lapPenarikanBulanan($bln,$thn),
            'judul' => 'Laporan Penarikan Bulanan',
            'menu' => 'pengajuan',
            'menu2' => '',
            'submenu' => 'laporanPengajuan',
            'page' => 'laporan/lap-penarikan',
            'bulan' => $bln.'-'.$thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate',$data);
    }

    public function laporanPenarikanTahunan()
    {
        $thn = $this->request->getVar('tahun');
        // $tanggal = $thn.'-'.$bln.'-'.$tgl;
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'harian' => $this->tarikSimpananModel->lapPenarikanTahunan($thn),
            'tahun' => $thn,
            'judul' => 'Laporan Penarikan Tahunan',
            'menu' => 'pengajuan',
            'menu2' => '',
            'submenu' => 'laporanPengajuan',
            'page' => 'laporan/lap-penarikan',
            // 'tgl' => $tgl.'-'.$bln.'-'.$thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate',$data);
    }


    public function viewLapBulanKasDebet()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $data = [
            'kas' =>$this->kasModel->lapKasBulananDebet($bln,$thn),
            'bulan' => $bln .'-'. $thn,
            'page' => 'kas/laporan/v_lap_kas_debet',
            'judul'=> 'Kas Debet Bulanan',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

    public function viewLapTahunKasDebet()
    {
        // $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $data = [
            'kas' =>$this->kasModel->lapKasTahunanDebet($thn),
            // 'bulan' => $bln,
            'tahun' => $thn,
            'page' => 'kas/laporan/v_lap_kas_debet',
            'judul'=> 'Kas Debet Tahunan',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

    public function viewLapBulanKasKredit()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $data = [
            'kas' =>$this->kasModel->lapKasBulananKredit($bln,$thn),
            'bulan' => $bln .'-'. $thn,
            'page' => 'kas/laporan/v_lap_kas_kredit',
            'judul'=> 'Kas Kredit Bulanan',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

    public function viewLapTahunKasKredit()
    {
        // $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $data = [
            'kas' =>$this->kasModel->lapKasTahunanKredit($thn),
            // 'bulan' => $bln,
            'tahun' => $thn,
            'page' => 'kas/laporan/v_lap_kas_kredit',
            'judul'=> 'Kas Kredit Tahunan',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

// filter Kas 
    public function viewLapBulanKas()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        // $jns = $this->request->getVar('jns');
        $data = [
            'kas' =>$this->kasModel->lapKasBulanan($bln,$thn),
            // 'simpan' =>$this->simpanModel->lapSimpanan($bln,$thn,$jns),
            'bulan' => $bln .'-'. $thn,
            'judul' => 'Laporan Kas Bulanan',
            // 'jenis' =>$this->jenisKasan->find($jns),
            'page' => 'kas/laporan/v_lap_kas',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate-lc-kas', $data),
        ];
        echo json_encode($response);
    }

    public function viewLapTahunKas()
    {
        // $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        // $jns = $this->request->getVar('jns');
        $data = [
            'kas' =>$this->kasModel->lapKasTahunan($thn),
            // 'simpan' =>$this->simpanModel->lapSimpanan($bln,$thn,$jns),
            'tahun' => $thn,
            'judul' => 'Laporan Kas Tahunan',
            // 'jenis' =>$this->jenisPinjaman->find($jns),
            'page' => 'kas/laporan/v_lap_kas',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate-lc-kas', $data),
        ];
        echo json_encode($response);
    }
// Laporan Kas
    public function laporanKas()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'judul' => 'Laporan Kas Account',
            'menu' => 'lapSimpanan',
            'menu2' => '',
            'submenu' => 'lapKas',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'footer' => 'layout/footer',
            'page' => 'laporan/laporan-kas',
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout/tamplate-admin',$data);
    }

    public function laporanKasBulanan()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $tanggal = $thn.'-'.$bln;
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'harian' => $this->kasModel->lapKasBulanan($bln,$thn),
            'judul' => 'Laporan Kas Bulanan',
            'menu' => 'lapSimpanan',
            'menu2' => '',
            'submenu' => 'lapKas',
            'page' => 'laporan/lap-kas',
            'bulan' => $bln.'-'.$thn,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate-lc-kas',$data);
    }

    public function laporanKasTahunan()
    {
        $thn = $this->request->getVar('tahun');
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'harian' => $this->kasModel->lapKasTahunan($thn),
            'tahun' => $thn,
            'judul' => 'Laporan Penarikan Tahunan',
            'menu' => 'pengajuan',
            'menu2' => '',
            'submenu' => 'laporanPengajuan',
            'page' => 'laporan/lap-kas',
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout-cetak/tamplate-lc-kas',$data);
    }

    public function viewLapTagihanBulanan()
    {
        
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        // $jns = $this->request->getVar('jns');
        $data = [
            'tagihan' =>$this->anggotaModel->lapTagihan($bln,$thn),
            // 'tagihanwajib' =>$this->simpanModel->lapTagihanWajib($bln,$thn),
            // 'tagihansukarela' =>$this->simpanModel->lapTagihanSukarela($bln,$thn),
            'bulan' => $bln .'-'. $thn,
            'judul' => 'Laporan Kas Bulanan',
            'page' => 'laporan/v_lap_tagihan',
            'title'=> '',
        ];
        $response = [
            'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }

/**/
}
