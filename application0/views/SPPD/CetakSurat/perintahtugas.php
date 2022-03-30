<!-- Developed by yukcoding.co.id -->

<page>
    <style>
    .h { margin: 0; text-align: center; }
    .header, .body, .footer { font-size:11pt }
    </style>
    <div class="header">
        <h3 class="h" style="margin-top: 20px;">PEMERINTAH KABUPATEN ABCDE</h3>
        <h3 class="h">DINAS KOMUNIKASI DAN INFORMATIKA</h3>
        <div align="center" style="font-weight:bold;">Jl. Pemuda Nomor 1 Abcde Telp. (0290) 445566</div>
        <div align="center" style="font-weight:bold;">Email : kominfo@abcdekab.go.id</div>
        <div style="padding:20px 40px;">
            <hr>
            <hr style="margin-top:-13px">
        </div>
    </div>
    <div class="body">
        <div>
            <h4 class="h">SURAT PERINTAH TUGAS</h4>
            <div align="center">Nomor : <?=$row->no_sppd?></div>
        </div>
        <div style="border:0px solid; margin: 20px 60px 40px 60px;">
            <table width="100%">
                <tr>
                    <td style="width:100px;">Dasar</td>
                    <td>:</td>
                    <td style="width:500px; border:0px solid;">
                        <?php $no = 1;
                        foreach ($dasar->result() as $r => $data) { ?>
                            <table>
                                <tr>
                                    <td style="padding-left:17px;" rowspan="3"><?=$no++?>.</td>
                                    <td style="width:500px; border:0px solid; text-align:justify;"><?=$data->uraian?></td>
                                </tr>
                            </table>
                        <?php
                        } ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding-top:20px;"><h4 class="h">MEMERINTAHKAN</h4></td>
                </tr>
                <tr>
                    <td style="width:100px">Kepada</td>
                    <td>:</td>
                    <td style="width:500px; border:0px solid">
                        <?php $no = 1;
                        foreach ($pelaksana->result() as $r => $data) { ?>
                            <table>
                                <tr>
                                    <td style="padding-left:17px;" rowspan="3"><?=$no++?>.</td>
                                    <td style="width:100px;">Nama</td>
                                    <td>:</td>
                                    <td><?=$data->nama_lengkap?></td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td>:</td>
                                    <td><?=$data->nip?></td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td style="width:360px;"><?=$data->nama_jabatan?></td>
                                </tr>
                            </table>
                            <?php
                            $this->db->select('*');
                            $this->db->from('tb_sppd_pengikut');
                            $this->db->join('tb_pegawai', 'tb_sppd_pengikut.pegawai = tb_pegawai.id_user');
                            $this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
                            $this->db->where('id_pelaksana', $data->id_pelaksana);
                            $query = $this->db->get();
                            foreach ($query->result() as $r => $data) { ?>
                                <table>
                                    <tr>
                                        <td style="padding-left:17px;" rowspan="3"><?=$no++?>.</td>
                                        <td style="width:100px;">Nama</td>
                                        <td>:</td>
                                        <td><?=$data->nama_lengkap?></td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td>:</td>
                                        <td><?=$data->nip?></td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td>:</td>
                                        <td style="width:360px;"><?=$data->nama_jabatan?></td>
                                    </tr>
                                </table>
                            <?php
                            }
                        } ?>
                    </td>
                </tr>
                <?php
                function hari_indo($tanggal) {
                    $day = date('D', strtotime($tanggal));
                    $dayList = array('Sun' => 'Minggu', 'Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu');
                    return $dayList[$day];
                }
                
                if($row->tgl_berangkat == $row->tgl_kembali) {
                    $hari = hari_indo($row->tgl_berangkat);
                    $tgl = tgl_bln_indo($row->tgl_berangkat);
                } else {
                    $hari = hari_indo($row->tgl_berangkat)." - ".hari_indo($row->tgl_kembali);
                    $tgl = tgl_bln_indo($row->tgl_berangkat)." - ".tgl_bln_indo($row->tgl_kembali);
                }
                ?>
                <tr>
                    <td style="width:100px; padding-top:15px;">Untuk</td>
                    <td style="padding-top:15px;">:</td>
                    <td style="width:500px; border:0px solid; padding-top:15px;">
                        <table style="padding-left:17px;">
                            <tr>
                                <td colspan="3" style="width:515px; border:0px solid; text-align:justify;"><?=$row->maksud?>, pada</td>
                            </tr>
                            <tr>
                                <td>Hari</td>
                                <td>:</td>
                                <td><?=$hari?></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td><?=$tgl?></td>
                            </tr>
                            <tr>
                                <td>Tempat</td>
                                <td>:</td>
                                <td><?=$row->tempat_tujuan?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="footer">
        <div style="border:0px solid; margin: 0 60px;">
            <div style="margin-left:400px;">Ditetapkan di Abcde</div>
            <div style="margin-left:400px;">Pada tanggal <?=tgl_bln_indo($row->tgl_sppd)?></div>
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

<!-- Developed by yukcoding.co.id -->