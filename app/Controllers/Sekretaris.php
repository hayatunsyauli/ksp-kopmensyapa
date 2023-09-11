<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\PetugasModel;
use App\Models\JenisPinjaman;
use App\Models\JenisSimpanan;
use App\Models\PinjamanModel;
use App\Models\PengajuanModel;
use App\Models\PengunduranModel;
use App\Models\AnggotaModel;
use App\Models\SimpanModel;
use App\Models\SimpanDetailModel;
use App\Models\KasModel;
use App\Models\NotifikasiModel;
use App\Models\ProfilKopModel;

class Sekretaris extends BaseController
{
    protected $petugasModel;
    protected $jenisPinjaman;
    protected $jenisSimpanan;
    protected $pinjamanModel;
    protected $pengajuanModel;
    protected $pengunduranModel;
    protected $anggotaModel;
    protected $simpanModel;
    protected $simpanDetailModel;
    protected $kasModel;
    protected $notifikasiModel;
    protected $profilKopM;

    public function __construct()
    {
        $this->petugasModel = new PetugasModel();
        $this->jenisPinjaman = new JenisPinjaman();
        $this->jenisSimpanan = new JenisSimpanan();
        $this->pinjamanModel = new PinjamanModel();
        $this->pengajuanModel = new PengajuanModel();
        $this->pengunduranModel = new PengunduranModel();
        $this->anggotaModel = new AnggotaModel();
        $this->simpanModel = new SimpanModel();
        $this->simpanDetailModel = new SimpanDetailModel();
        $this->kasModel = new KasModel();
        $this->notifikasiModel    = new NotifikasiModel();
        $this->profilKopM = new ProfilKopModel();
    }

    public function index()
    {
        $notif_count = $this->notifikasiModel->countNotifikasiBylevelSek();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelSek();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Dashboard",
            'judul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'index',
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

    public function daftarPinjaman()
    {
        $notif_count = $this->notifikasiModel->countNotifikasiBylevelSek();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelSek();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pinjaman",
            'judul' => 'Data Pinjaman',
            'menu' => 'pinjaman',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'sekretaris/daftar-pinjaman',
            'pinjaman' => $this->pinjamanModel->dataPinjamanByIdPinjaman(),
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('layout/tamplate-admin',$data);
    }

    public function daftarPengajuan()
    {
        $notif_count = $this->notifikasiModel->countNotifikasiBylevelSek();
        $pengajuan = $this->pengajuanModel->getAllPengajuan();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelSek();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pengajuan",
            'judul' => 'Data Pengajuan Pinjaman',
            'pengajuan' => $pengajuan,
            'notifikasi' => $notifikasi,
            'notif' => $notif_count,
            'menu' => 'pengajuan',
            'submenu' => 'pengajuanPinjam',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'sekretaris/daftar-pengajuan',

        ];

        return view('layout/tamplate-admin', $data);
    }

    public function daftarPengunduranAnggota()
    {
        $notif_count = $this->notifikasiModel->countNotifikasiBylevelSek();
        $pengajuan = $this->pengunduranModel->GetAllPengunduran();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelSek();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Pengajuan",
            'judul' => 'Data Pengunduran Anggota',
            'pengunduran' => $pengajuan,
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'menu' => 'anggota',
            'submenu' => 'dpa',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'sekretaris/daftar-pengunduran',

        ];

        return view('layout/tamplate-admin', $data);
    }

    public function prosesAlihPengajuanKeKetua($id_pengajuan)
    {
        $no_anggota = $this->request->getVar('no_anggota');
        $this->pengajuanModel->save([
            'id_pengajuan'      => $id_pengajuan,
            'status_pengajuan'  => '2',
            'tgl_veri_sekretaris'    => date('Y-m-d H:i:s'),
            'pesan'             => $this->request->getVar('pesan'),
            'jml_emas'             => $this->request->getVar('emas'),
        ]);

        $this->notifikasiModel->insert([
            'id_referensi' => 202308002,
            'judul' => 'Pengajuan Pinjaman Baru',
            'detail' => 'Nomor Anggota '.$no_anggota.' telah mengajukan Pinjaman baru.',
            'level' => '1',
            'is_read' => 0,
        ]);
      
        session()->setFlashdata('pesan','Pengajuan Berhasil Diserahkan Kepada Ketua');
        return redirect()->to('sekretaris/daftarPengajuan');
    }

    public function prosesAlihPengunduranKeKetua($id_penguduran)
    {
        $no_anggota = $this->request->getVar('no_anggota');

        $this->pengunduranModel->save([
            'id_pengunduran'  => $id_penguduran,
            'status_pengunduran'  => '2',
            'ket'                 => $this->request->getVar('ket'),
        ]);
        $this->notifikasiModel->insert([
            'id_referensi' => 202308004,
            'judul' => 'Pengajuan Pengunduran Anggota',
            'detail' => 'Nomor Anggota '.$no_anggota.' telah mengajukan pengunduran diri',
            'level' => '1',
            'is_read' => 0,
        ]);

      
        session()->setFlashdata('pesan','Pengajuan Berhasil Diserahkan Kepada Ketua');
        return redirect()->to('sekretaris/daftarPengunduranAnggota');
    }

    public function anggota(){
        $notif_count = $this->notifikasiModel->countNotifikasiBylevelSek();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelSek();
        $anggota = $this->anggotaModel->findAll();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Anggota",
            'anggota' => $anggota,
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'judul' => 'Daftar data anggota',
            'menu' => 'anggota',
            'submenu' => 'subanggota',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'sekretaris/daftar-anggota',
        ];

        return view('layout/tamplate-admin', $data);
    }

    public function tambahAnggota()
    {
        $notif_count = $this->notifikasiModel->countNotifikasiBylevelSek();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelSek();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Tambah Anggota",
            'judul' => 'Tambah Anggota Baru',
            'menu' => 'anggota',
            'submenu' => 'subanggota',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'sekretaris/tambah-anggota',
            'no_anggota' => $this->anggotaModel->no_anggota(),
            'simpananPkk' => $this->jenisSimpanan->simpananPkk(),
            'validation' => \Config\Services::validation(),
            'notifikasi' => $notifikasi,
            'notif' => $notif_count,
        ];

        return view('layout/tamplate-admin', $data);
    }

    public function simpanAnggota() //proses
    {

        // validasi input
        if (!$this->validate([
            'profil' => [
                'rules' => 'max_size[profil,1024]|is_image[profil]|mime_in[profil,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ],
            'nrp' => [
                'rules' => 'is_unique[anggota.nrp]',
                'errors' => [
                    'is_unique' => 'NRP Sudah Ada!']
            ],
            'email' => [
                'rules' => 'is_unique[anggota.email]',
                'errors' => [
                    'is_unique' => 'Email Sudah Terdaftar!']
            ],


        ])) {
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to('sekretaris/tambahAnggota')->withInput();
        }
        // ambil gambar
        $fileprofil = $this->request->getFile('profil');
        // apakah hana gambe yg di post
        if ($fileprofil->getError() == 4) {
            $namaprofil = 'default.png';
        } else {
            // ambil nama file profil
            $namaprofil = $fileprofil->getRandomName();
            // pindahkan file ke folder img
            $fileprofil->move('img/anggota/', $namaprofil);
        }

        // $slug = url_title($this->request->getVar('judul'), '-', TRUE);
        $this->anggotaModel->insert([
            'no_anggota' => $this->request->getVar('no_anggota'),
            'nrp' => $this->request->getVar('nrp'),
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'unit_kerja' => $this->request->getVar('unit_kerja'),
            'jabatan' => $this->request->getVar('jabatan'),
            'nohp' => $this->request->getVar('nohp'),
            'email' => $this->request->getVar('email'),
            'password' => htmlspecialchars(md5($this->request->getVar('password'))),
            'status_kerja' => $this->request->getVar('status_kerja'),
            'profil' => $namaprofil

        ]);

        $this->simpanModel->insert([
            // 'id_simpanan' => 'SS'.date('YmdHis'),
            'simpanan_pokok' => $this->request->getVar('jmlh_simpanan_pokok'),
            'no_anggota' => $this->request->getVar('no_anggota')

        ]);

        $simpanId = $this->simpanModel->insertID();

        $this->simpanDetailModel->insert([
            'id_simpanan' => $simpanId,
            'no_anggota' => $this->request->getVar('no_anggota'),
            'id_jenis_simpanan' => $this->request->getVar('jns_simpan'),
            'debet' => $this->request->getVar('jmlh_simpanan_pokok'),
            'kredit' => 0,
            'status' => 'Debet',
            'sts_setor' => 'Manual',
        ]);

        session()->setFlashdata('pesan', 'Anggota baru berhasil ditambahkan');

        return redirect()->to('sekretaris/anggota');
    }

    public function delete($id)
    {
        // cari gmbr bdsrkan id
        $anggota = $this->anggotaModel->find($id);

        // cek gmbr default
        if ($anggota['profil'] != 'default.png') {
            // hapus gambar
            unlink('img/' . $anggota['profil']);
        }

        $this->anggotaModel->delete($id);
        session()->setFlashdata('pesan', 'Anggota berhasil dihapus');
        return redirect()->to('sekretaris/anggota');
    }

    public function editAnggota($no_anggota)
    {
        $notifikasi = $this->notifikasiModel->notifikasiBylevelSek();
        $notif_count = $this->notifikasiModel->countNotifikasiBylevelSek();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Data anggota",
            'judul' => 'Edit Anggota Baru',
            'menu' => 'anggota',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'sekretaris/edit-anggota',
            'validation' => \Config\Services::validation(),
            'anggota' => $this->anggotaModel->getAnggota($no_anggota),
            'notifikasi' => $notifikasi,
            'notif' => $notif_count,
        ];

        return view('layout/tamplate-admin', $data);
    }

    public function updateAnggota($no_anggota)
    {
        //cek judul
        $anggotaLama = $this->anggotaModel->getAnggotaById($this->request->getVar('nrp'));
        if ($anggotaLama['nrp'] == $this->request->getVar('nrp')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[anggota.nrp]';
        }
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
            return redirect()->to('/sekretaris/editAnggota/' . $this->request->getVar('no_anggota'))->withInput();
        }
        $fileprofil = $this->request->getFile('profil');
        // cek gambar, apakh ttp gmbr lama
        if ($fileprofil->getError() == 4) {
            $namaprofil = $this->request->getVar('profilLama');
        } else {
            // gnrate nama file random
            $namaprofil = $fileprofil->getRandomName();
            // pindahkan gmbr
            $fileprofil->move('img/anggota', $namaprofil);
            // hapus file lama
            unlink('img/anggota/' . $this->request->getVar('profilLama'));
        }

        // $id = $this->input->post('id');
        $data = $this->anggotaModel->save([
            'no_anggota' => $this->request->getVar('no_anggota'),
            'nrp' => $this->request->getVar('nrp'),
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'unit_kerja' => $this->request->getVar('unit_kerja'),
            'jabatan' => $this->request->getVar('jabatan'),
            'nohp' => $this->request->getVar('nohp'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'status_kerja' => $this->request->getVar('status_kerja'),
            'profil' => $namaprofil
        ]);
        session()->setFlashdata('pesan', 'Anggota berhasil diupdate');
        return redirect()->to('sekretaris/anggota');
    }

    public function jenisPinjaman(){
        $jenisPinjam = $this->jenisPinjaman->findAll();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelSek();
        $notif_count = $this->notifikasiModel->countNotifikasiBylevelSek();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Jenis Pinjaman",
            'jenisPinjam' => $jenisPinjam,
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'judul' => 'Data Jenis Pinjaman',
            'menu' => 'jenisPinjaman',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'sekretaris/daftar-jenis-pinjaman',
        ];

        return view('layout/tamplate-admin', $data);
    }

    public function jenisSimpanan(){
        $jenisSimpan = $this->jenisSimpanan->findAll();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelSek();
        $notif_count = $this->notifikasiModel->countNotifikasiBylevelSek();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Jenis Simpanan",
            'jenisSimpan' => $jenisSimpan,
            'notif' => $notif_count,
            'notifikasi' => $notifikasi,
            'judul' => 'Data Jenis Simpanan',
            'menu' => 'jenisSimpanan',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'sekretaris/daftar-jenis-simpanan',
        ];

        return view('layout/tamplate-admin', $data);
    }

    public function prosesJnsPinjamCreate(){
        $this->jenisPinjaman->insert([
            'id'        => $this->request->getVar('id'),
            'jenis_pinjaman'  => $this->request->getVar('jenis_pinjaman'),
            'jasa1'  => $this->request->getVar('jasa1'),
            'jasa2'  => $this->request->getVar('jasa2'),
            'kurang1_dari'  => $this->request->getVar('kurang1_dari'),
            'kurang2_dari'  => $this->request->getVar('kurang2_dari'),
        ]);
        session()->setFlashdata('pesan','Data berhasil disimpan');
        return redirect()->to('sekretaris/jenisPinjaman');
    }

    public function prosesJnsSimpanCreate(){
        $this->jenisSimpanan->insert([
            'jenis_simpanan'  => $this->request->getVar('jenis_simpanan'),
            'jumlah'  => $this->request->getVar('jumlah'),
        ]);
        session()->setFlashdata('pesan','Data berhasil disimpan');
        return redirect()->to('sekretaris/jenisSimpanan');
    }

    public function prosesJnsPinjamUpdate(){
        $this->jenisPinjaman->save([
            'id'        => $this->request->getVar('id'),
            'jenis_pinjaman'  => $this->request->getVar('jenis_pinjaman'),
            'jasa1'  => $this->request->getVar('jasa1'),
            'jasa2'  => $this->request->getVar('jasa2'),
            'kurang1_dari'  => $this->request->getVar('kurang1_dari'),
            'kurang2_dari'  => $this->request->getVar('kurang2_dari'),
        ]);
        session()->setFlashdata('pesan','Data jenis pinjaman berhasil diupdate');
        return redirect()->to('sekretaris/jenisPinjaman');
    }

    public function prosesJnsSimpanUpdate(){
    $this->jenisSimpanan->save([
        'id'        => $this->request->getVar('id'),
        'jenis_simpanan'  => $this->request->getVar('jenis_simpanan'),
        'jumlah'  => $this->request->getVar('jumlah'),
    ]);
    session()->setFlashdata('pesan','Data jenis simpanan berhasil diupdate');
    return redirect()->to('sekretaris/jenisSimpanan');
    }

    public function deleteJns($id){
        $this->jenisPinjaman->delete($id);
        session()->setFlashdata('pesan','Data jenis pinjaman berhasil dihapus');
        return redirect()->to('sekretaris/jenisPinjaman');
    }

    public function deleteJnsSmp($id){
        // $this->jenisSimpanan->delete($id);
        // session()->setFlashdata('pesan','Data jenis simpanan berhasil dihapus');
        return redirect()->to('sekretaris/jenisSimpanan');
    }

    public function notifikasi()
    {
        // $level = session()->get('level');
        $notifikasi = $this->notifikasiModel->notifikasiBylevelSek();
        $notif_count = $this->notifikasiModel->countNotifikasiBylevelSek();
        $allNotifikasi = $this->notifikasiModel->allNotifikasiByLevelSek();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | KOPMENSYAPA",
            'notifikasi' => $notifikasi,
            'notif' => $notif_count,
            'allnotifikasi' => $allNotifikasi,
            'judul'     => 'Notifikasi Sekretaris',
            'menu'      => 'notifikasi',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'sekretaris/notifikasi',

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
        return redirect()->to('sekretaris/notifikasi');
    }


    public function deleteNotif($id_notifikasi)
    {
        $this->notifikasiModel->delete([
            'id_notifikasi' => $id_notifikasi,
        ]);
        session()->setFlashdata('gagal','Notif berhasil dihapus');
        return redirect()->to('sekretaris/notifikasi');
    }

    public function daftarTagihan()
    {
        $notifikasi = $this->notifikasiModel->notifikasiBylevelSek();
        $notif_count = $this->notifikasiModel->countNotifikasiBylevelSek();
        $allNotifikasi = $this->notifikasiModel->allNotifikasiByLevelSek();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | KOPMENSYAPA",
            'notifikasi' => $notifikasi,
            'notif' => $notif_count,
            'allnotifikasi' => $allNotifikasi,
            'judul'     => 'Tagihan Bulanan',
            'menu'      => 'tagihan',
            'submenu' => '',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'sekretaris/daftar-tagihan',

        ];

        return view('layout/tamplate-admin', $data);
    }

    
}
