<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-hospital"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Klinik Lacasino</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Query dari menu -->
    <?php

    $db = db_connect();
    $role_id = session()->get('role_id');
    $queryMenu = "Select `user_menu`.`id`, `menu` 
                from `user_menu` join `user_access_menu` 
                on `user_menu`.`id` = `user_access_menu`.`menu_id`
                where `user_access_menu`.`role_id` = $role_id
                order by `user_access_menu`.`menu_id` ASC
                ";

    $menu = $db->query($queryMenu)->getResultArray();

    ?>

    <!-- Looping Menu -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        <?php
        $db = db_connect();
        $menuId = $m['id'];
        $querySubMenu = "Select * 
                        from `user_sub_menu`  
                        where `user_sub_menu`.`menu_id` = $menuId
                        and `user_sub_menu`.`is_active` = 1
                        ";
        $subMenu = $db->query($querySubMenu)->getResultArray();
        ?>

        <?php foreach ($subMenu as $sm) : ?>
            <!-- submenu -->
            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= $sm['url']; ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
            <?php endforeach; ?>

            <!-- Divider -->
            <hr class="sidebar-divider mt-2" />
        <?php endforeach; ?>

        <li class="nav-item">
            <a class="nav-link" href="" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
</ul>
<!-- End of Sidebar -->