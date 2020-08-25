<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card mb-3 col-lg-6 py-3">

        <form action="/admin/editOfficeProfile/" method="post">
            <?= csrf_field(); ?>
            <!-- mengatasi menigisi form diluar dari halaman -->
            <input type="hidden" name="id" value="<?= $kantor['id']; ?>">
            <div class="form-group row">
                <label for="nama_kantor" class="col-sm-2 col-form-label">Nama Klinik</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_kantor" name='nama_kantor' value="<?= set_value('nama_kantor', $kantor['nama_kantor']) ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="direktur" class="col-sm-2 col-form-label">Direktur</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="direktur" name='direktur' value="<?= set_value('direktur', $kantor['direktur']) ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="nip_direktur" class="col-sm-2 col-form-label">NIP Direktur</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nip_direktur" name='nip_direktur' value="<?= set_value('nip_direktur', $kantor['nip_direktur']) ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="alamat" name='alamat' value="<?= set_value('alamat', $kantor['alamat']) ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name='email' value="<?= set_value('email', $kantor['email']) ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="tlp" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tlp" name='tlp' value="<?= set_value('tlp', $kantor['tlp']) ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="fax" class="col-sm-2 col-form-label">Fax</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="fax" name='fax' value="<?= set_value('fax', $kantor['fax']) ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="kode_pos" class="col-sm-2 col-form-label">Kode Pos</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kode_pos" name='kode_pos' value="<?= set_value('kode_pos', $kantor['kode_pos']) ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <?php if (isset($validation)) : ?>
                    <div class="col-12">
                        <div class="alert alert-danger" role="alert">
                            <?= $validation->listErrors(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert ml-2 <?= session()->getFlashdata('msg_alert'); ?>" role="alert">
                        <?= session()->getFlashdata('msg'); ?>
                    </div>
                <?php endif ?>
            </div>
        </form>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>