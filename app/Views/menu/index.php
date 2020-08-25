<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <a href="/menu/addMenu?>" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">add new menu</a>
            <?php if (session()->getFlashdata('msg')) : ?>
                <div class="alert <?= session()->getFlashdata('msg_alert'); ?>" role="alert">
                    <?= session()->getFlashdata('msg'); ?>
                </div>
            <?php endif ?>
            <?php if (isset($validation)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $validation->listErrors(); ?>
                </div>
            <?php endif; ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menus as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $m['menu']; ?></td>
                            <td>
                                <a href="/menu/editM/<?= $m['id']; ?>" class="badge badge-warning">Edit</a>
                                <a href="/menu/deleteMenu/<?= $m['id']; ?>" class="badge badge-danger " onclick="return confirm('yakin?')">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>



</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


<!-- Add Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/menu" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <!-- mengatasi menigisi form diluar dari halaman -->
                    <div class="form-group row">
                        <label for="Menu" class="col-sm-2 col-form-label">Menu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="menu" name='menu' autofocus value="<?= old('menu'); ?>">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ">Add Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>