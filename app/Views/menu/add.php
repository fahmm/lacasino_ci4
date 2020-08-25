<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>


    <form action="/menu/add" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <!-- mengatasi menigisi form diluar dari halaman -->
        <div class="form-group row">
            <label for="judul" class="col-sm-2 col-form-label">Menu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('menu')) ? 'is-invalid' : '' ?>" id="menu" name='menu' autofocus value="<?= old('menu'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('menu'); ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
            </div>
        </div>
    </form>


</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>