<?php

namespace App\Models;

use CodeIgniter\Model;

class KasUraianModel extends Model
{
    protected $table = 'kas_uraian';
    protected $primaryKey ='id_uraian';
    protected $allowedFields = ['id_uraian','code_uraian'];

}
