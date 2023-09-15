<div class="card">
	<div class="card-header">
		<div class="row float-right">
			<a href="<?= site_url('pegawai/struktur') ?>" class="btn btn-sm m-1 btn-default"><i class="fa fa-eye"></i> Struktur</a>
			<a href="<?= site_url('pegawai/add') ?>" class="btn btn-sm m-1 btn-success"><i class="fa fa-plus"></i> Tambah Pegawai</a>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered" id="data">
			<thead>
				<tr>
					<th>#</th>
					<th>NIP</th>
					<th>Nama</th>
					<!-- <th>Golongan</th> -->
					<th>Jabatan</th>
					<!-- <th>Alamat</th> -->
					<th>Telepon<br>Email</th>
					<th>Role Akun</th>
					<th><i class="fa fa-gear"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($row as $r => $data) { ?>
					<tr>
						<td><?= $no++ ?>.</td>
						<td><?= $data->nip ?></td>
						<td><?= $data->nama_lengkap ?></td>
						<!-- <td><?= $data->golongan != 0 ? $data->nama_gol . " (" . $data->kode_gol . ")" : null ?></td> -->
						<td>
							<?php
							echo "<b>" . $data->nama_jabatan . "</b>";
							if ($data->parent_jabatan != '0') {
								echo '<hr style="margin:10px 0;">Atasan : <br>';
								$jbt = $this->jabatan->get2($data->parent_jabatan)->row();
								echo $jbt->nama_jabatan;
							} ?>
							</td[>
							<!-- <td><?= $data->alamat ?></td> -->
						<td><?= $data->no_telp ?><br><?= $data->email ?></td>
						<td>
							<?= $data->username == '' ? '<i>belum ada</i>' : "<b>" . $data->username . "</b>" ?>
							<br>
							<span class="label label-default">
								<?php if ($data->level_user == '1') {
									echo "Tata Usaha";
								} else if ($data->level_user == '2') {
									echo "Direktur";
								} else if ($data->level_user == '5') {
									echo "Pegawai";
								} ?>
							</span>
						</td>
						<td class="text-center">
							<!-- <div> -->
							<div class="row text-center">

								<a href="<?= site_url('pegawai/edit/' . $data->id_user) ?>" class="btn btn-xs btn-block btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
								<!-- </div> -->
								<!-- <div> -->
								<a href="<?= site_url('pegawai/del/' . $data->id_user) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-block btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
							</div>
							<!-- </div> -->
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<script type="text/javascript">
			$('#data').DataTable();
		</script>
	</div>
</div>