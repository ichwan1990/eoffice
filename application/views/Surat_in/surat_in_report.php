<div class="card">
    <div class="card-header">
        <div class="row no-print">
            <div class="col-sm-12 col-xs-12"> 
                <form action="" method="post">
                    <?php
                    if(isset($_POST['s'])) {
                        $hri = $_POST['h']; $bln = $_POST['b']; $thn = $_POST['t'];
                        $hri2 = $_POST['h2']; $bln2 = $_POST['b2']; $thn2 = $_POST['t2'];
                    } else {
                        $hri = null; $bln = null; $thn = null;
                        $hri2 = null; $bln2 = null; $thn2 = null;
                    } ?>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label>Dari * :</label>
                                        <select name="h" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                $selected = $hri == $i ? "selected" : null;
                                                echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
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
                                                $selected = $bln == ($i+1) ? "selected" : null;
                                                echo '<option value="'.($i+1).'" '.$selected.'>'.$nm_bln[$i].'</option>';
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
                                            for ($i = date('Y'); $i > (date('Y')-10); $i--) {
                                                $selected = $thn == $i ? "selected" : null;
                                                echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                    <div class="form-group">
                                        <label>Sampai * :</label>
                                        <select name="h2" class="form-control" required>
                                            <option value=""></option>
                                            <?php
                                            for ($i = 1; $i <= 31; $i++) {
                                                $selected = $hri2 == $i ? "selected" : null;
                                                echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
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
                                                $selected = $bln2 == ($i+1) ? "selected" : null;
                                                echo '<option value="'.($i+1).'" '.$selected.'>'.$nm_bln[$i].'</option>';
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
                                            for ($i = date('Y'); $i > (date('Y')-10); $i--) {
                                                $selected = $thn2 == $i ? "selected" : null;
                                                echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mt-4">
                            <div class="btn-group w-20">
                                    <button type="submit" name="s" value="1" class="btn btn-success">Filter</button>
                                    <button onclick="window.print()" class="btn btn-primary">Cetak</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php if(isset($_POST['s'])) {
            $dari = $_POST['t']."-".$_POST['b']."-".$_POST['h'];
            $sampai = $_POST['t2']."-".$_POST['b2']."-".$_POST['h2'];
            $sql = $this->surat_in->get_period($dari, $sampai);
            $row = $sql->result();
            ?>
            <div class="ln_solid no-print"></div>
            <div class="table-responsive">
            <table class="table table-bordered" id="data">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No.Surat<br>No.Agenda</th>
                        <th>Pengirim<br>Tgl.Surat</th>
                        <th>Perihal</br>Kategori</th>
                        <th>Sifat Surat</br>Tgl.Selesai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($sql->num_rows() > 0) {
                        $no = 1;
                        foreach ($row as $r => $data) { ?>
                            <tr>
                                <td rowspan="2"><?=$no++?>.</td>
                                <td><?=$data->no_surat?></td>
                                <td><?=$data->pengirim?></td>
                                <td><?=$data->perihal?>
                                
                                </td>
                                <td>
                                    <?=$data->sifat_surat ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?=$data->no_agenda?></td>
                                <td><?=tgl_bln_indo($data->tgl_surat)?></td>
                                <td><?=$data->nama_kategori ?></td>
                                <td>
                                <?php
                                if ($data->tgl_selesai != "0000-00-00"){
    								echo tgl_indo($data->tgl_selesai);
    							}else{
    							    echo"<i>Belum Selesai</i>";
    							}
                                ?>
                                </td>
                            </tr>
                            <tr>
                                    <td colspan="5">
                                        <table class="table table-bordered" id="data">
                                            <thead>
                                                <tr>
                                                    <th>Disposisi Oleh</th>
                                                    <th>Diteruskan Kepada</th>
                                                    <th>Catatan Disposisi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $CI = &get_instance();
                                                $CI->load->model('Disposisi_m');
                                                $sql2 = $CI->Disposisi_m->get_disposisi_all($data->id_surat_in);
                                                $row2 = $sql2->result();
                                                foreach ($row2 as $r2 => $data2) { ?>
                                                    <tr>
                                                        <td><?= $data2->nama_jabatan ?><br><?= $data2->nama_lengkap ?></td>
                                                        <td>
                                                            <?php
                                                            if ($data2->input_teruskan == '1') {
                                                                $row_tjn = $this->disposisi->disp_detail_tujuan($data2->id_disposisi)->result();
                                                                foreach ($row_tjn as $key) {
                                                                    echo "<li style=\"margin-left:5px;\">" . $key->nama_jabatan . "<br><b>" . $key->nama_lengkap . "</b></li>";
                                                                }
                                                            } else {
                                                                echo "<b><i>Diarsipkan</i></b>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $data2->catatan ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
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
