<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card mb-3 col-lg-8 py-3">
        <div class="row no-gutters">
            <form action="/user/editProfile/" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <!-- mengatasi menigisi form diluar dari halaman -->
                <input type="hidden" name="id" value="<?= $user['id']; ?>">
                <input type="hidden" name="imageLama" value="<?= $user['image']; ?>">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name='name' value="<?= set_value('name', $user['name']) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="email" readonly value="<?= $user['email'] ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-2">
                        <img src="../img/user/<?= $user['image']; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <!-- <input type="text" class="form-control" id="sampul" name='sampul' value="<?= old('sampul'); ?>">
                        </div> -->
                        <div class="custom-file">
                            <input type="file" class="custom-file-input form-control" id="image" name="image" onchange="previewImg()">
                            <label class="custom-file-label" for="image"><?= $user['image']; ?></label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="currentPassword" class="col-sm-2 col-form-label">Current Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="currentPassword" name='currentPassword' value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name='password' value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="confirm_password" name='confirm_password' value="">
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
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>