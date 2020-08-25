<?= $this->extend('template/page_template'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="card mb-3 col-lg-8 py-3">
        <div class="row no-gutters">
            <form action="/user/editProfile/" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="imageLama" value="<?= $user['image']; ?>">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="text">first name</label>
                            <input type="text" class="form-control" id="name" name='name' value="<?= set_value('name', $user['name']) ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="image">image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input form-control" id="image" name="image" onchange="previewImg()">
                                <label class="custom-file-label" for="image"><?= $user['image']; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <img src="../assets/img/user/<?= $user['image']; ?>" class="img-thumbnail img-preview">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" class="form-control" id="email" readonly value="<?= $user['email'] ?>">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" class="form-control" id="password" name='password' value="">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group">
                            <label for="confirm_password">confirm password</label>
                            <input type="password" class="form-control" id="confirm_password" name='confirm_password' value="">
                        </div>
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

                <div class="form-group row">
                    <div class="col-12 col-sm-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>