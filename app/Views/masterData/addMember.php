<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="col-6 bg-light">
        <form action="/masterData/tambahMember" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- mengatasi menigisi form diluar dari halaman -->
            <div class="form-group row">
                <label for="nama_member" class="col-sm-2 col-form-label">Nama Member</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control <?= ($validation->hasError('nama_member')) ? 'is-invalid' : '' ?>" id="nama_member" name='nama_member' autofocus value="<?= old('nama_member'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_member'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="no_member" class="col-sm-2 col-form-label">No Member</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_member" name='no_member' value="<?= $no_member ?>" disabled>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name='alamat' value="<?= old('alamat'); ?>">
                </div>
            </div>
            <div class="form-group row ">
                <label for="jenkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <select class="form-control" id="jenkel" name="jenkel">
                        <option value="">Pilih</option>
                        <option value="Laki Laki">Laki Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="usia" class="col-sm-2 col-form-label">Usia</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="usia" name='usia' value="<?= old('usia'); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pekerjaan" name='pekerjaan' value="<?= old('pekerjaan'); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status Perkawinan</label>
                <div class="col-sm-10">
                    <select class="form-control" id="status" name="status">
                        <option value="">Pilih</option>
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Sdh Kawin">Sdh Kawin</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="no_hp" name='no_hp' value="<?= old('no_hp'); ?>">
                </div>
            </div>
            <hr>
            <div class="border mx-2 p-2 pt-3 my-4">
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="username" name='username' value="<?= old('username'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name='password' value="<?= old('password'); ?>">
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
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?= $this->endSection(); ?>