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
	<title><?= $title; ?></title>
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
		<div class="container">
			<div class="row">
				<div class="col-9">
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">HOME</a>
							<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">PROFILE KLINIK</a>
							<a class="nav-item nav-link" id="nav-galeri-tab" data-toggle="tab" href="#nav-galeri" role="tab" aria-controls="nav-galeri" aria-selected="false">GALERI</a>
							<a class="nav-item nav-link" id="nav-dokter-tab" data-toggle="tab" href="#nav-dokter" role="tab" aria-controls="nav-dokter" aria-selected="false">DOKTER KAMI</a>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active mt-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
							<?php
							include("home.php");
							?>
						</div>
						<div class="tab-pane fade mt-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
							<?php
							include("profil.php");
							?>
						</div>
						<div class="tab-pane fade mt-3" id="nav-galeri" role="tabpanel" aria-labelledby="nav-galeri-tab">
							<?php
							include("galeri.php");
							?>

						</div>
						<div class="tab-pane fade mt-3" id="nav-dokter" role="tabpanel" aria-labelledby="nav-dokter-tab">
							<?php
							include("dokter.php");
							?>
						</div>
					</div>
				</div>
				<div class="col-3">
					<ul style="list-style-type: none;">
						<?php if (session()->getFlashdata('msg')) : ?>
							<div class="alert <?= session()->getFlashdata('msg_alert'); ?>" role="alert">
								<?= session()->getFlashdata('msg'); ?>
							</div>
						<?php endif ?>

						<li>
							<?php
							include("afterLogin.php");
							?>
						</li>

						<br>
						<li>
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