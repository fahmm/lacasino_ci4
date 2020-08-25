<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


    <form action="/menu/editSubmenu/<?= $subMenu['id']; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <!-- mengatasi menigisi form diluar dari halaman -->
        <input type="hidden" name="id" value="<?= $subMenu['id']; ?>">
        <div class="form-group row">
            <div class="col">
                <input type="text" class="form-control  <?= ($validation->hasError('title')) ? 'is-invalid' : '' ?>" id="title" name='title' autofocus value="<?= $subMenu['title']; ?>" placeholder="title">
                <div class="invalid-feedback">
                    <?= $validation->getError('title'); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <select name="menu_id" id="menu_id" class="form-control">
                    <option value="">Select Menu</option>
                    <?php foreach ($menus as $m) : ?>
                        <?php if ($m['id'] == $subMenu['menu_id']) : ?>
                            <option value="<?= $m['id']; ?>" selected><?= $m['menu']; ?></option>
                        <?php else : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <input type="text" class="form-control" id="url" name='url' value="<?= $subMenu['url']; ?>" placeholder="Submenu url">
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <input type="text" class="form-control" id="icon" name='icon' value="<?= $subMenu['icon']; ?>" placeholder="Submenu icon">
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name='is_active' value="1" checked>
                    <label class="form-check-label" for="is_active">Active?</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary ">Edit Data</button>

        </div>
    </form>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>