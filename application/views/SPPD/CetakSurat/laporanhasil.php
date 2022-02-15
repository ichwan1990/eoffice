<!-- Developed by yukcoding.co.id -->

<page>
    <style type="text/css">
        .header p{
            text-align:center;
            font-weight:bold;
            margin:1px;
            font-size:12pt;
        }
		table.dasar { border-collapse:collapse; }
		.dasar td, .dasar th {
            border:0px solid;
            padding: 5px;
            text-align:justify;
		}
        .header, .body, .footer { font-size:11pt }
        ol { margin:-10px 0px 0px -10px; }
    </style>

    <?php
    if($row->tgl_berangkat == $row->tgl_kembali) {
        $tgl = tgl_bln_indo($row->tgl_berangkat);
    } else {
        $tgl1 = substr($row->tgl_berangkat,8,2);
        $tgl2 = substr($row->tgl_kembali,8,2);
        $bln1 = substr($row->tgl_berangkat,5,2);
        $bln2 = substr($row->tgl_kembali,5,2);
        $thn1 = substr($row->tgl_berangkat,0,4);
        $thn2 = substr($row->tgl_kembali,0,4);
        if($tgl1 != $tgl2 && $bln1 == $bln2 && $thn1 == $thn2) {
            $tgl = $tgl1." - ".tgl_bln_indo($row->tgl_kembali);
        } else {
            $tgl = tgl_bln_indo($row->tgl_berangkat)." - ".tgl_bln_indo($row->tgl_kembali);
        }
    }
    ?>
    <div class="header" style="margin:20px 20px 10px 20px;">
        <p>L A P O R A N</p>
        <p>HASIL PERJALANAN DINAS</p>
        <p><?=$row->maksud?></p>
        <p>TANGGAL <?=$tgl?></p>
    </div>

    <div class="body" style="margin:20px 40px;">
        <table class="dasar">
            <tr>
                <th>I.</th>
                <th>DASAR</th>
            </tr>
            <tr>
                <td></td>
                <td>
                    <table style="border:0px solid;">
                        <?php $no = 1;
                        foreach ($dasar->result() as $key => $data) { ?>
                        <tr>
                            <td><?=$no++?>.</td>
                            <td style="border:0px solid; width:560px;"><?=$data->uraian?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <th>II.</th>
                <th>LAPORAN</th>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div>Dengan hormat dilaporkan hal-hal sebagai berikut :</div>
                    <table style="border:0px solid;">
                        <?php $no = 1;
                        foreach ($hal->result() as $key => $data) { ?>
                        <tr>
                            <td><?=$no++?>.</td>
                            <td style="border:0px solid; width:560px;"><?=$data->uraian?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <th>III.</th>
                <th>PENUTUP</th>
            </tr>
            <tr>
                <td></td>
                <td>Demikian laporan kami untuk menjadikan periksa.</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <div style="border:0px solid; margin:0 60px;">
            <div style="margin-left:400px;">Abcde, <?=tgl_bln_indo($ttd->tgl_surat)?></div>
            <br>
            <table cellspacing="0">
                <tr>
                    <td>
                        <div style="margin-left:-20px; width:272px; border:0px solid">
                            <div align="center">Mengetahui,</div>
                            <div align="center"><?=$ttd->nama_jabatan?></div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div align="center" style="font-weight:bold; text-decoration:underline;"><?=$ttd->nama_lengkap?></div>
                            <div align="center">NIP. <?=$ttd->nip?></div>
                        </div>
                    </td>
                    <?php
                    $no = 1;
                    $pegawai{$no} = [];
                    $sql = $this->pegawai->get_pelpen('tb_sppd_pelaksana', 'id_sppd', $this->uri->segment(3));
                    foreach($sql->result() as $pgw) {
                        $pegawai{$no}[] = $pgw->nama_lengkap;
                    }
                    $sql2 = $this->pegawai->get_pelpen('tb_sppd_pengikut', 'id_sppd', $this->uri->segment(3));
                    foreach($sql2->result() as $pgw) {
                        $pegawai{$no}[] = $pgw->nama_lengkap;
                    }
                    ?>
                    <td>
                        <div style="width:400px; border:0px solid">
                            <div align="center">Yang melaporkan,</div>
                            <br>
                            <div style="margin-left:90px;">
                                <?php $num = 1;
                                for($i = 0; $i < count($pegawai{$no}); $i++) {
                                    echo $num++.". ".$pegawai{$no}[$i]."<br>";
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