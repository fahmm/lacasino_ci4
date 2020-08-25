<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="col-6 bg-light">
        <form action="/masterData/tambahDokter" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- mengatasi menigisi form diluar dari halaman -->
            <div class="form-group row">
                <label for="nama_dokter" class="col-sm-2 col-form-label">Nama Dokter</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama_dokter')) ? 'is-invalid' : '' ?>" id="nama_dokter" name='nama_dokter' autofocus value="<?= old('nama_dokter'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_dokter'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="nip" class="col-sm-2 col-form-label">Nip</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nip')) ? 'is-invalid' : '' ?>" id="nip" name='nip' autofocus value="<?= old('nip'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nip'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="spesialis" class="col-sm-2 col-form-label">Spesialis</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="spesialis" name='spesialis' autofocus value="<?= old('spesialis'); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_hp" name='no_hp' autofocus value="<?= old('no_hp'); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="jadwal" class="col-sm-2 col-form-label">Jadwal</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jadwal" name='jadwal' autofocus value="<?= old('jadwal'); ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </div>

        </form>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?= $this->endSection(); ?>