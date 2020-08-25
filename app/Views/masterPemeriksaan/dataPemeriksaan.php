<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="col-6 bg-light">
        <form action="/masterPemeriksaan/dataPemeriksaan" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- mengatasi menigisi form diluar dari halaman -->
            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert <?= session()->getFlashdata('msg_alert'); ?>" role="alert">
                    <?= session()->getFlashdata('msg'); ?>
                </div>
            <?php endif ?>
            <div class="form-group row">
                <label for="nip" class="col-sm-2 col-form-label">Dokter</label>
                <div class="col-sm-10">
                    <select name="id_dokter" id="id_dokter" class="form-control">
                        <option value="">Pilih dokter</option>
                        <?php foreach ($dokter as $d) : ?>

                            <option value="<?= $d['id']; ?>"><?= $d['nama_dokter']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_periksa" class="col-sm-2 col-form-label ">Tanggal Periksa</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validation->hasError('tgl_periksa')) ? 'is-invalid' : '' ?>" id="tgl_periksa" name='tgl_periksa' autofocus value="<?= old('tgl_periksa'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tgl_periksa'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
        <form action="" method="get">
            <div class="form-group row">
                <div class="input-group col-sm-5">
                    <input type="date" class="form-control" placeholder="Cari" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" name="submit">Cari</button>
                    </div>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Dokter</th>
                    <th scope="col">Tgl Periksa</th>
                    <th scope="col">No Antrian</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ubah Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($pendaftaranPemeriksaan as $pendaftaranPemeriksaan) : ?>
                    <?php if ($pendaftaranPemeriksaan['status_pemeriksaan'] == 'antri') : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $pendaftaranPemeriksaan['nama_dokter']; ?></td>
                            <td><?= $pendaftaranPemeriksaan['tgl_periksa']; ?></td>
                            <td><?= $pendaftaranPemeriksaan['no_antrian']; ?></td>
                            <td>
                                <?= $pendaftaranPemeriksaan['nama_member']; ?>
                            </td>
                            <td><a href="../masterPemeriksaan/pageImg/<?= $pendaftaranPemeriksaan['id_pemeriksaan']; ?>"><?= $pendaftaranPemeriksaan['status_pemeriksaan']; ?></a></td>
                            <td>
                                <? ?>
                            </td>
                        </tr>

                    <?php else : ?>
                        <tr>
                            <th scope="row"></th>
                            <td> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                    <?php endif ?>
                <?php endforeach ?>

            </tbody>
        </table>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?= $this->endSection(); ?>