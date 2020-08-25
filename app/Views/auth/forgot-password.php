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
                                    <h1 class="h4 text-gray-900 mb-4">forgot your password?</h1>
                                </div>
                                <?php if (session()->getFlashdata('msg')) : ?>
                                    <div class="alert <?= session()->getFlashdata('msg_alert'); ?>" role="alert">
                                        <?= session()->getFlashdata('msg'); ?>
                                    </div>
                                <?php endif ?>
                                <form class="user" method="post" action="/auth/forgotPassword">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user <?php if (isset($validation)) : ?><?= ($validation->hasError('email')) ? 'is-invalid' : '' ?><?php endif; ?>" id="email" name="email" placeholder="Enter Email Address...">
                                        <div class=" invalid-feedback">
                                            <?php if (isset($validation)) : ?><?= $validation->getError('email'); ?><?php endif; ?>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset Password
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