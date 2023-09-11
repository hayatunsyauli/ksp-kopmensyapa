<?php

namespace App\Controllers;
use App\Models\BeritaModel;
use App\Models\ProfilKopModel;

class Home extends BaseController
{
    protected $beritaModel;
    protected $profilKopM;
    
    public function __construct(){
        $this->beritaModel = new BeritaModel();
        $this->profilKopM = new ProfilKopModel();
    }

    public function index(){
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'menu' => 'home',
            'beritaBaru' => $this->beritaModel->where('status', 'published')->orderBy('id_post','DESC')->paginate(3),
            'pager' => $this->beritaModel->pager,

        ];
        return view('home',$data);
    }

    public function berita(){
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'menu' => 'berita',
            'beritaBaru' => $this->beritaModel->where('status', 'published')->orderBy('id_post','DESC')->paginate(5),
            'pager' => $this->beritaModel->pager,
        ];
        return view('berita', $data);
    }

    public function berita_single($slug){
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'],
            'menu' => 'berita',
            'post'=> $this->beritaModel->getBerita($slug),
        ];
        if (!$data['post']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Berita ' . $slug . ' tidak ditemukan.');
        }
        return view('berita-single',$data);
    }
}