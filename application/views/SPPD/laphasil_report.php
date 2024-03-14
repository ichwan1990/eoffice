<div class="page-title">
	<div class="title_left">
		<h3>Rekap Perjalanan Dinas Kominfo</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="x_panel">
    <div class="x_content">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-xs-12"> 
                <form action="" method="get">
                    <?php
                    if(isset($_GET['s'])) {
                        $bln = $_GET['b']; $thn = $_GET['t'];
                    } else {
                        $bln = null; $thn = null;
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-5 col-xs-12">
                            <div class="form-group">
                                <label>Bulan * :</label>
                                <select name="b" class="form-control" required>
                                    <option value=""></option>
                                    <?php
                                    $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                                    for ($i = 0; $i < count($bulan); $i++) {
                                        $selected = $bln == ($i+1) ? "selected" : null;
                                        echo '<option value="'.($i+1).'" '.$selected.'>'.$bulan[$i].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-5 col-xs-12">
                            <div class="form-group">
                                <label>Tahun * :</label>
                                <select name="t" class="form-control" required>
                                    <option value=""></option>
                                    <?php
                                    for ($i = date('Y'); $i > (date('Y')-10); $i--) {
                                        $selected = $thn == $i ? "selected" : null;
                                        echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                                    }
                                    ?>
                                </select>
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
        <?php if(isset($_GET['s'])) {
            $sql = $this->sppd->get_period($this->input->get('b'), $this->input->get('t'));
            $row = $sql->result();
            ?>
            <div class="ln_solid"></div>
            <div class="table-responsive">
            <table class="table table-bordered" id="data">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tgl Kegiatan</th>
                        <th>Acara Kegiatan</th>
                        <th>Tempat</th>
                        <th>Pelaksana<br>(Pengikut)</th>
                        <th>Laporan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($sql->num_rows() > 0) {
                        $no = 0;
                        foreach ($row as $r => $data) {
                            $no++
                            ?>
                            <tr>
                                <td><?=$no?>.</td>
                                <td>
                                    <?php
                                    if($data->tgl_berangkat == $data->tgl_kembali) {
                                        $tgl = tgl_bln_indo($data->tgl_berangkat);
                                    } else {
                                        $tgl1 = substr($data->tgl_berangkat,8,2);
                                        $tgl2 = substr($data->tgl_kembali,8,2);
                                        $bln1 = substr($data->tgl_berangkat,5,2);
                                        $bln2 = substr($data->tgl_kembali,5,2);
                                        $thn1 = substr($data->tgl_berangkat,0,4);
                                        $thn2 = substr($data->tgl_kembali,0,4);
                                        if($tgl1 != $tgl2 && $bln1 == $bln2 && $thn1 == $thn2) {
                                            $tgl = $tgl1." - ".tgl_bln_indo($data->tgl_kembali);
                                        } else {
                                            $tgl = tgl_bln_indo($data->tgl_berangkat)." - ".tgl_bln_indo($data->tgl_kembali);
                                        }
                                    }
                                    echo $tgl;
                                    ?>
                                </td>
                                <td><?=$data->maksud?></td>
                                <td><?=$data->tempat_tujuan?></td>
                                <td>
                                    <?php
                                    $pegawai{$no} = [];
                                    $sql = $this->pegawai->get_pelpen('tb_sppd_pelaksana', 'id_sppd', $data->id_sppd);
                                    foreach($sql->result() as $pgw) {
                                        // $pegawai{$no}[] = $pgw->nama_lengkap."<br><i>".$pgw->nama_jabatan."</i>";
                                        $pegawai{$no}[] = $pgw->nama_lengkap;
                                    }
                                    $sql2 = $this->pegawai->get_pelpen('tb_sppd_pengikut', 'id_sppd', $data->id_sppd);
                                    foreach($sql2->result() as $pgw) {
                                        $pegawai{$no}[] = $pgw->nama_lengkap;
                                    }

                                    for($i = 0; $i < count($pegawai{$no}); $i++) {
                                        echo "- ".$pegawai{$no}[$i]."<br>";
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?=site_url('sppd/'.$data->id_sppd.'/ttd?b='.$_GET['b']."&t=".$_GET['t'])?>" class="btn btn-xs btn-success">Mengetahui</a><br>
                                    <a href="<?=site_url('sppd/'.$data->id_sppd.'/hal?b='.$_GET['b']."&t=".$_GET['t'])?>" class="btn btn-xs btn-info">Hal Dilaporkan</a><br>
                                    <?php $id_sppd = $data->id_sppd;
                                    $query_cek0 = $this->db->query("SELECT * FROM tb_sppd_dasar WHERE id_sppd = '$id_sppd'");
                                    $query_cek1 = $this->db->query("SELECT * FROM tb_sppd_lap_ttd WHERE id_kegiatan = '$id_sppd'");
                                    $query_cek2 = $this->db->query("SELECT * FROM tb_sppd_lap_hal WHERE id_kegiatan = '$id_sppd'");
                                    if($query_cek0->num_rows() == 0) { ?>
                                        <a onclick="alert('Data (Dasar) belum dinput')" class="btn btn-xs btn-default"><i class="fa fa-print"></i> Cetak Laporan Hasil</a>
                                    <?php
                                    } else if($query_cek1->num_rows() == 0) { ?>
                                        <a onclick="alert('Data (Ttd Mengetahui) belum dinput')" class="btn btn-xs btn-default"><i class="fa fa-print"></i> Cetak Laporan Hasil</a>
                                    <?php
                                    } else if($query_cek2->num_rows() == 0) { ?>
                                        <a onclick="alert('Data (Hal Dilaporkan) belum dinput')" class="btn btn-xs btn-default"><i class="fa fa-print"></i> Cetak Laporan Hasil</a>
                                    <?php
                                    } else { ?>
                                        <a href="<?=site_url('sppd/report/'.$data->id_sppd.'/print')?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-print"></i> Cetak Laporan Hasil (PDF)</a><br>
                                        <a href="<?=site_url('sppd/report_w/'.$data->id_sppd.'/print')?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-print"></i> Cetak Laporan Hasil (Word)</a>
                                    <?php
                                    } ?>
                                </td>
                            </tr>
                        <?php
                        } 
                    } else {
                        echo '<tr><td colspan="6" align="center">Data tidak ditemukan</td></tr>';
                    } ?>
                </tbody>
            </table>
            </div>
        <?php } ?>
    </div>
</div>