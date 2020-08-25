<div>
	<p>
		<h3>Profile Klinik</h3>
		<br>
		<?php foreach ($kantor as $k) : ?>
			<div class="container">

				<h4 class="card-title text-dark"><?= $k['nama_kantor']; ?></h4>

				<h5 class="card-title my-0 mt-2 text-dark">Contact</h5>
				<p class="card-text my-0">Alamat : <?= $k['alamat']; ?></p>
				<p class="card-text my-0">Telepon : <?= $k['tlp']; ?></p>
				<p class="card-text my-0">Fax : <?= $k['fax']; ?></p>
				<p class="card-text my-0">Kode Pos : <?= $k['kode_pos']; ?></p>
				<p class="card-text my-0">Email : <?= $k['email']; ?></p>

				<h5 class="card-title mt-4 mb-0 text-dark">Pimpinan</h5>
				<p class="card-text my-0"><?= $k['direktur']; ?></p>
				<p class="card-text my-0"><small class="text-muted">NIP : <?= $k['nip_direktur']; ?></small></p>
			</div>
		<?php endforeach ?>


	</p>
</div>