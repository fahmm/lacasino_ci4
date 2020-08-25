<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmenuModel extends Model
{
    protected $table = 'user_sub_menu';
    // protected $useTimestamps = true;
    protected $allowedFields = ['title', 'menu_id', 'url', 'icon', 'is_active'];

    public function getsubMenu()
    {
        $db = db_connect();

        $querySubMenu = "Select `user_menu`.`id`, `menu` , `user_sub_menu`.*
        from `user_menu` join `user_sub_menu` 
        on `user_menu`.`id` = `user_sub_menu`.`menu_id`
        
        ";
        return $db->query($querySubMenu)->getResultArray();
    }

    public function getSubmenuById($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
