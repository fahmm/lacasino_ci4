<div class="table-responsive">
	<table class="table">
		<tr>
			<th>Nama Dokter</th>
			<th>Spesialis</th>
			<th>Jam praktek</th>
		</tr>
		<?php foreach ($dokter as $d) : ?>
			<tr>
				<td><?= $d['nama_dokter']; ?></td>
				<td><?= $d['spesialis']; ?></td>
				<td><?= $d['jadwal']; ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>