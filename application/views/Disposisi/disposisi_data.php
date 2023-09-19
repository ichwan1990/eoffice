<div class="card">
    <div class="card-header">
        <table class="table">
            <thead>
                <tr>
                    <td>Surat dari :<br><b><?= $surat->pengirim ?></b></td>
                    <td>No. Agenda :<br><b><?= $surat->no_agenda ?></b></td>
                </tr>
                <tr>
                    <td>No. Surat :<br><b><?= $surat->no_surat ?></b></td>
                    <td>Tanggal Diterima :<br><b><?= tgl_indo($surat->tgl_catat) ?></b></td>
                </tr>
                <tr>
                    <td>Tanggal Surat :<br><b><?= tgl_indo($surat->tgl_surat) ?></b></td>
                    <td>Tanggal Selesai :<br><b><?= tgl_indo($surat->tgl_selesai) ?></b></td>
                </tr>
                <tr>
                    <td>Perihal :<br><b><?= $surat->perihal ?></b></td>
                    <td>
                        Sifat / File :<br>
                        <div class="row btn-group">
                            <?php
                            if ($surat->sifat_surat == 'Biasa') {
                                echo '<b><a class="btn btn-sm btn-default">' . $surat->sifat_surat . '</a></b>';
                            } else if ($surat->sifat_surat == 'Segera') {
                                echo '<b><a class="btn btn-sm btn-warning">' . $surat->sifat_surat . '</a></b>';
                            } else if ($surat->sifat_surat == 'Rahasia') {
                                echo '<b><a class="btn btn-sm btn-dark">' . $surat->sifat_surat . '</a></b>';
                            } else if ($surat->sifat_surat == 'Penting') {
                                echo '<b><a class="btn btn-sm btn-danger">' . $surat->sifat_surat . '</a></b>';
                            }
                            ?>
                            <?php
                            if ($surat->file_surat == '') {
                                echo '<i>Tidak ada file yang diupload</i>';
                            } else {
                                echo '<a href="../uploads/surat_masuk/' . $surat->file_surat . '" target="_blank" class="btn btn-sm btn-success no-print">Baca</a>';
                            } ?>
                        </div>
                    </td>
                </tr>
            </thead>
        </table>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
            <div class="btn-group">
                <!-- <input type="text" class="form-control" placeholder=".col-3"> -->
                <?php $t = "History Disposisi"; ?>
                <a href="<?= current_url() . '?h=2' ?>" class="btn btn-sm btn-primary float-left"><?= $t ?></a>
                <!-- </div>
            <div class="col-6 btn-group"> -->
                <!-- <input type="text" class="form-control" placeholder=".col-5"> -->
                <?php
                if ($this->disposisi->cek_ada_disposisi($this->uri->segment('2'))->num_rows() == 0 && $this->session->userdata('level_jabatan') != 0 ) { ?>
                    <a href="<?= site_url('disposisi/' . $this->uri->segment(2) . '/add') ?>" class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i> Tambah Disposisi</a>
                <?php } ?>
                <!-- <input type="text" class="form-control" placeholder=".col-4"> -->
                <a href="<?= site_url('surat_masuk') ?>" class="btn btn-sm btn-dark float-right"><i class="fa fa-angle-left"></i> Kembali</a>
            </div>
            </div>
            <div class="col-md-6">
            <p classs="m-2">*Silahkan <strong>Klik Histori Disposisi</strong> untuk melihat disposisi</p>
            </div>
        </div>
    </div>

    <?php
    $h = @$_GET['h'];
    if ($h != null) {
    ?>
        <div class="card-footer">
            <div class="x_content">
                <table class="table table-bordered" id="data">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Disposisi Oleh</th>
                            <th>Diteruskan Kepada</th>
                            <th>Catatan Disposisi</th>
                            <th class="no-print"><i class="fa fa-gear"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($h == 1) {
                            $row = $this->disposisi->get_disposisi_atasan($this->session->userdata('idjabatan'), $this->uri->segment('2'))->result();
                        } else if ($h == 2) {
                            if ($this->session->userdata('level_user') != 0) {
                                $row = $this->disposisi->get_disposisi_all($this->uri->segment('2'))->result();
                            } else {
                                $row = $this->disposisi->get_disposisi_bawahan($this->session->userdata('idjabatan'), $this->uri->segment('2'))->result();
                            }
                        }
                        foreach ($row as $r => $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data->nama_jabatan ?><br><?= $data->nama_lengkap ?><br><a class="btn btn-xs btn-warning"><?=tgl_indo( $data->tgl_disposisi) ?></a></td>
                                <td>
                                    <?php
                                    if ($data->input_teruskan == '1') {
                                        $row_tjn = $this->disposisi->disp_detail_tujuan($data->id_disposisi)->result();
                                        foreach ($row_tjn as $key) {
                                            echo "<li style=\"margin-left:5px;\">" . $key->nama_jabatan . "<br><b>" . $key->nama_lengkap . "</b></li>";
                                        }
                                    } else {
                                        echo "<b><i>Diarsipkan</i></b>";
                                    }
                                    ?>
                                </td>
                                <td><?= $data->catatan ?></td>
                                <td class="text-center no-print">
                                    <!-- <a href="<?= site_url('disposisi/' . $this->uri->segment(2) . '/detail/' . $data->id_disposisi) ?>" class="btn btn-xs btn-info">Detail</a> -->
                                    <?php if ($data->user_input == $this->session->userdata('iduser')) { ?>
                                        <a href="<?= site_url('disposisi/' . $this->uri->segment(2) . '/del/' . $data->id_disposisi) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-danger no-print" title="Delete"><i class="fa fa-trash"></i></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>

</div>