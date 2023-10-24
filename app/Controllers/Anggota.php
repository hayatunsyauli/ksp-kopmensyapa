<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\JenisPinjaman;
use App\Models\PinjamanModel;
use App\Models\PengajuanModel;
use App\Models\PengunduranModel;
use App\Models\AngsuranModel;
use App\Models\SimpanModel;
use App\Models\SimpanDetailModel;
use App\Models\NotifikasiModel;
use App\Models\ProfilKopModel;

class Anggota extends BaseController
{
    protected $anggotaModel;
    protected $jenisPinjaman;
    protected $pinjamanModel;
    protected $angsuranModel;
    protected $pengajuanModel;
    protected $pengunduranModel;
    protected $simpanModel;
    protected $simpanDetailModel;
    protected $notifikasiModel;
    protected $profilKopM;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->jenisPinjaman = new JenisPinjaman();
        $this->pinjamanModel = new PinjamanModel();
        $this->pengajuanModel = new PengajuanModel();
        $this->pengunduranModel = new PengunduranModel();
        $this->simpanModel          = new SimpanModel();
        $this->angsuranModel        = new AngsuranModel();
        $this->simpanDetailModel    = new SimpanDetailModel();
        $this->notifikasiModel    = new NotifikasiModel();
        $this->profilKopM = new ProfilKopModel();
    }

    public function index()
    {
        // $anggota = $this->anggotaModel->findAll();
        $no_anggota = session()->get('no_anggota');
        // $allNotifikasi = ;
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Anggota",
            'judul' => 'Dashboard',
            'menu' => 'dashboard',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/index',
            'pengunduran' => $this->pengunduranModel->getAllPengunduranAnggota($no_anggota),
            'anggota'       => $this->anggotaModel->find($no_anggota),
            'allNotifikasi' => $this->notifikasiModel->allNotifikasiLimitByAnggota($no_anggota),
            'jumlahPinjaman' => $this->pinjamanModel->jumlahPinjamanByAnggota($no_anggota),
            'jumlahPinjamanPj' => $this->pinjamanModel->jumlahPinjamanByAnggotaPanjang($no_anggota),
            'jumlahPinjamanPd' => $this->pinjamanModel->jumlahPinjamanByAnggotaPendek($no_anggota),
            'jumlahPinjamanBkd' => $this->pinjamanModel->jumlahPinjamanByAnggotaBkd($no_anggota),
            'pinjamanPj' => $this->jenisPinjaman->PinjamanByPanjang(),
            'pinjamanPd' => $this->jenisPinjaman->PinjamanByPendek(),
            'pinjamanBkd' => $this->jenisPinjaman->PinjamanByBkd(),
            'jumlahSimpanan' => $this->simpanModel->jumlahSimpananByAnggota($no_anggota),
            'jumlahPengajuan' => $this->pengajuanModel->jumlahPengajuanByAnggota($no_anggota),
            'notif' => $notif_count,
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
        ];

        return view('layout/tamplate-admin', $data);
    }

    public function profile()
    {
        $no_anggota = session()->get('no_anggota');
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Anggota",
            'anggota' => $this->anggotaModel->getAnggotaById($no_anggota),
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
            'notif' => $notif_count,
            'judul' => 'Profile Anggota',
            'menu' => 'profile',
            'submenu' => 'profile-saya',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/anggota-saya',
        ];
        return view('layout/tamplate-admin', $data);
    }

// ganti profile
    public function gantiProfile(){
        $no_anggota = session()->get('no_anggota');
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Anggota",
            'anggota' => $this->anggotaModel->getAnggotaById($no_anggota),
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
            'notif' => $notif_count,
            'validation' => \Config\Services::validation(),
            'judul' => 'Data Profile',
            'menu' => 'profile',
            'submenu' => 'profile-saya',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/ganti-profile',

        ];
        return view('layout/tamplate-admin',$data);
    } 

    // aksi ganti profile
    public function aksiGantiProfile($no_anggota){
         //cek judul
        $anggota = $this->anggotaModel->find($no_anggota);
        if (!$this->validate([
            'profil' => [
                'rules' => 'max_size[profil,1024]|is_image[profil]|mime_in[profil,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
        
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to('/anggota/gantiProfile/')->withInput();
        }

        $fileprofil = $this->request->getFile('profil');

        // cek gambar, apakh ttp gmbr lama
        if ($fileprofil->getError() == 4) {
            $namaprofil = $this->request->getVar('profilLama');
        }else{
            // gnrate nama file random
            $namaprofil = $fileprofil->getRandomName();
            // pindahkan gmbr
            $fileprofil->move('img/anggota', $namaprofil);
            // hapus file lama
            if ($anggota['profil'] != 'default.png') {
            unlink('img/anggota/'. $this->request->getVar('profilLama'));
                
            }
        }

        // $id = $this->input->post('id');
        $data = $this->anggotaModel->save([
            'no_anggota' => $no_anggota,
            'profil' => $namaprofil,
        ]);
        session()->setFlashdata('pesan','Data berhasil diubah');
        return redirect()->to('/anggota/profile');
     }


    // ganti Password anggota
    public function gantiPassword(){
        $no_anggota = session()->get('no_anggota');
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Anggota",
            'anggota' => $this->anggotaModel->getAnggotaById($no_anggota),
            'notif' => $notif_count,
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),            
            'validation' => \Config\Services::validation(),
            'judul' => 'Data Profile',
            'menu' => 'profile',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/ganti-password',

        ];
        return view('layout/tamplate-admin',$data);
    }

    public function aksiGantiPassword($no_anggota)
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
            return redirect()->to('/anggota/gantiPassword/')->withInput();
        }

        // $id = $this->input->post('id');
        $data = $this->anggotaModel->save([
            'no_anggota' => $no_anggota,
            'password' => htmlspecialchars(md5($passBaru)),
        ]);
        session()->setFlashdata('pesan','Password berhasil diubah');
        return redirect()->to('/anggota/profile');
    }

// SIMPANAN
    public function setoranSaya($id_simpanan)
    {
        $no_anggota = session()->get('no_anggota');
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);

        $setoranSaya = $this->simpanModel->getRiwayatSetoranById($id_simpanan);
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            'setoranSaya' => $setoranSaya,
            'notif' => $notif_count,
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
        ];
        return view('anggota/setoranSaya',$data);
    }

     public function simpananSaya()
    {
        $no_anggota = session()->get('no_anggota');
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);

        $simpananSaya = $this->simpanModel->getSimpananByNoAnggota(session('no_anggota'));
        $simpanan = $this->simpanDetailModel->getSimpananDetail($no_anggota);
        $setoranSaya = $this->simpanModel->getRiwayatSetoranByAnggota(session('no_anggota'));
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Simpanan",
            'simpanan' => $simpanan,
            'simpananSaya' => $simpananSaya,
            'setoranSaya' => $setoranSaya,
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
            'notif' => $notif_count,
            'judul' => 'Simpanan Saya',
            'menu' => 'simpanan',
            'submenu' => 'simpanan-saya',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/simpanan-saya',
        ];
        return view('layout/tamplate-admin',$data);
    }

    public function rimayatPenarikan()
    {
        $no_anggota = session()->get('no_anggota');
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Riwayat Penarikan",
            'histori_penarikan' => $this->simpanModel->historyPenarikanAnggota(session('no_anggota')),
            'notif' => $notif_count,
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
            'judul' => 'Riwayat Penarikan Simpanan Sukarela',
            'menu' => 'simpanan',
            'submenu' => 'riwayat-pe',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/rimayatPenarikan',
        ];
        return view('layout/tamplate-admin',$data);
    }

// PENGAJUAN 
    public function pengajuanSaya()
    {
        $no_anggota = session()->get('no_anggota');
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pengajuan Pinjaman",
            'pengajuan' => $this->pengajuanModel->dataPengajuan(session('no_anggota')),
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
            'notif' => $notif_count,
            'judul' => 'Ajukan Pinjaman',
            'menu' => 'pengajuan',
            'submenu' => 'ajukan',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/pengajuan-saya',

        ];

        return view('layout/tamplate-admin', $data);
    }

    public function detailPengajuan($id_pengajuan)
    {
        $no_anggota = session()->get('no_anggota');
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pengajuan Pinjaman",
            'pengajuan' => $this->pengajuanModel->dataPengajuanById($id_pengajuan),
            'angsuran' => $this->angsuranModel->dataAngsuranByIdPengajuan($id_pengajuan),
            'status' => $this->angsuranModel->dataStsPinjamByIdPengajuan($id_pengajuan),
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
            'notif' => $notif_count,
            'judul' => 'Detail Pengajuan Pinjaman',
            'menu' => 'pengajuan',
            'submenu' => 'ajukan',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/pengajuan-detail',

        ];

        return view('layout/tamplate-admin', $data);
    }
    
    public function tambahPengajuan()
    {
        $no_anggota = session()->get('no_anggota');
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pengajuan Pinjaman",
            'data' => $this->anggotaModel->find(session('no_anggota')),
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
            'notif' => $notif_count,
            'jenisPinjam' => $this->jenisPinjaman->findAll(),
            'judul' => 'Pengajuan Pinjaman Baru',
            'menu' => 'pinjaman',
            'submenu' => 'ajukan',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/pengajuanCreate',
        ];
        return view('layout/tamplate-admin', $data);

        /*
            $no_anggota = session()->get('no_anggota');
            $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);
            
            $profilkop = $this->profilKopM->find(1);
            $status = $this->anggotaModel->find(session('no_anggota'));

            $dataStatus = $this->pinjamanModel->dataPengajuanByStatus(session('no_anggota'));
            $statusPengunduran = $this->pinjamanModel->dataPengunduranBystatus(session('no_anggota'));
            $dataStatusPinjaman = $this->pinjamanModel->dataPengajuanByStatusPinjaman(session('no_anggota'));
       
            if (!empty($dataStatus->status_pengajuan) && empty($dataStatusPinjaman)) {
                if ($dataStatus->status_pengajuan != "Sedang Diverifikasi" && $dataStatus->status_pengajuan != "Menunggu Persetujuan Ketua" && $status['status_anggota'] == "Aktif") {
                $data = [
                    'profilkop' => $profilkop,
                    'title' => $profilkop['nama_kop']." | Pengajuan Pinjaman",
                    'data' => $this->anggotaModel->find(session('no_anggota')),
                    'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
                    'notif' => $notif_count,
                    'jenisPinjam' => $this->jenisPinjaman->findAll(),
                    'judul' => 'Pengajuan Pinjaman Baru',
                    'menu' => 'pinjaman',
                    'submenu' => 'ajukan',
                    'header'    => 'layout/header',
                    'sidemenu'  => 'layout/sidemenu',
                    'footer'    => 'layout/footer',
                    'page' => 'anggota/pengajuanCreate',
                    ];
                    return view('layout/tamplate-admin', $data);
                    
                }else{
                    session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
                        <i class="fa fa-exclamation"></i> Maaf anda belum bisa mengajukan pinjaman karena status pengajuan sebelumya masih dalam tahap verifikasi.
                      </div>');
                    return redirect()->to('anggota/pengajuanSaya');

                }
            } else if (!empty($dataStatus->status_pengajuan) && !empty($dataStatusPinjaman) && !empty($statusPengunduran->status_pengunduran)) {
                if ($dataStatus->status_pengajuan != "Sedang Diverifikasi" && $statusPengunduran->status_pengunduran != "Sedang Diverifikasi" && $statusPengunduran->status_pengunduran != "Menunggu Persetujuan Ketua" && $status['status_anggota'] == "Aktif" && $dataStatusPinjaman->status_pinjaman == "Lunas") {
                $data = [
                    'profilkop' => $profilkop,
                    'title' => $profilkop['nama_kop']." | Pengajuan Pinjaman",
                    'data' => $this->anggotaModel->find(session('no_anggota')),
                    'notif' => $notif_count,
                    'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
                    'jenisPinjam' => $this->jenisPinjaman->findAll(),
                    'judul' => '',
                    'menu' => 'pinjaman',
                    'submenu' => 'ajukan',
                    'header'    => 'layout/header',
                    'sidemenu'  => 'layout/sidemenu',
                    'footer'    => 'layout/footer',
                    'page' => 'anggota/pengajuanCreate',
                    
                    ];
                    return view('layout/tamplate-admin', $data);
                }else{
                    session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
                        <i class="fa fa-exclamation"></i> Maaf anda belum bisa mengajukan pinjaman karena status pengajuan sebelumya masih dalam tahap verifikasi atau anda masih memiliki pinjaman yang belum lunas atau anda sedang dalam tahap verifikasi pengunduran diri.
                        </div>');
                    return redirect()->to('anggota/pengajuanSaya');

                }
            } else if (!empty($statusPengunduran->status_pengunduran)){
                if ($statusPengunduran->status_pengunduran != "Sedang Diverifikasi" && $status['status_anggota'] == "Aktif") {
                $data = [
                    'profilkop' => $profilkop,
                    'title' => $profilkop['nama_kop']." | Pengajuan Pinjaman",
                    'data' => $this->anggotaModel->find(session('no_anggota')),
                    'notif' => $notif_count,
                    'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
                    'jenisPinjam' => $this->jenisPinjaman->findAll(),
                    'judul' => '',
                    'menu' => 'pinjaman',
                    'submenu' => 'ajukan',
                    'header'    => 'layout/header',
                    'sidemenu'  => 'layout/sidemenu',
                    'footer'    => 'layout/footer',
                    'page' => 'anggota/pengajuanCreate',
                    
                    ];
                    return view('layout/tamplate-admin', $data);
                } else {
                    session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Maaf anda belum bisa mengajukan pinjaman karena status anda masih belum anggota aktif atau anda sedang dalam tahap verifikasi pengunduran diri.
                  </div>');
                    return redirect()->to('anggota/pengajuanSaya');

                }
            }else{
                if ($status['status_anggota'] == "Aktif") {
                $data = [
                    'profilkop' => $profilkop,
                    'title' => $profilkop['nama_kop']." | Pengajuan Pinjaman",
                    'data' => $this->anggotaModel->find(session('no_anggota')),
                    'notif' => $notif_count,
                    'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
                    'jenisPinjam' => $this->jenisPinjaman->findAll(),
                    'judul' => '',
                    'menu' => 'pinjaman',
                    'submenu' => 'ajukan',
                    'header'    => 'layout/header',
                    'sidemenu'  => 'layout/sidemenu',
                    'footer'    => 'layout/footer',
                    'page' => 'anggota/pengajuanCreate',
                    
                    ];
                    return view('layout/tamplate-admin', $data);
                } else {
                    session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">
                    Maaf anda belum bisa mengajukan pinjaman karena status anda masih belum anggota aktif
                  </div>');
                    return redirect()->to('anggota/pengajuanSaya');

                }
            }

        */
    }

    public function prosesTambahPengajuan()
    {
        $status = $this->anggotaModel->find(session('no_anggota'));
        $jenis_pinjaman = $this->request->getVar('jenis_pinjaman');

        $dataStatus = $this->pinjamanModel->dataPengajuanByStatus(session('no_anggota'));
        $dataStatusPinjaman = $this->pinjamanModel->dataPengajuanByStatusPinjaman(session('no_anggota'));
        // $dataStatus = $this->pinjamanModel->dataPengajuanByStatus(session('no_anggota'));
        // $dataStatusPinjaman = $this->pinjamanModel->dataPengajuanByStatusPinjaman(session('no_anggota'));
   
        if (!empty($dataStatus->status_pengajuan)) {
            if ($dataStatus->id_jenis_pinjaman != $jenis_pinjaman && $dataStatus->status_pengajuan !=['Diterima'] && $status['status_anggota'] == "Aktif") {
                
                $this->pengajuanModel->insert([
                    'no_anggota' => $this->request->getVar('no_anggota'),
                    'status_pengajuan' => 'Sedang Diverifikasi',
                    'bsr_pengajuan' => $this->request->getVar('jumlah_pinjaman'),
                    'tgl_pengajuan' => $this->request->getVar('tgl_pengajuan'),
                    'id_jenis_pinjaman' => $this->request->getVar('jenis_pinjaman'),
                    'lama_angsuran' => $this->request->getVar('lama_angsuran'),
                    'pesan' => '',
                    'tgl_pengajuan' => date('Y-m-d H:i:s'),
                    'id_pengajuan' => 'PP'.date('YmdHis'),
                ]);

                $this->notifikasiModel->insert([
                    'id_referensi' => 202308002,
                    'judul' => 'Pengajuan Pinjaman Baru',
                    'detail' => 'Nomor Anggota '.$this->request->getVar('no_anggota').' telah mengajukan pinjaman baru',
                    'no_anggota' => '',
                    'level_c' => '1',
                    'is_read' => 0,
                ]);
                session()->setFlashdata('pesan','<div class="alert alert-success" role="alert">
                    Pengajuan berhasil ditambahkan
                    </div>');

                return redirect()->to('anggota/pengajuanSaya');
                
            }else{
                session()->setFlashdata('gagal','<i class="fa fa-warning"></i> Maaf gagal mengajukan pinjaman karena jenis pinjaman sama seperti pinjaman yang sedang berjalan atau sedang diverifikasi.');
                return redirect()->to('anggota/pengajuanSaya');

            }
        } else {
            if ($status['status_anggota'] == "Aktif") {
                $this->pengajuanModel->insert([
                    'no_anggota' => $this->request->getVar('no_anggota'),
                    'status_pengajuan' => 'Sedang Diverifikasi',
                    'bsr_pengajuan' => $this->request->getVar('jumlah_pinjaman'),
                    'tgl_pengajuan' => $this->request->getVar('tgl_pengajuan'),
                    'id_jenis_pinjaman' => $this->request->getVar('jenis_pinjaman'),
                    'lama_angsuran' => $this->request->getVar('lama_angsuran'),
                    'pesan' => '',
                    'id_pengajuan' => 'PP'.date('YmdHis'),
                    'tgl_pengajuan' => date('Y-m-d H:i:s'),
                ]);

                $this->notifikasiModel->insert([
                    'id_referensi' => 202308002,
                    'judul' => 'Pengajuan Pinjaman Baru',
                    'detail' => 'Nomor Anggota '.$this->request->getVar('no_anggota').' telah mengajukan pinjaman baru',
                    'no_anggota' => '',
                    'level_c' => '1',
                    'is_read' => 0,
                ]);
                session()->setFlashdata('pesan','<div class="alert alert-success" role="alert">
                    Pengajuan berhasil ditambahkan
                    </div>');
                return redirect()->to('anggota/pengajuanSaya');
            } else {
                session()->setFlashdata('gagal', 'Maaf anda belum bisa mengajukan pinjaman karena status anda masih belum anggota aktif. Silahkan <a href="">baca pedoman berikut</a> untuk mengaktifkan anggota.');
                return redirect()->to('anggota/pengajuanSaya');


            }
        }
    }
    
//PINJAMAN
    public function pinjamanSaya()
    {
        $no_anggota = session()->get('no_anggota');
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);
        $id_pinjaman = $this->pinjamanModel->find('id_pinjaman', $no_anggota);
        $hitungAngsur = $this->angsuranModel->countAngsuranByAnggota($no_anggota, $id_pinjaman);
        $pinjaman = $this->pinjamanModel->dataPinjamanBy($no_anggota);
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pinjaman",
            'pinjaman' => $pinjaman,
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
            'notif' => $notif_count,
            'hitungangsur' => $hitungAngsur,
            'judul' => 'Pinjaman',
            'menu' => 'pinjaman',
            'submenu' => 'ajukan',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/pinjamanSaya',

        ];

        return view('layout/tamplate-admin', $data);
    }

// Pengajuan Pengunduran member
    public function pengunduran()
    {
        $no_anggota = session()->get('no_anggota');
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pengunduran",
            'pengunduran' => $this->pengunduranModel->getAllPengunduranAnggota($no_anggota),
            'anggota' => $no_anggota,
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
            'notif' => $notif_count,
            'judul' => 'Riwayat Pengajuan Pengunduran Anggota',
            'menu' => 'profile',
            'submenu' => 'ajukanPengunduran',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/pengunduran-saya',

        ];

        return view('layout/tamplate-admin', $data);
    }

    //Proses ajukan pengunduran anggota
    public function prosesAjukanPengunduran()
    {
        $no_anggota = session()->get('no_anggota');

        $status = $this->anggotaModel->find($no_anggota);

        $dataStatus = $this->pinjamanModel->dataPengajuanByStatus($no_anggota);
        $dataStatusPinjaman = $this->pinjamanModel->dataPengajuanByStatusPinjaman($no_anggota);
   
        if (!empty($dataStatus->status_pengajuan) && empty($dataStatusPinjaman)) {
            if ($dataStatus->status_pengajuan != "Sedang Diverifikasi" && $dataStatus->status_pengajuan != "Menunggu Persetujuan Ketua" && $status['status_anggota'] == "Aktif") {
                
                $this->pengunduranModel->insert([
                    // 'id_pengunduran' => 'PA'.date('YmdHis'),
                    'no_anggota' => $no_anggota,
                    'status_pengajuan' => 'Sedang Diverifikasi',
                ]);

                $this->notifikasiModel->insert([
                    'id_referensi' => 202308004,
                    'judul' => 'Pengajuan Pengunduran Anggota',
                    'detail' => 'Nomor Anggota '.$no_anggota.' telah mengajukan pengunduran diri',
                    'no_anggota' => '',
                    'level_c' => '1',
                    'is_read' => 0,
                ]);

                session()->setFlashdata('pesan', 'Pengajuan berhasil ditambahkan');
                return redirect()->to('anggota/pengunduran');
                
            }else{
                session()->setFlashdata('gagal', '<i class="fa fa-exclamation"></i> Maaf anda belum bisa mengajukan pengunduran anggota karena status pengajuan pinjaman sebelumya masih dalam tahap verifikasi.');
                return redirect()->to('anggota/pengunduran');

            }
        } else if (!empty($dataStatus->status_pengajuan) && !empty($dataStatusPinjaman)) {
            if ($dataStatus->status_pengajuan != "Sedang Diverifikasi" && $dataStatus->status_pengajuan != "Menunggu Persetujuan Ketua" && $status['status_anggota'] == "Aktif" && $dataStatusPinjaman->status_pinjaman == "Lunas") {

                $this->pengunduranModel->insert([
                    // 'id_pengunduran' => 'PA'.date('YmdHis'),
                    'no_anggota' => $no_anggota,
                    'status_pengunduran' => 'Sedang Diverifikasi',
                    
                ]);

                $this->notifikasiModel->insert([
                    'id_referensi' => 202308004,
                    'judul' => 'Pengajuan Pengunduran Anggota',
                    'detail' => 'Nomor Anggota '.$no_anggota.' telah mengajukan pengunduran diri',
                    'no_anggota' => '',
                    'level_c' => '1',
                    'is_read' => 0,
                ]);

                session()->setFlashdata('pesan', 'Pengajuan berhasil ditambahkan');
                return redirect()->to('anggota/pengunduran');
            }else{
                session()->setFlashdata('gagal', '<i class="fa fa-exclamation"></i> Maaf anda belum bisa mengajukan pengunduran anggota karena status pengajuan pinjaman sebelumya masih dalam tahap verifikasi atau anda masih memiliki pinjaman yang belum lunas.');
                return redirect()->to('anggota/pengunduran');

            }
        } else {
            if ($status['status_anggota'] == "Aktif") {
                $this->pengunduranModel->insert([
                        // 'id_pengunduran' => 'PA'.date('YmdHis'),
                        'no_anggota' => $no_anggota,
                        'status_pengunduran' => 'Sedang Diverifikasi',
                        
                ]);

                $this->notifikasiModel->insert([
                    'id_referensi' => 202308004,
                    'judul' => 'Pengajuan Pengunduran Anggota',
                    'detail' => 'Nomor Anggota '.$no_anggota.' telah mengajukan pengunduran diri',
                    'no_anggota' => '',
                    'level_c' => '1',
                    'is_read' => 0,
                ]);
                session()->setFlashdata('pesan','Pengajuan berhasil ditambahkan');
                return redirect()->to('anggota/pengunduran');

            }else{
                session()->setFlashdata('error', 'Maaf anda belum bisa mengajukan pinjaman karena status anda masih belum anggota aktif. Silahkan <a href="">baca pedoman berikut</a> untuk mengaktifkan anggota.');
                return redirect()->to('anggota/pengunduran');
            }
        }
    }

    public function notifikasi()
    {
        $no_anggota = session()->get('no_anggota');
        // $anggota = $this->anggotaModel->find('')
        $allNotifikasi = $this->notifikasiModel->allNotifikasiByAnggota($no_anggota);
        $notif_count = $this->notifikasiModel->countNotifikasiByAnggota($no_anggota);        

        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Notifikasi",
            'notifikasi' => $this->notifikasiModel->notifikasiByAnggota($no_anggota),
            'anggota' => $no_anggota,
            'notif' => $notif_count,
            'allnotifikasi' => $allNotifikasi,
            'judul' => 'Notifikasi Anggota',
            'menu' => 'notifikasi',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'anggota/notifikasi',

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
        return redirect()->to('anggota/notifikasi');
    }


    public function deleteNotif($id_notifikasi)
    {
        $this->notifikasiModel->delete([
            'id_notifikasi' => $id_notifikasi,
        ]);
        session()->setFlashdata('gagal','Notif berhasil dihapus');
        return redirect()->to('anggota/notifikasi');
    }

    public function deletePengunduran($id_pengunduran)
    {
        $statusPengunduran = $this->pengunduranModel->pengunduranById($id_pengunduran);
/*
        if ($statusPengunduran['status_pengunduran'] != 2 OR $statusPengunduran['status_pengunduran'] != 3) {
            $this->pengunduranModel->delete([
                'id_pengunduran' => $id_pengunduran,
            ]);
            session()->setFlashdata('gagal','Pengunduran berhasil dihapus');
            return redirect()->to('anggota/pengunduran');
        } else {
            session()->setFlashdata('gagal','Pengajuan Pengunduran gagal dihapus karena status pengunduran sedang Menunggu Persetujuan Ketua atau Pengunduran anda telah diterima');
            return redirect()->to('anggota/pengunduran');
            
        }
*/
        if ($statusPengunduran->status_pengunduran != 2 OR $statusPengunduran->status_pengunduran != 3) {
            $this->pengunduranModel->delete([
                'id_pengunduran' => $id_pengunduran,
            ]);
            session()->setFlashdata('gagal','Pengunduran berhasil dihapus');
            return redirect()->to('anggota/pengunduran');
                
            }else{
                session()->setFlashdata('gagal','Pengajuan Pengunduran gagal dihapus karena status pengunduran sedang Menunggu Persetujuan Ketua atau Pengunduran anda telah diterima');
            return redirect()->to('anggota/pengunduran');

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
            'submenu' => 'pinjaman',
            'page' => 'anggota/cetak-pjm-anggota',
            'header' => 'layout/header',
            'sidemenu' => 'layout/sidemenu',
            'footer' => 'layout/footer',
        ];
        return view('layout-cetak/tamplate', $data);
    }
    public function viewLapBulanSimpAnggota()
    {
        $bln = $this->request->getVar('bulan');
        $thn = $this->request->getVar('tahun');
        $no_anggota = session()->get('no_anggota');
        // $jns = $this->request->getVar('jns');
        $data = [
            'simpan' =>$this->simpanModel->lapSimpananBulananAnggota($bln,$thn,$no_anggota),
            // 'simpan' =>$this->simpanModel->lapSimpanan($bln,$thn,$jns),
            'bulan' => $bln .' - '. $thn,
            // 'jenis' => $jns,
            // 'page' => 'anggota/laporan/v_lap_sim',
            'title'=> '',
        ];
        $response = [
            'data' => view('anggota/laporan/v_lap_sim', $data),
            // 'data' => view('layout-cetak/tamplate', $data),
        ];
        echo json_encode($response);
    }
}

