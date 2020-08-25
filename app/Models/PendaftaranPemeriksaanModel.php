<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranPemeriksaanModel extends Model
{
    protected $table = 'tbl_pendaftaran_pemeriksaan';
    // protected $useTimestamps = true;
    protected $allowedFields = ['no_member', 'id_dokter', 'tgl_periksa', 'status_pemeriksaan', 'biaya', 'no_antrian', 'id_pemeriksaan'];

    public function getPemeriksaan($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['no_member' => $id])->first();
    }

    public function updateNoAntrian($id_pemeriksaan, $no_antrian)
    {
        $newdata = [
            'no_antrian' => $no_antrian,
            'status_pemeriksaan' => 'antri',
        ];
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_pendaftaran_pemeriksaan');
        $builder->set($newdata);
        $builder->where('id_pemeriksaan', $id_pemeriksaan);
        $builder->update();
    }

    public function show()
    {
        return $this->table('tbl_pendaftaran_pemeriksaan')->select('*')->join('tbl_dokter', 'tbl_pendaftaran_pemeriksaan.id_dokter = tbl_dokter.id')->join('tbl_member', 'tbl_pendaftaran_pemeriksaan.no_member = tbl_member.no_member')->orderBy('no_antrian', 'ASC');
    }

    public function search($keyword = false)
    {
        return $this->table('tbl_pendaftaran_pemeriksaan')->select('*')->join('tbl_dokter', 'tbl_pendaftaran_pemeriksaan.id_dokter = tbl_dokter.id')->join('tbl_member', 'tbl_pendaftaran_pemeriksaan.no_member = tbl_member.no_member')->orderBy('no_antrian', 'ASC')->like('tgl_periksa', $keyword);
    }
}
