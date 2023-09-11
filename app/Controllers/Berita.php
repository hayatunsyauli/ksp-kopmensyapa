<?php

namespace App\Controllers;
use App\Models\BeritaModel;
use App\Models\NotifikasiModel;
use App\Models\ProfilKopModel;

class Berita extends BaseController
{
    protected $beritaModel;
    protected $profilKopM;
    protected $notifikasiModel;
    
    public function __construct(){
        $this->beritaModel = new BeritaModel();
        $this->profilKopM = new ProfilKopModel();
        $this->notifikasiModel    = new NotifikasiModel();
    }

    public function index(){

        $post = $this->beritaModel->findAll();
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | List Berita",
            'post' => $post,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'judul' => 'Tambah Berita Baru',
            'menu' => 'berita',
            'submenu' => 'list',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'berita/berita',
        ];

        return view('layout/tamplate-admin',$data);
    }

    //---
    public function viewBerita($slug){
        // $post = 
        $view = $this->beritaModel->getBerita($slug);
        $profilkop = $this->profilKopM->find(1);
        // $data['title'] = ;
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].'KOPMENSYAPA',
            'post'  => $view,
            'menu' => 'berita',
            'submenu' => 'list',
            // 'header'    => 'layout/header',
            // 'sidemenu'  => 'layout/sidemenu',
            // 'footer'    => 'layout/footer',
            // 'page' => 'berita/berita',
        ];

        if (!$data['post']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Berita ' . $slug . ' tidak ditemukan.');
        }
        return view('/berita/detail',$data);
    }


    public function create(){
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." Tambah Berita",
            'validation' => \Config\Services::validation(),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'judul'      => 'Berita Baru',
            'menu'      => 'berita',
            'submenu'   => 'newPost',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'berita/berita_create'
        ];
        return view('layout/tamplate-admin', $data);
    }

// -- Aksi Creates
    public function save(){
        // validasi input

        $validate = $this->validate([
            'judul' => [
                'rules' => 'required|is_unique[post.judul]',
                'errors' => [
                    'required' => 'Tidak Boleh Kosong!',
                    'is_unique' => 'Judul Berita Sudah Ada!',
                ]
            ],
            'kontent' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kontent tidak Boleh Kosong!',
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ]);
        if (!$validate){
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to('/berita/create')->withInput();
        }
        
        // ambil gambar
        $fileprofil = $this->request->getFile('gambar');
        // apakah hana gambe yg di post
        if ($fileprofil->getError() == 4) {
            $namaprofil = 'default.png';
        }else{
            // ambil nama file sampl
            $namaprofil = $fileprofil->getRandomName();
            // pindahkan file ke folder img
            $fileprofil->move('img/berita/',$namaprofil); 
        }

        $slug = url_title($this->request->getVar('judul'), '-', TRUE);
        $this->beritaModel->insert([
            'judul' => $this->request->getVar('judul'),
            'nm_petugas' => session()->get('nama'),
            'kontent' => $this->request->getVar('kontent'),
            'status' => $this->request->getVar('status'),
            'gambar' => $namaprofil,
            'slug' => $slug

        ]);
        session()->setFlashdata('pesan','Berita berhasil ditambahkan');
        return redirect()->to('/berita');
        
    }

    public function delete($id){
        $berita = $this->beritaModel->find($id);

        if ($berita['gambar'] != 'default.png') {
            // hapus gambar
            unlink('img/berita/'.$berita['gambar']);
        }
        $this->beritaModel->delete($id);
        session()->setFlashdata('pesan','Berita berhasil dihapus!');
        return redirect()->to('/berita');
    }

    public function edit($slug){
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." List Berita",
            'judul' => 'Edit Berita Baru',
            'menu' => 'berita',
            'submenu' => 'list',
            'validation' => \Config\Services::validation(),
            'berita' => $this->beritaModel->getBerita($slug),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page' => 'berita/berita_edit',
        ];

        return view('layout/tamplate-admin', $data);
    }

    public function update($id_post){
        // cek judul berita
        $beritaLama = $this->beritaModel->getBerita($this->request->getVar('slug'));
        if ($beritaLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        }else{
            $rule_judul = 'required|is_unique[post.judul]';
        }

        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul Tidak Boleh Kosong!',
                    'is_unique' => 'Judul Berita Sudah Ada!',
                ]
            ],
            'kontent' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kontent tidak Boleh Kosong!',
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,1024]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            session()->setFlashdata('errors',\Config\Services::validation()->getErrors());
            return redirect()->to('/berita/edit/' . $this->request->getVar('slug'))->withInput();
        }
        // ambil gambar
        $fileGambar = $this->request->getFile('gambar');
        // cek gambar
        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambarLama');
        }else{
            // ambil nama file sampl
            $namaGambar = $fileGambar->getRandomName();
            // pindahkan file ke folder img
            $fileGambar->move('img/berita/',$namaGambar);
            // hapus gambar lama
            unlink('img/berita/' . $this->request->getVar('gambarLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', TRUE);
        $this->beritaModel->save([
            'id_post'   => $id_post,
            'judul'     => $this->request->getVar('judul'),
            'nm_petugas'=> session()->get('nama'),
            'kontent'   => $this->request->getVar('kontent'),
            'status'    => $this->request->getVar('status'),
            'gambar'    => $namaGambar,
            'slug'      => $slug

        ]);
        session()->setFlashdata('pesan','Berita Berhasil di Update');
        return redirect()->to('/berita');
    }
   

}
