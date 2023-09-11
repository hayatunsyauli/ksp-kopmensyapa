<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KasUraianModel;
use App\Models\KasModel;
use App\Models\NotifikasiModel;
use App\Models\ProfilKopModel;

class Kas extends BaseController {

    protected $kasModel;
    protected $kasuraianModel;
    protected $notifikasiModel;
    protected $profilKopM;
    
    public function __construct(){
        
        helper('numberHelper');

        $this->kasModel       = new KasModel();
        $this->kasuraianModel = new KasUraianModel();
        $this->notifikasiModel= new NotifikasiModel();
        $this->profilKopM = new ProfilKopModel();
    }

    public function index()
    {
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop']." | Kas Koperasi",
            'judul'     => '',
            'menu'      => 'kas',
            'menu2' => '',
            'submenu'   => 'kas-rekap',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'kas/index',
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
            'title' => $profilkop['nama_kop']." | Kas Debet Koperasi",
            'judul'     => '',
            'menu'      => 'kas',
            'menu2' => '',
            'submenu'   => 'kas-debet',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'kas/kas_debit',
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
            'menu2' => '',
            'submenu'   => 'kas-kredit',
            'header'    => 'layout/header',
            'sidemenu'  => 'layout/sidemenu',
            'footer'    => 'layout/footer',
            'page'      => 'kas/kas_credit',
            'uraiann'   => $this->kasuraianModel->findAll(),
            'kas'       => $this->kasModel->getAllKasbyStatusKredit(),
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        
        return view('layout/tamplate-admin',$data);
    }

    public function addCodeUraian() {
        $this->kasuraianModel->insert([
            'code_uraian'  => $this->request->getVar('code_uraian'),
        ]);
        session()->setFlashdata('pesan','Code Account/Uraian berhasil disimpan');
        return redirect()->to('kas');
    }

    public function prosesAddKasDebet() {
        $this->kasModel->insert([
            'uraian'    => $this->request->getVar('uraian'),
            'id_uraian' => $this->request->getVar('id_uraian'),
            'kas_debit' => $this->request->getVar('kasdebet'),
            'ke'        => $this->request->getVar('ke'),
            'kas_credit'=> '',
            'status'    => 'Debet',
            'tanggal_kas'   => $this->request->getVar('tanggal'),
        ]);
        session()->setFlashdata('pesan','Data berhasil disimpan');
        return redirect()->to('kas/kasDebet');
    }

    public function prosesAddKasKredit() {
        $this->kasModel->insert([
            'uraian'    => $this->request->getVar('uraian'),
            'id_uraian' => $this->request->getVar('id_uraian'),
            'kas_credit'=> $this->request->getVar('kaskredit'),
            'ke'        => $this->request->getVar('ke'),
            'kas_debit' => '',
            'status'    => 'Kredit',
            'tanggal_kas'   => $this->request->getVar('tanggal'),
        ]);
        session()->setFlashdata('pesan','Data berhasil disimpan');
        return redirect()->to('kas/kasCredit');
    }

    public function prosesUpdateKasDebet($id_kas){
        $this->kasModel->save([
            'id_kas'    => $id_kas,
            'uraian'    => $this->request->getVar('uraian'),
            'id_uraian' => $this->request->getVar('id_uraian'),
            'kas_debit' => $this->request->getVar('kasdebet'),
            'ke'        => $this->request->getVar('ke'),
            'tanggal_kas'   => $this->request->getVar('tanggal'),

        ]);
        session()->setFlashdata('pesan','Data berhasil diubah');
        return redirect()->to('kas/kasDebet');
    }

    public function prosesUpdateKasKredit($id_kas){
        $this->kasModel->save([
            'id_kas'    => $id_kas,
            'uraian'    => $this->request->getVar('uraian'),
            'id_uraian' => $this->request->getVar('id_uraian'),
            'kas_credit'=> $this->request->getVar('kasdebet'),
            'ke'        => $this->request->getVar('ke'),
            'tanggal_kas'   => $this->request->getVar('tanggal'),

        ]);
        session()->setFlashdata('pesan','Data berhasil diubah');
        return redirect()->to('kas/kasCredit');
    }

    public function deleteDebet($id_kas) {
        $this->kasModel->delete($id_kas);
        session()->setFlashdata('pesan','Data berhasil dihapus!');
        return redirect()->to('kas/kasDebet');
    }
    public function deleteKredit($id_kas) {
        $this->kasModel->delete($id_kas);
        session()->setFlashdata('pesan','Data berhasil dihapus!');
        return redirect()->to('kas/kasCredit');
    }
    
    public function deleteCU($id_uraian) {
        $this->kasuraianModel->delete($id_uraian);
        session()->setFlashdata('pesan','Code Account/Uraian berhasil dihapus!');
        return redirect()->to('kas');
    }

    public function cetakInvoiceKasDebet($id_kas)
    {
        $nominalKas = $this->request->getVar('kasdebet');
        $word = terbilang($nominalKas);
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Kas',
            'menu'      => 'simpanan',
            'menu2' => '',
            'submenu'   => 'simpanan',
            'page'      => 'kas/cetak-invoice-kas-debet',
            'kas'       => $this->kasModel->allDataKas($id_kas),
            'terbilang' => $word,
            'nominalKas'=>$nominalKas,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('/layout-cetak/tamplate', $data);
    }
    public function cetakInvoiceKasKredit($id_kas)
    {
        $nominalKas = $this->request->getVar('kasdebet');
        $word = terbilang($nominalKas);
        $notif_count = $this->notifikasiModel->countnotifikasiBylevelKetu();
        $notifikasi = $this->notifikasiModel->notifikasiBylevelKetu();
        $profilkop = $this->profilKopM->find(1);
        $data = [
            'profilkop' => $profilkop,
            'title' => $profilkop['nama_kop'].' | Kas',
            'menu'      => 'simpanan',
            'menu2' => '',
            'submenu'   => 'simpanan',
            'page'      => 'kas/cetak-invoice-kas-kredit',
            'kas'       => $this->kasModel->allDataKas($id_kas),
            'terbilang' => $word,
            'nominalKas'=>$nominalKas,
            'notif'    => $notif_count,
            'notifikasi' => $notifikasi,
        ];
        return view('/layout-cetak/tamplate', $data);
    }
}
