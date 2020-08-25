<?= $this->extend('template/auth_template'); ?>
<?= $this->section('content'); ?>

<body class="bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->

                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 ">Change your password for</h1>
                                    <h5 class="mb-4"><?= session()->get('reset_email'); ?></h5>
                                </div>
                                <?php if (session()->getFlashdata('msg')) : ?>
                                    <div class="alert <?= session()->getFlashdata('msg_alert'); ?>" role="alert">
                                        <?= session()->getFlashdata('msg'); ?>
                                    </div>
                                <?php endif ?>
                                <form method="post" action="/auth/changePassword">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user <?php if (isset($validation)) : ?><?= ($validation->hasError('password1')) ? 'is-invalid' : '' ?><?php endif; ?>" id="password1" name="password1" placeholder="Enter New Password">
                                            <div class=" invalid-feedback">
                                                <?php if (isset($validation)) : ?><?= $validation->getError('password1'); ?><?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user <?php if (isset($validation)) : ?><?= ($validation->hasError('password2')) ? 'is-invalid' : '' ?><?php endif; ?>" id="password2 " name="password2" placeholder="Repeat Password" />
                                            <div class=" invalid-feedback">
                                                <?php if (isset($validation)) : ?><?= $validation->getError('password2'); ?><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Change Password
                                    </button>
                                    <hr>

                                </form>
                                <div class="text-center">
                                    <a class="small" href="/auth">Back to login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <?= $this->endSection(); ?>