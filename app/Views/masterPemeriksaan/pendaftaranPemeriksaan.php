<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="col-6 bg-light">
        <form action="/masterPemeriksaan/" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- mengatasi menigisi form diluar dari halaman -->
            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert <?= session()->getFlashdata('msg_alert'); ?>" role="alert">
                    <?= session()->getFlashdata('msg'); ?>
                </div>
            <?php endif ?>
            <div class="form-group row">
                <label for="no_member" class="col-sm-2 col-form-label">No Member</label>
                <div class="col-sm-10">
                    <select name="no_member" id="no_member" class="form-control">
                        <option value="">Pilih Member</option>
                        <?php foreach ($member as $m) : ?>

                            <option value="<?= $m['no_member']; ?>"><?= $m['no_member']; ?> | <?= $m['nama_member']; ?> </option>
                        <?php endforeach; ?>
                    </select>

                </div>
            </div>
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
                <label for="biaya" class="col-sm-2 col-form-label">Biaya</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="biaya" name='biaya' autofocus value="50000">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Member</th>
                    <th scope="col">Dokter</th>
                    <th scope="col">Tgl Periksa</th>
                    <th scope="col">Biaya</th>
                    <th scope="col">Status</th>
                    <th scope="col">No Antrian</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($pendaftaranPemeriksaan as $pp) : ?>
                    <?php if ($pp['status_pemeriksaan'] == 'BELUM MEMBAYAR') : ?>
                        <tr>
                            <th scope="row"></th>
                            <td> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $pp['nama_member']; ?></td>
                            <td><?= $pp['nama_dokter']; ?></td>
                            <td><?= $pp['tgl_periksa']; ?></td>
                            <td><?= $pp['biaya']; ?></td>
                            <td><a href="../masterPemeriksaan/pageImg/<?= $pp['id_pemeriksaan']; ?>"><?= $pp['status_pemeriksaan']; ?></a></td>
                            <td><?= $pp['no_antrian']; ?></td>
                            <td><a href="../masterPemeriksaan/setuju/<?= $pp['id_pemeriksaan']; ?>/<?= $pp['id_dokter']; ?>/<?= $pp['tgl_periksa']; ?>" onclick="return confirm('anda yakin?')">Setujui</a></td>
                        </tr>
                    <?php endif ?>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?= $this->endSection(); ?>