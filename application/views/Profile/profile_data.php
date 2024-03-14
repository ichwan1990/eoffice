<div class="card">
    <div class="card-header">
        <div class="btn-group float-right">
            <a type="button" href="<?= site_url('profile/edit') ?>" class="btn btn-success"><i class="fas fa-edit"></i> Edit</a>
            <a type="button" href="<?= site_url('dashboard') ?>" class="btn btn-dark"><i class="fas fa-arrow"></i> Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">

            <body>
                <tr>
                    <th>Nama Lengkap</th>
                    <td><?= $row->nama_lengkap ?></td>
                </tr>
                <?php if ($this->session->userdata('level_user') != '0') { ?>
                    <tr>
                        <th>NIP</th>
                        <td><?= $row->nip ?></td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td><?= $row->nama_jabatan ?></td>
                    </tr>
                    <!-- <tr>
								<th>Level Jabatan</th>
								<td><?= $row->level_jabatan ?></td>
							</tr> -->
                <?php } ?>
                <tr>
                    <th>Alamat</th>
                    <td><?= $row->alamat ?></td>
                </tr>
                <tr>
                    <th>No. Telp</th>
                    <td><?= $row->no_telp ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $row->email ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?= $row->username ?></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>*******</td>
                </tr>
            </body>
        </table>
    </div>
</div>