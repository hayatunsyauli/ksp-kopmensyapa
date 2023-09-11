<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilKopModel extends Model
{
    protected $table = 'profil_kop';
    protected $allowedFields = ['nama_kop','alamat_kop','gambar_highlight1','gambar_highlight2','email_kop','logo_kop','logo_footer'];
}
