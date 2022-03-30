<div class="page-title">
	<div class="title_left">
		<h3>Master Pegawai</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('pegawai/struktur')?>" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Struktur</a> 
				<a href="<?=site_url('pegawai/add')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Pegawai</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-bordered" id="data">
					<thead>
						<tr>
							<th>#</th>
							<th>NIP</th>
							<th>Nama</th>
							<th>Golongan</th>
							<th>Jabatan</th>
							<th>Alamat</th>
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
								<td><?=$no++?>.</td>
								<td><?=$data->nip?></td>
								<td><?=$data->nama_lengkap?></td>
								<td><?=$data->golongan != 0 ? $data->nama_gol." (".$data->kode_gol.")" : null?></td>
								<td>
									<?php
									echo "<b>".$data->nama_jabatan."</b>";
									if($data->parent_jabatan != '0') {
										echo '<hr style="margin:10px 0;">Atasan : <br>';
										$jbt = $this->jabatan->get2($data->parent_jabatan)->row();
										echo $jbt->nama_jabatan;
									} ?>		
								</td[>
								<td><?=$data->alamat?></td>
								<td><?=$data->no_telp?><br><?=$data->email?></td>
								<td>
									<?=$data->username == '' ? '<i>belum ada</i>' : "<b>".$data->username."</b>"?>
									<br>
									<span class="label label-default">
										<?php if($data->level_user == '1') {
											echo "Tata Usaha";
										} else if($data->level_user == '2') {
											echo "Direktur";
										} else if($data->level_user == '5') {
											echo "Pegawai";
										} ?>
									</span>
								</td>
								<td class="text-center">
									<!-- <div> -->
										<a href="<?=site_url('pegawai/edit/'.$data->id_user)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
									<!-- </div> -->
									<!-- <div> -->
										<a href="<?=site_url('pegawai/del/'.$data->id_user)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
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
	</div>
</div>