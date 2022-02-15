<!-- Developed by yukcoding.co.id -->

<page>
    <style type="text/css">
        .header p {
            text-align: center;
            font-weight: bold;
            margin: 1px;
            font-size: 12pt;
        }

        table.dasar {
            border-collapse: collapse;
        }

        .dasar td,
        .dasar th {
            border: 0px solid;
            padding: 5px;
            text-align: justify;
        }

        .header,
        .body,
        .footer {
            font-size: 11pt
        }

        ol {
            margin: -10px 0px 0px -10px;
        }
    </style>

        <?php if (isset($_POST['s'])) {
            $dari = $_POST['t'] . "-" . $_POST['b'] . "-" . $_POST['h'];
            $sampai = $_POST['t2'] . "-" . $_POST['b2'] . "-" . $_POST['h2'];
            $sql = $this->surat_in->get_period($dari, $sampai);
            $row = $sql->result();
        ?>
    <div class="header" style="margin:20px 20px 10px 20px;">
        <p>L A P O R A N</p>
        <p>REKAP SURAT MASUK</p>
        <p>Periode  : <?= $dari ." - ". $sampai?></p>
        <p>TANGGAL <?= $tgl ?></p>
    </div>

    <div class="body" style="margin:20px 40px;">
    <table class="dasar">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Surat</th>
                            <th>Tgl Terima/<br>Tgl Surat</th>
                            <th>Pengirim/<br>Kategori</th>
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
                                    <td><?= $data->no_surat ?></td>
                                    <td><?= tgl_bln_indo($data->tgl_catat) . "<hr>" . tgl_bln_indo($data->tgl_surat) ?></td>
                                    <td><?= $data->pengirim . "<hr>" . $data->nama_kategori ?></td>
                                    <td><?= $data->perihal ?>

                                    </td>
                                    <td class="no-print">
                                        <?php echo $data->perihal . "<hr>";
                                        if ($data->file_surat == '') {
                                            echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
                                        } else {
                                            echo '<b>File</b> : <a href="../uploads/surat_masuk/' . $data->file_surat . '" target="_blank">Download</a>';
                                        } ?>
                                    </td>
                                    <td><?= $data->keterangan ?></td>
                                </tr>
                                <tr>
                                    <td colspan="7">
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

    <div class="footer">
        <div style="border:0px solid; margin:0 60px;">
            <div style="margin-left:400px;">Abcde, <?= tgl_bln_indo($ttd->tgl_surat) ?></div>
            <br>
            <table cellspacing="0">
                <tr>
                    <td>
                        <div style="margin-left:-20px; width:272px; border:0px solid">
                            <div align="center">Mengetahui,</div>
                            <div align="center"><?= $ttd->nama_jabatan ?></div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div align="center" style="font-weight:bold; text-decoration:underline;"><?= $ttd->nama_lengkap ?></div>
                            <div align="center">NIP. <?= $ttd->nip ?></div>
                        </div>
                    </td>
                    <?php
                    $no = 1;
                    $pegawai{
                    $no} = [];
                    $sql = $this->pegawai->get_pelpen('tb_sppd_pelaksana', 'id_sppd', $this->uri->segment(3));
                    foreach ($sql->result() as $pgw) {
                        $pegawai{
                        $no}[] = $pgw->nama_lengkap;
                    }
                    $sql2 = $this->pegawai->get_pelpen('tb_sppd_pengikut', 'id_sppd', $this->uri->segment(3));
                    foreach ($sql2->result() as $pgw) {
                        $pegawai{
                        $no}[] = $pgw->nama_lengkap;
                    }
                    ?>
                    <td>
                        <div style="width:400px; border:0px solid">
                            <div align="center">Yang melaporkan,</div>
                            <br>
                            <div style="margin-left:90px;">
                                <?php $num = 1;
                                for ($i = 0; $i < count($pegawai{
                                $no}); $i++) {
                                    echo $num++ . ". " . $pegawai{
                                    $no}[$i] . "<br>";
                                }
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</page>

<!-- Developed by yukcoding.co.id -->