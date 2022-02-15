<div class="page-title">
    <div class="title_left">
        <h3>Laporan Surat Masuk</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="x_panel">
    <div class="x_content">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <form action="" method="post">
                    <?php
                    if (isset($_POST['s'])) {
                        $hri = $_POST['h'];
                        $bln = $_POST['b'];
                        $thn = $_POST['t'];
                        $hri2 = $_POST['h2'];
                        $bln2 = $_POST['b2'];
                        $thn2 = $_POST['t2'];
                    } else {
                        $hri = null;
                        $bln = null;
                        $thn = null;
                        $hri2 = null;
                        $bln2 = null;
                        $thn2 = null;
                    } ?>
                    <div class="row no-print">
                        <div class="col-sm-5 col-xs-12">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label>Dari * :</label>
                                        <select name="h" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                $selected = $hri == $i ? "selected" : null;
                                                echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-5 col-xs-12">
                                    <div class="form-group">
                                        <label class="hidden-xs">&nbsp;</label>
                                        <select name="b" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            $nm_bln = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                                            for ($i = 0; $i < count($nm_bln); $i++) {
                                                $selected = $bln == ($i + 1) ? "selected" : null;
                                                echo '<option value="' . ($i + 1) . '" ' . $selected . '>' . $nm_bln[$i] . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="hidden-xs">&nbsp;</label>
                                        <select name="t" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            for ($i = date('Y'); $i > (date('Y') - 10); $i--) {
                                                $selected = $thn == $i ? "selected" : null;
                                                echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 col-sm-offset-1 col-xs-12">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label>Sampai * :</label>
                                        <select name="h2" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                $selected = $hri2 == $i ? "selected" : null;
                                                echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-5 col-xs-12">
                                    <div class="form-group">
                                        <label class="hidden-xs">&nbsp;</label>
                                        <select name="b2" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            for ($i = 0; $i < count($nm_bln); $i++) {
                                                $selected = $bln2 == ($i + 1) ? "selected" : null;
                                                echo '<option value="' . ($i + 1) . '" ' . $selected . '>' . $nm_bln[$i] . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <label class="hidden-xs">&nbsp;</label>
                                        <select name="t2" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            for ($i = date('Y'); $i > (date('Y') - 10); $i--) {
                                                $selected = $thn2 == $i ? "selected" : null;
                                                echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 col-xs-12">
                            <div class="form-group">
                                <label class="hidden-xs">&nbsp;</label>
                                <button type="submit" name="s" value="1" class="btn btn-success">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php if (isset($_POST['s'])) {
            $dari = $_POST['t'] . "-" . $_POST['b'] . "-" . $_POST['h'];
            $sampai = $_POST['t2'] . "-" . $_POST['b2'] . "-" . $_POST['h2'];
            $sql = $this->surat_in->get_period($dari, $sampai);
            $row = $sql->result();
        ?>
            <div class="ln_solid"></div>
            <div class="table-responsive">
                <table class="table table-bordered" id="data">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Surat<br>Tgl Surat</th>
                            <th>Pengirim</th>
                            <th>Perihal</th>
                            <th>Isi Ringkas<br>File</th>
                            <th>Ket.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($sql->num_rows() > 0) {
                            $no = 1;
                            foreach ($row as $r => $data) { ?>
                                <tr>
                                    <td><?= $no++ ?>.</td>
                                    <td><?= $data->no_surat . "<hr>" . tgl_bln_indo($data->tgl_surat) ?></td>
                                    <td><?= $data->pengirim ?></td>
                                    <td><?= $data->perihal ?></td>
                                    <td>
                                        <?php echo $data->isi_ringkas . "<hr>";
                                        if ($data->file_surat == '') {
                                            echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
                                        } else {
                                            echo '<b>File</b> : <a href="./uploads/surat_masuk/' . $data->file_surat . '" target="_blank">Download</a>';
                                        } ?>
                                    </td>
                                    <td><?= $data->keterangan ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo '<tr><td colspan="7" align="center">Data tidak ditemukan</td></tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>