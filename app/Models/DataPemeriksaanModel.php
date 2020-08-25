<?php

namespace App\Models;

use CodeIgniter\Model;

class DataPemeriksaanModel extends Model
{

    protected $table = 'tbl_pemeriksaan';
    // protected $useTimestamps = true;
    protected $allowedFields = ['id_dokter', 'tgl_periksa', 'status'];

    public function search($keyword = false)
    {
        return $this->like('tgl_periksa', $keyword);
    }
}
