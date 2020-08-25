<div>

    <h3>Pendaftaran Pemeriksaan Klinik</h3>
    <br>
    <div class="container">
        <form action="/landing/pendaftaranPemeriksaan" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- mengatasi menigisi form diluar dari halaman -->
            <div class="form-group row">
                <label for="no_member" class="col-sm-2 col-form-label">No Member</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control " id="no_member" name='no_member' autofocus value="<?= session()->get('no_member') ?>" disabled>

                </div>
            </div>
            <div class="form-group row">
                <label for="nip" class="col-sm-2 col-form-label">Dokter</label>
                <div class="col-sm-10">
                    <select name="id_dokter" id="id_dokter" class="form-control">
                        <option value="">Pilih dokter</option>
                        <?php foreach ($dokter as $d) : ?>

                            <option value="<?= $d['id']; ?>"><?= $d['nama_dokter']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_periksa" class="col-sm-2 col-form-label ">Tanggal Periksa</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control <?= ($validation->hasError('tgl_periksa')) ? 'is-invalid' : '' ?>" id="tgl_periksa" name='tgl_periksa' autofocus value="<?= old('tgl_periksa'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tgl_periksa'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="biaya" class="col-sm-2 col-form-label">Biaya</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="biaya" name='biaya' autofocus value="50000">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Dokter</th>
                    <th scope="col">Tgl Periksa</th>
                    <th scope="col">Biaya</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($pendaftaranPemeriksaan as $pp) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $pp['nip']; ?> | <?= $pp['nama_dokter']; ?></td>
                        <td><?= $pp['tgl_periksa']; ?></td>
                        <td><?= $pp['biaya']; ?></td>
                        <td><?php if ($pp['status_pemeriksaan'] == 'BELUM MEMBAYAR') : ?>
                                <a href="/<?= $pp['id']; ?>" class="btn-confirm" data-toggle="modal" data-target="#newKonfiramsiModal" data-id="<?= $pp['id']; ?>"><u><?= $pp['status_pemeriksaan']; ?></u></a>
                            <?php else : ?>
                                <?= $pp['status_pemeriksaan']; ?>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>


<!-- Konfirmasi Modal -->
<div class="modal fade" id="newKonfiramsiModal" tabindex="-1" role="dialog" aria-labelledby="newKonfiramsiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKonfiramsiModalLabel">Konfiramsi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/landing/memberConfirm/" method="post" enctype="multipart/form-data">
                    <input type="text" name="callId" class="callId">

                    <?= csrf_field(); ?>
                    <!-- mengatasi menigisi form diluar dari halaman -->
                    <div class="form-group row">

                        <label for="no_member" class="col-sm-2 col-form-label">No Member</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control " id="no_member" name='no_member' value="<?= session()->get('no_member') ?>" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_pemeriksaan" class="col-sm-2 col-form-label">Id Pemeriksaan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control " id="id_pemeriksaan" name='id_pemeriksaan' value='<?= $id_pemeriksaan ?>' disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="imgKonfirmasi" class="col-sm-2 col-form-label">File Konfirmasi</label>
                        <div class="col-sm-2">
                            <img src="/img/konfirmasi/default.png" class="img-thumbnail img-preview">
                        </div>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?= ($validation->hasError('imgKonfirmasi')) ? 'is-invalid' : '' ?>" id="imgKonfirmasi" name="imgKonfirmasi" onchange="previewImg()">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('imgKonfirmasi'); ?>
                                </div>
                                <label class="custom-file-label" for="imgKonfirmasi">Pilih Gambar..</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ">Add Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>