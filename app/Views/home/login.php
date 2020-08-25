<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" aria-selected="true">Login</a>
  </div>
</nav>
<form class="user mt-4" method="post" action="/landing">
  <div class="form-group">
    <input type="text" class="form-control form-control-user <?php if (isset($validation)) : ?><?= ($validation->hasError('username')) ? 'is-invalid' : '' ?><?php endif; ?>" id="username" name="username" placeholder="Enter username...">
    <div class=" invalid-feedback">
      <?php if (isset($validation)) : ?><?= $validation->getError('username'); ?><?php endif; ?>
    </div>
  </div>
  <div class="form-group">
    <input type="password" class="form-control form-control-user <?php if (isset($validation)) : ?><?= ($validation->hasError('password')) ? 'is-invalid' : '' ?><?php endif; ?>" id="password" name="password" placeholder="Password">
    <div class=" invalid-feedback">
      <?php if (isset($validation)) : ?><?= $validation->getError('password'); ?><?php endif; ?>
    </div>
  </div>
  <button type="submit" class="btn btn-primary btn-user btn-block">
    Login
  </button>
  <a href="landing/memberRegister">Register</a>
  <hr>

</form>