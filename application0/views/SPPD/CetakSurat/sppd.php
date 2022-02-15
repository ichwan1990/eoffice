<!-- Developed by yukcoding.co.id -->

<page>
    <style>
    .h {
    margin: 0;
    text-align: center;
    }
    table.sppd td { border-top:1px solid; }
    table.not td { border:0px solid; }
    .header, .body { font-size:11pt }
    </style>
    <div class="header">
        <h3 class="h" style="margin-top:20px;">PEMERINTAH KABUPATEN ABCDE</h3>
        <h3 class="h">DINAS KOMUNIKASI DAN INFORMATIKA</h3>
        <div align="center" style="font-weight:bold;">Jl. Pemuda Nomor 1 Abcde Telp. (0290) 445566</div>
        <div align="center" style="font-weight:bold;">Email : kominfo@abcdekab.go.id</div>
        <div style="padding:20px 40px 10px 40px;">
            <hr>
            <hr style="margin-top:-13px;">
        </div>
    </div>
    <div class="body">
        <div style="margin-left:480px;">Lampiran Surat Perintah Tugas</div>
        <div style="margin-left:480px; margin-bottom:10px;">
            <table cellspacing="0">
                <tr>
                    <td>Tanggal</td>
                    <td style="width:15px" align="right">:</td>
                    <td><?=tgl_bln_indo($row->tgl_sppd)?></td>
                </tr>
                <tr>
                    <td>Nomor</td>
                    <td style="width:15px" align="right">:</td>
                    <td><?=$row->no_sppd?></td>
                </tr>
            </table>
        </div>
        <br>
        <div>
            <h4 class="h">SURAT PERINTAH PERJALANAN DINAS<br>(SPPD)</h4>
        </div>
        <div style="border:0px solid; margin:25px 60px 50px 60px;">
            <table width="100%" class="sppd" cellspacing="0">
                <tr>
                    <td style="width:20px;">1.</td>
                    <td>Pejabat yang memberi perintah</td>
                    <td style="width:30px;">:</td>
                    <td style="padding-bottom:10px; width:340px;">
                        <?=$row->nama_jabatan?>
                    </td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Nama/NIP Pegawai yang diperintah</td>
                    <td>:</td>
                    <td style="padding-bottom:10px;">
                        <?php $data = $pelaksana->row();
                        echo $data->nama_lengkap; ?>
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>
                        <table class="not" cellspacing="0" width="100%">
                            <tr>
                                <td>a.</td>
                                <td style="width:200px;">Pangkat dan Golongan menurut PP No 6 Tahun 1997</td>
                            </tr>
                            <tr>
                                <td>b.</td>
                                <td>Jabatan</td>
                            </tr>
                        </table>
                    </td>
                    <td>:<br><br>:</td>
                    <td style="padding-bottom:10px;">
                        <?=$data->golongan != 0 ? $data->nama_gol." (".$data->kode_gol.")" : null?>
                        <br><br>
                        <?=$data->nama_jabatan?>
                    </td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Maksud Perjalanan Dinas</td>
                    <td>:</td>
                    <td style="padding-bottom:10px; width:365px; text-align:justify;">
                        <?=$row->maksud?>
                    </td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>Alat angkut yang digunakan</td>
                    <td>:</td>
                    <td style="padding-bottom:10px;">
                        <?=$row->kendaraan?>
                    </td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>
                        a. Tempat berangkat
                        <br>
                        b. Tempat tujuan
                    </td>
                    <td>:<br>:</td>
                    <td style="padding-bottom:10px;">
                        <?=$row->tempat_berangkat?>
                        <br>
                        <?=$row->tempat_tujuan?>
                    </td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>
                        a. Lamanya perjalanan dinas
                        <br>
                        b. Tanggal berangkat
                        <br>
                        c. Tanggal harus kembali
                    </td>
                    <td>:<br>:<br>:</td>
                    <td style="padding-bottom:10px;">
                        <?php
                        function lama_hari($tgl1, $tgl2) {
                            $date1 = date_create($tgl1);
                            $date2 = date_create($tgl2);
                            $diff = date_diff($date1, $date2);
                            return $diff->format('%a') + 1;
                        }
                        ?>
                        <?=lama_hari($row->tgl_berangkat, $row->tgl_kembali)?> hari
                        <br>
                        <?=tgl_bln_indo($row->tgl_berangkat)?>
                        <br>
                        <?=tgl_bln_indo($row->tgl_kembali)?>
                    </td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td>Pengikut</td>
                    <td>:</td>
                    <td style="">
                        <?php
                        $no = 1;
                        foreach ($pengikut->result() as $r => $data) {
                            echo $no++.". ".$data->nama_lengkap."<br>";
                        }
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="body">
        <div style="border:0px solid; margin: 0 60px;">
            <div style="margin-left:360px;">
                <table cellspasing="0">
                    <tr>
                        <td>Dikeluarkan di</td>
                        <td>:</td>
                        <td>Abcde</td>
                    </tr>
                    <tr>
                        <td>Pada tanggal</td>
                        <td>:</td>
                        <td><?=tgl_bln_indo($row->tgl_sppd)?></td>
                    </tr>
                </table>
            </div>
            <?php
            if($row->level_jabatan == '3') {
                $an = "an. Kepala Dinas Komunikasi dan Informatika";	
            } else {
                $an = null;
            } ?>
            <br>
            <div style="margin-left:310px; border:0px solid">
                <div align="center"><?=$an?></div>
                <div align="center"><?=$row->jabatan_ttd?></div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div align="center" style="font-weight:bold; text-decoration:underline;"><?=$row->nama_ttd?></div>
                <div align="center">Pembina Utama Muda</div>
                <div align="center">NIP. <?=$row->nip?></div>
            </div>
        </div>
    </div>
</page>

<page>
    <div class="footer">
        <div style="margin-left:430px; margin-top:20px;">
            <table cellspacing="0">
                <tr>
                    <td>SPPD No</td>
                    <td style="width:15px" align="right">:</td>
                    <td><?=$row->no_sppd?></td>
                </tr>
                <tr>
                    <td>Berangkat dari<br>(tempat kedudukan)</td>
                    <td style="width:15px" align="right">:</td>
                    <td><?=$row->tempat_berangkat?></td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td style="width:15px" align="right">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Ke</td>
                    <td style="width:15px" align="right">:</td>
                    <td><?=$row->tempat_tujuan?></td>
                </tr>
            </table>
        </div>

        <div style="border:0px solid; margin:20px 60px 10px 60px">
            <div style="margin-left:310px; border:0px solid">
                <div align="center"><?=$an?></div>
                <div align="center"><?=$row->jabatan_ttd?></div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div align="center" style="font-weight:bold; text-decoration:underline;"><?=$row->nama_ttd?></div>
                <div align="center">Pembina Utama Muda</div>
                <div align="center">NIP. <?=$row->nip?></div>
            </div>
        </div>

        <div style="margin:20px 80px 40px 60px; border-top:1px solid; padding:10px;">
            <table>
                <tr>
                    <td>Tiba di</td>
                    <td>:</td>
                    <td style="width:200px"></td>
                    <td>Berangkat dari</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td>:</td>
                    <td></td>
                    <td>Ke</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Pada tanggal</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td>Kepala</td>
                    <td></td>
                    <td></td>
                    <td>Kepala</td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div style="margin:20px 80px 40px 60px; border-top:1px solid; padding:10px;">
            <table>
                <tr>
                    <td>Tiba di</td>
                    <td>:</td>
                    <td style="width:200px"></td>
                    <td>Berangkat dari</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td>:</td>
                    <td></td>
                    <td>Ke</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Pada tanggal</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td>Kepala</td>
                    <td></td>
                    <td></td>
                    <td>Kepala</td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div style="margin:20px 80px 20px 60px; border-top:1px solid; border-bottom:1px solid; padding:10px 10px 70px 10px;">
            <table>
                <tr>
                    <td>Tiba di</td>
                    <td>:</td>
                    <td style="width:200px"></td>
                    <td>Berangkat dari</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td>Pada tanggal</td>
                    <td>:</td>
                    <td></td>
                    <td>Ke</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Pada tanggal</td>
                    <td>:</td>
                </tr>
                <tr>
                    <td>Kepala</td>
                    <td></td>
                    <td></td>
                    <td>Kepala</td>
                    <td></td>
                </tr>
            </table>
        </div>
        
        <div style="margin-left:340px;">
            <table cellspacing="0">
                <tr>
                    <td style="width:20px">V.</td>
                    <td>Tiba kembali di</td>
                    <td>:</td>
                    <td style="width:100px;"><?=$row->tempat_berangkat?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Pada tanggal</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3" style="width:300px; text-align:justify">
                    Telah diperiksa, dengan keterangan bahwa perjalanan tersebut di atas benar dilakukan atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu sesingkat-singkatnya.
                    </td>
                </tr>
            </table>
        </div>

        <div style="border:0px solid; margin:30px 60px; margin-left:310px">
            <div align="center"><?=$an?></div>
            <div align="center"><?=$row->jabatan_ttd?></div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div align="center" style="font-weight:bold; text-decoration:underline;"><?=$row->nama_ttd?></div>
            <div align="center">Pembina Utama Muda</div>
            <div align="center">NIP. <?=$row->nip?></div>
        </div>

        <div style="margin:20px 60px 10px 60px;">CATATAN LAIN-LAIN</div>
        <div style="margin:0 80px 0px 60px; padding-top:10px; border-top:1px solid; text-align:justify">
            PERHATIAN<br>
            Pejabat yang berwenang menerbitkan SPPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba serta Bendaharawan bertanggungjawab berdasarkan peraturan-peraturan Keuangan Negara apabila Negara mendapatkan rugi akibat kesalahan, kealpaannya.
        </div>
    </div>
</page>

<!-- Developed by yukcoding.co.id -->