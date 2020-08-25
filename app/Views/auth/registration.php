<?= $this->extend('template/auth_template'); ?>
<?= $this->section('content'); ?>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post" action="/auth/registration">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user <?php if (isset($validation)) : ?><?= ($validation->hasError('name')) ? 'is-invalid' : '' ?><?php endif; ?>" id="name" name="name" placeholder="full name" value="<?= set_value('name') ?>" />
                                    <div class=" invalid-feedback">
                                        <?php if (isset($validation)) : ?><?= $validation->getError('name'); ?><?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user <?php if (isset($validation)) : ?><?= ($validation->hasError('email')) ? 'is-invalid' : '' ?><?php endif; ?>" id="email" name="email" placeholder="Email Address" value="<?= set_value('email') ?>" />
                                    <div class=" invalid-feedback">
                                        <?php if (isset($validation)) : ?><?= $validation->getError('email'); ?><?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user <?php if (isset($validation)) : ?><?= ($validation->hasError('password1')) ? 'is-invalid' : '' ?><?php endif; ?>" id="password1" name="password1" placeholder="Password">
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
                                    Register Account
                                </button>
                            </form>
                            <hr />
                            <div class="text-center">
                                <a class="small" href="/auth/forgotPassword">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="/">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>