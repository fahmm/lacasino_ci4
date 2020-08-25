<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col">
            <a href="/masterData/tambahDokter" class="btn btn-primary mt-3">Tambah Dokter</a>
            <h1 class="mt-2">Daftar Dokter</h1>
            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert <?= session()->getFlashdata('msg_alert'); ?>" role="alert">
                    <?= session()->getFlashdata('msg'); ?>
                </div>
            <?php endif ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama <br> Nip</th>
                        <th scope="col">Sepesialis</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Jadwal Praktek</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($dokter as $d) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $d['nama_dokter']; ?> <br> <?= $d['nip']; ?> </td>
                            <td><?= $d['spesialis']; ?></td>
                            <td><?= $d['no_hp']; ?></td>
                            <td><?= $d['jadwal']; ?></td>
                            <td>
                                <a href="/masterData/editDktr/<?= $d['id']; ?>" class="badge badge-warning">Edit</a>
                                <a href="/masterData/deleteDokter/<?= $d['id']; ?>" class="badge badge-danger " onclick="return confirm('yakin?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>