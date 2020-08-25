<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col">
            <a href="/masterData/tambahMember" class="btn btn-primary mt-3">Tambah Member</a>
            <h1 class="mt-2">Master Data Member</h1>
            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert <?= session()->getFlashdata('msg_alert'); ?>" role="alert">
                    <?= session()->getFlashdata('msg'); ?>
                </div>
            <?php endif ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Member <br> Nomor Member</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Usia</th>
                        <th scope="col">Pekerjaan</th>
                        <th scope="col">Status Perkawinan</th>
                        <th scope="col">No Hp</th>
                        <th scope="col">Status Member</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($member as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $m['nama_member']; ?> <br> <a href=""><?= $m['no_member']; ?></a> </td>
                            <td><?= $m['alamat']; ?></td>
                            <td><?= $m['jenkel']; ?></td>
                            <td><?= $m['usia']; ?></td>
                            <td><?= $m['pekerjaan']; ?></td>
                            <td><?= $m['status']; ?></td>
                            <td><?= $m['no_hp']; ?></td>
                            <td><?php if ($m['role_id'] == 5) : ?>
                                    <?= $m['status_member']; ?>
                                <?php else : ?>
                                    <a href="/masterData/memberConfirm/<?= $m['id']; ?>" onclick="return confirm('yakin?')"><?= $m['status_member']; ?></a>
                                <?php endif ?>
                            </td>
                            <td>
                                <a href="/masterData/editMmbr/<?= $m['id']; ?>" class="badge badge-warning">Edit</a>
                                <a href="/masterData/deleteMember/<?= $m['id']; ?>" class="badge badge-danger " onclick="return confirm('yakin?')">Delete</a>
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