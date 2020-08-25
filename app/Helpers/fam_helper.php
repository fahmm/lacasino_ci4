<?php



function check_access($role_id, $menu_id)
{
    $db      = \Config\Database::connect();
    $builder = $db->table('user_access_menu');

    $builder->where('role_id', $role_id);
    $builder->where('menu_id', $menu_id);
    $result = $builder->get();

    if ($result->getRowArray() > 0) {
        return "checked='checked'";
    }
}
