<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


    <form action="/menu/editMenu/<?= $menu['id']; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <!-- mengatasi menigisi form diluar dari halaman -->
        <input type="hidden" name="id" value="<?= $menu['id']; ?>">
        <div class="form-group row">
            <div class="col">
                <input type="text" class="form-control  <?= ($validation->hasError('menu')) ? 'is-invalid' : '' ?>" id="menu" name='menu' autofocus value="<?= $menu['menu']; ?>" placeholder="menu">
                <div class="invalid-feedback">
                    <?= $validation->getError('menu'); ?>
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