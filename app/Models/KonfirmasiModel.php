<?php

namespace App\Models;

use CodeIgniter\Model;

class KonfirmasiModel extends Model
{
    protected $table = 'tbl_konfirmasi';
    // protected $useTimestamps = true;
    protected $allowedFields = ['no_member', 'id_pemeriksaan', 'file'];

    public function getKonfirmasi($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getKonfirmasiById($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function updateKonfirmasiStatus($id, $id_pemeriksaan)
    {
        $newdata = [
            'status_pemeriksaan' => 'ok',
            'id_pemeriksaan' => $id_pemeriksaan,
        ];
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_pendaftaran_pemeriksaan');
        $builder->set($newdata);
        $builder->where('id', $id);
        $builder->update();
    }
}
