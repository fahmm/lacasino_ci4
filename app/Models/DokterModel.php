<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table = 'tbl_dokter';
    // protected $useTimestamps = true;
    protected $allowedFields = ['nama_dokter', 'nip', 'spesialis', 'no_hp', 'jadwal'];

    public function getDokter($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getDokterById($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
