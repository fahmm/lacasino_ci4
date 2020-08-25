<?php

namespace App\Models;

use CodeIgniter\Model;

class KantorModel extends Model
{
    protected $table = 'tbl_kantor';
    protected $allowedFields = ['nama_kantor', 'direktur', 'nip_direktur', 'alamat', 'tlp', 'fax', 'kode_pos', 'email'];
    protected $useTimestamps = true;
}
