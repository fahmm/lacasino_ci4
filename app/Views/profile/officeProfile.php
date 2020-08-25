<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card mb-3 ml-4 pl-4" style="max-width: 340px;">
        <div class="container py-3">

            <h4 class="card-title text-dark"><?= $kantor['nama_kantor']; ?></h4>

            <h5 class="card-title my-0 mt-2 text-dark">Contact</h5>
            <p class="card-text my-0">Alamat : <?= $kantor['alamat']; ?></p>
            <p class="card-text my-0">Telepon : <?= $kantor['tlp']; ?></p>
            <p class="card-text my-0">Fax : <?= $kantor['fax']; ?></p>
            <p class="card-text my-0">Kode Pos : <?= $kantor['kode_pos']; ?></p>
            <p class="card-text my-0">Email : <?= $kantor['email']; ?></p>

            <h5 class="card-title mt-4 mb-0 text-dark">Pimpinan</h5>
            <p class="card-text my-0"><?= $kantor['direktur']; ?></p>
            <p class="card-text my-0"><small class="text-muted">NIP : <?= $kantor['nip_direktur']; ?></small></p>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>