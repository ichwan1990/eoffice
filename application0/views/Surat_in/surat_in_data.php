<div class="card">
    <div class="card-header">
        <?php if ($this->session->userdata('level_user') == '1') { ?>
            <div class="row">
                <div class="col-md-6">
                    <form action="<?= site_url('surat_masuk') ?>" method="get">
                        <div class="input-group input-group-sm">
                            <select name="s" class="form-control" required>
                                <option value="b" <?= @$_GET['s'] == 'b' ? 'selected' : null ?>>Bulan ini</option>
                                <option value="A" <?= (@$_GET['s'] == 'A' || @$_GET['s'] == '')  ? 'selected' : null ?>>Semua Surat</option>
                                <option value="n" <?= @$_GET['s'] == 'n' ? 'selected' : null ?>>Belum Disposisi</option>
                                <option value="y" <?= @$_GET['s'] == 'y' ? 'selected' : null ?>>Sudah Disposisi</option>
                            </select>
                            <span class="input-group-append">
                                <!-- <input type="submit" value="Filter" class="btn btn-success"> -->
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 mt-1">
                    <a href="<?= site_url('surat_masuk/add') ?>" class="btn btn-sm btn-success float-right"><i class="fa fa-plus"></i> Tambah Surat Masuk</a>
                </div>
            </div>
        <?php }
        if ($this->session->userdata('level_user') != '1') { ?>
            <form action="<?= site_url('surat_masuk') ?>" method="get">
                <div class="input-group input-group-sm col-md-4">
                    <select name="s" class="form-control" required>
                        <option value="b" <?= @$_GET['s'] == 'b' ? 'selected' : null ?>>Bulan ini</option>
                        <option value="A" <?=(@$_GET['s'] == 'A' || @$_GET['s'] == '') ? 'selected' : null ?>>Semua Surat</option>
                        <option value="n" <?= @$_GET['s'] == 'n' ? 'selected' : null ?>>Belum Disposisi</option>
                        <option value="y" <?= @$_GET['s'] == 'y' ? 'selected' : null ?>>Sudah Disposisi</option>
                    </select>
                    <span class="input-group-append">
                        <!-- <input type="submit" value="Filter" class="btn btn-success"> -->
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </span>
                </div>
            </form>
        <?php } ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="data">
                <thead>
                    <tr>
                        <th>No. Agenda</th>
                        <th>No. Surat<br>Tgl.Surat / Tgl.Terima</th>
                        <th>Pengirim<br>Sifat Surat</th>
                        <th>Perihal</br>Kategori</th>
                        <th>Dokumen<br>Tgl.Selesai</th>
                        <th>
                            <i class="fa fa-gear"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $nosurat = 1;
                    foreach ($row as $r => $data) {
                        if ($nosurat != $data->no_agenda) { //Untuk menghilangkan disposisi double

                            if (@$_GET['s'] == '' || @$_GET['s'] == 'A') {

                    ?>
                                <tr>
                                    <td align='center'><?= $no++ . "<hr>" . $data->no_agenda ?></td>
                                    <td><?= $data->no_surat . "<hr>" . tgl_bln_indo($data->tgl_surat) . " / " . tgl_bln_indo($data->tgl_catat) ?></td>
                                    <td><?php
                                        echo $data->pengirim . "<hr>";

                                        if ($data->sifat_surat == 'Biasa') {
                                            echo '<b><a class="btn btn-xs btn-default">' . $data->sifat_surat . '</a></b>';
                                        } else if ($data->sifat_surat == 'Segera') {
                                            echo '<b><a class="btn btn-xs btn-warning">' . $data->sifat_surat . '</a></b>';
                                        } else if ($data->sifat_surat == 'Rahasia') {
                                            echo '<b><a class="btn btn-xs btn-dark">' . $data->sifat_surat . '</a></b>';
                                        } else if ($data->sifat_surat == 'Penting') {
                                            echo '<b><a class="btn btn-xs btn-danger">' . $data->sifat_surat . '</a></b>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <p><?= $data->perihal . "<hr>" . $data->nama_kategori ?></p>
                                    </td>
                                    <td>
                                        <?php
                                        if ($data->file_surat == '') {
                                            echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
                                        } else {
                                            echo '<b>File</b> : <a href="./uploads/surat_masuk/' . $data->file_surat . '" target="_blank" class="btn btn-xs btn-success">Baca</a>';
                                        }
                                        echo "</br>";
                                        if ($data->tgl_selesai != "0000-00-00") {
                                            echo tgl_indo($data->tgl_selesai);
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="col-md">
                                            <?php if ($this->session->userdata('level_user') == '1') { ?>
                                                <div class="p-2">
                                                    <a href="<?= site_url('surat_masuk/edit/' . $data->id_surat_in) ?>" class="btn btn-xs btn-primary px-3" title="Edit"><i class="fa fa-pen"></i></a>
                                                    <a href="<?= site_url('surat_masuk/del/' . $data->id_surat_in) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-danger px-3" title="Delete"><i class="fa fa-trash"></i></a>
                                                </div>
                                                <?php }
                                            if ($this->session->userdata('level_user') == '1') {
                                                if ($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) {
                                                ?>
                                                    <div class="col">
                                                        <button class="btn btn-xs btn-default">Belum Ada Disposisi</button>
                                                    </div>
                                                <?php
                                                } else { ?>
                                                    <div class="col">
                                                        <a href="<?= site_url('disposisi/' . $data->id_surat_in ) ?>" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-file"></i> Lihat Disposisi</a>
                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                if ($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) {
                                                ?>
                                                    <div class="col">
                                                        <a href="<?= site_url('disposisi/' . $data->id_surat_in ) ?>" class="btn btn-xs btn-primary"><i class="fa fa-file"></i> Input Disposisi</a>
                                                    </div>
                                                <?php
                                                } else { ?>
                                                    <div class="col">
                                                        <a href="<?= site_url('disposisi/' . $data->id_surat_in ) ?>" class="btn btn-xs btn-info"><i class="fa fa-file"></i> Lihat Disposisi</a>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            } else if (@$_GET['s'] == 'n') {
                                $nosurat = $data->no_surat;
                                if ($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) {
                                ?>
                                    <tr>
                                        <td align='center'><?= $no++ . "<hr>" . $data->no_agenda ?></td>
                                        <td><?= $data->no_surat . "<hr>" . tgl_bln_indo($data->tgl_surat) . " / " . tgl_bln_indo($data->tgl_catat) ?></td>
                                        <td><?php
                                            echo $data->pengirim . "<hr>";

                                            if ($data->sifat_surat == 'Biasa') {
                                                echo '<b><a class="btn btn-xs btn-default">' . $data->sifat_surat . '</a></b>';
                                            } else if ($data->sifat_surat == 'Segera') {
                                                echo '<b><a class="btn btn-xs btn-warning">' . $data->sifat_surat . '</a></b>';
                                            } else if ($data->sifat_surat == 'Rahasia') {
                                                echo '<b><a class="btn btn-xs btn-dark">' . $data->sifat_surat . '</a></b>';
                                            } else if ($data->sifat_surat == 'Penting') {
                                                echo '<b><a class="btn btn-xs btn-danger">' . $data->sifat_surat . '</a></b>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <p><?= $data->perihal . "<hr>" . $data->nama_kategori ?></p>
                                        </td>
                                        <td>
                                            <?php
                                            if ($data->file_surat == '') {
                                                echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
                                            } else {
                                                echo '<b>File</b> : <a href="./uploads/surat_masuk/' . $data->file_surat . '" target="_blank" class="btn btn-xs btn-success">Baca</a>';
                                            }
                                            echo "</br>";
                                            if ($data->tgl_selesai != "0000-00-00") {
                                                echo tgl_indo($data->tgl_selesai);
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($this->session->userdata('level_user') == '1') { ?>
                                                <div>
                                                    <a href="<?= site_url('surat_masuk/edit/' . $data->id_surat_in) ?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-pen"></i></a>
                                                    <a href="<?= site_url('surat_masuk/del/' . $data->id_surat_in) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                </div>
                                            <?php }
                                            if ($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) { ?>
                                                <div>
                                                    <a href="<?= site_url('disposisi/' . $data->id_surat_in ) ?>" class="btn btn-xs btn-primary"><i class="fa fa-file"></i> Input Disposisi</a>
                                                </div>
                                            <?php
                                            } else { ?>
                                                <div>
                                                    <a href="<?= site_url('disposisi/' . $data->id_surat_in ) ?>" class="btn btn-xs btn-info"><i class="fa fa-file"></i> Lihat Disposisi</a>
                                                </div>
                                            <?php
                                            } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else if (@$_GET['s'] == 'b') {
                                $nosurat = $data->no_surat;
                                $bulan = date('m');
                                $bln_saja = substr($data->tgl_catat, 5, 2);
                                if ($bln_saja == $bulan) {
                                    ?>
                                        <tr>
                                            <td align='center'><?= $no++ . "<hr>" . $data->no_agenda ?></td>
                                            <td><?= $data->no_surat . "<hr>" . tgl_bln_indo($data->tgl_surat) . " / " . tgl_bln_indo($data->tgl_catat) ?></td>
                                            <td><?php
                                                echo $data->pengirim . "<hr>";

                                                if ($data->sifat_surat == 'Biasa') {
                                                    echo '<b><a class="btn btn-xs btn-default">' . $data->sifat_surat . '</a></b>';
                                                } else if ($data->sifat_surat == 'Segera') {
                                                    echo '<b><a class="btn btn-xs btn-warning">' . $data->sifat_surat . '</a></b>';
                                                } else if ($data->sifat_surat == 'Rahasia') {
                                                    echo '<b><a class="btn btn-xs btn-dark">' . $data->sifat_surat . '</a></b>';
                                                } else if ($data->sifat_surat == 'Penting') {
                                                    echo '<b><a class="btn btn-xs btn-danger">' . $data->sifat_surat . '</a></b>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <p><?= $data->perihal . "<hr>" . $data->nama_kategori ?></p>
                                            </td>
                                            <td>
                                                <?php
                                                if ($data->file_surat == '') {
                                                    echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
                                                } else {
                                                    echo '<b>File</b> : <a href="./uploads/surat_masuk/' . $data->file_surat . '" target="_blank" class="btn btn-xs btn-success">Baca</a>';
                                                }
                                                echo "</br>";
                                                if ($data->tgl_selesai != "0000-00-00") {
                                                    echo tgl_indo($data->tgl_selesai);
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($this->session->userdata('level_user') == '1') { ?>
                                                    <div>
                                                        <a href="<?= site_url('surat_masuk/edit/' . $data->id_surat_in) ?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-pen"></i></a>
                                                        <a href="<?= site_url('surat_masuk/del/' . $data->id_surat_in) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                <?php }
                                                if ($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) { ?>
                                                    <div>
                                                        <a href="<?= site_url('disposisi/' . $data->id_surat_in ) ?>" class="btn btn-xs btn-primary"><i class="fa fa-file"></i> Input Disposisi</a>
                                                    </div>
                                                <?php
                                                } else { ?>
                                                    <div>
                                                        <a href="<?= site_url('disposisi/' . $data->id_surat_in ) ?>" class="btn btn-xs btn-info"><i class="fa fa-file"></i> Lihat Disposisi</a>
                                                    </div>
                                                <?php
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    
                                }
                            } else if (@$_GET['s'] == 'y') {
                                $nosurat = $data->no_surat;
                                if ($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() != 0) {
                                    ?>
                                    <tr>
                                        <td align='center'><?= $no++ . "<hr>" . $data->no_agenda ?></td>
                                        <td><?= $data->no_surat . "<hr>" . tgl_bln_indo($data->tgl_surat) . " / " . tgl_bln_indo($data->tgl_catat) ?></td>
                                        <td><?php
                                            echo $data->pengirim . "<hr>";

                                            if ($data->sifat_surat == 'Biasa') {
                                                echo '<b><a class="btn btn-xs btn-default">' . $data->sifat_surat . '</a></b>';
                                            } else if ($data->sifat_surat == 'Segera') {
                                                echo '<b><a class="btn btn-xs btn-warning">' . $data->sifat_surat . '</a></b>';
                                            } else if ($data->sifat_surat == 'Rahasia') {
                                                echo '<b><a class="btn btn-xs btn-dark">' . $data->sifat_surat . '</a></b>';
                                            } else if ($data->sifat_surat == 'Penting') {
                                                echo '<b><a class="btn btn-xs btn-danger">' . $data->sifat_surat . '</a></b>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <p><?= $data->perihal . "<hr>" . $data->nama_kategori ?></p>
                                        </td>
                                        <td>
                                            <?php
                                            if ($data->file_surat == '') {
                                                echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
                                            } else {
                                                echo '<b>File</b> : <a href="./uploads/surat_masuk/' . $data->file_surat . '" target="_blank" class="btn btn-xs btn-success">Baca</a>';
                                            }
                                            echo "</br>";
                                            if ($data->tgl_selesai != "0000-00-00") {
                                                echo tgl_indo($data->tgl_selesai);
                                            }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($this->session->userdata('level_user') == '1') { ?>
                                                <div>
                                                    <a href="<?= site_url('surat_masuk/edit/' . $data->id_surat_in) ?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-pen"></i></a>
                                                    <a href="<?= site_url('surat_masuk/del/' . $data->id_surat_in) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                </div>
                                            <?php }
                                            if ($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) { ?>
                                                <div>
                                                    <a href="<?= site_url('disposisi/' . $data->id_surat_in ) ?>" class="btn btn-xs btn-primary"><i class="fa fa-file"></i> Input Disposisi</a>
                                                </div>
                                            <?php
                                            } else { ?>
                                                <div>
                                                    <a href="<?= site_url('disposisi/' . $data->id_surat_in ) ?>" class="btn btn-xs btn-info"><i class="fa fa-file"></i> Lihat Disposisi</a>
                                                </div>
                                            <?php
                                            } ?>
                                        </td>
                                    </tr>
                    <?php
                                }
                            }
                            $nosurat = $data->no_agenda; //Untuk menghilangkan surat yang doubel disposisi nya.
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>