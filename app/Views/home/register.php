<!DOCTYPE html>
<html>

<head>
  <title>Klinik Lacasino</title>
  <!-- CSS only -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

  <style>
    html,
    body {
      height: 100%;
    }

    #page-content {
      flex: 1 0 auto;
    }
  </style>
</head>

<body class="d-flex flex-column">

  <div id="page-content">
    <div style="background-color:#cc3433;text-align:center;">
      <img src="../img/landing/header_bg.jpg">
    </div>
    <div class="container mt-3">
      <div class="row">
        <div class="col-9">
          <h3>Register Data Member Pasien</h3>
          <form action="/landing/memberRegister" method="post" enctype="multipart/form-data" class="mb-4">
            <?= csrf_field(); ?>
            <!-- mengatasi menigisi form diluar dari halaman -->
            <div class="form-group row">
              <label for="nama_member" class="col-sm-2 col-form-label">Nama Member</label>
              <div class="col-sm-10">
                <input type="text" class="form-control <?= ($validation->hasError('nama_member')) ? 'is-invalid' : '' ?>" id="nama_member" name='nama_member' autofocus value="<?= old('nama_member'); ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('nama_member'); ?>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="no_member" class="col-sm-2 col-form-label">No Member</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="no_member" name='no_member' value="<?= $no_member ?>" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat" name='alamat' value="<?= old('alamat'); ?>">
              </div>
            </div>
            <div class="form-group row ">
              <label for="jenkel" class="col-sm-2 col-form-label">Jenis Kelamin</label>
              <div class="col-sm-10">
                <select class="form-control" id="jenkel" name="jenkel">
                  <option value="">Pilih</option>
                  <option value="Laki Laki">Laki Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="usia" class="col-sm-2 col-form-label">Usia</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="usia" name='usia' value="<?= old('usia'); ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="pekerjaan" name='pekerjaan' value="<?= old('pekerjaan'); ?>">
              </div>
            </div>
            <div class="form-group row">
              <label for="status" class="col-sm-2 col-form-label">Status Perkawinan</label>
              <div class="col-sm-10">
                <select class="form-control" id="status" name="status">
                  <option value="">Pilih</option>
                  <option value="Belum Kawin">Belum Kawin</option>
                  <option value="Sdh Kawin">Sdh Kawin</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="no_hp" class="col-sm-2 col-form-label">No HP</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="no_hp" name='no_hp' value="<?= old('no_hp'); ?>">
              </div>
            </div>
            <hr>
            <div class="border mx-2 p-2 pt-3 my-4">
              <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="username" name='username' value="<?= old('username'); ?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name='password' value="<?= old('password'); ?>">
                </div>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </div>
            <a href="/landing">back to home</a>
          </form>
        </div>
        <div class="col-3">
          <ul style="list-style-type: none;">
            <li class="mt-4">
              <?php
              include("clock.php");
              ?>
            </li>
          </ul>

        </div>
      </div>
    </div>
  </div>


  <div style="background-color:#cc3433;text-align:center;color:white;padding:15px;flex-shrink: none;">
    <h4>FamDev 2020 &copy;</h4>
  </div>

  <!-- <footer style="background-color:#cc3433;text-align:center;color:white;padding:15px;flex-shrink: none;">
		<div class="container text-center">
			<h4>FamDev 2020 &copy;</h4>
		</div>
	</footer> -->

</body>

</html>