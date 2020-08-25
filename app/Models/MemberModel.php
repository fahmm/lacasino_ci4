<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table = 'tbl_member';
    // protected $useTimestamps = true;
    protected $allowedFields = ['nama_member', 'no_member', 'alamat', 'jenkel', 'usia', 'pekerjaan', 'status', 'no_hp', 'status_member', 'username', 'password', 'status_login', 'role_id'];

    public function getMember($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getMemberById($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function updateMemberStatus($id)
    {
        $newdata = [
            'status_member' => 'aktif',
            'role_id' => 5
        ];
        $db      = \Config\Database::connect();
        $builder = $db->table('tbl_member');
        $builder->set($newdata);
        $builder->where('id', $id);
        $builder->update();
    }
}
