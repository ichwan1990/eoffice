<div class="card">
	<div class="card-header">
		<a href="<?= site_url('jabatan/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Jabatan</a>
	</div>
	<div class="card-body">
		<table class="table table-bordered" id="data">
			<thead>
				<tr>
					<th>#</th>
					<th>Nama Jabatan</th>
					<th>Kode</th>
					<th>Level</th>
					<th>Atasan</th>
					<th><i class="fa fa-gear"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($row as $r => $data) { ?>
					<tr>
						<td><?= $no++ ?>.</td>
						<td><?= $data->nama_jabatan ?></td>
						<td><?= $data->kode_surat ?></td>
						<td>
							<span class="label label-default">
								<?php if ($data->level_jabatan == '1') {
									echo "Level 0";
								} else if ($data->level_jabatan == '2') {
									echo "Level 1";
								} else if ($data->level_jabatan == '3') {
									echo "Level 2";
								} else if ($data->level_jabatan == '4') {
									echo "Level 3";
								} else if ($data->level_jabatan == '5') {
									echo "Level 4";
								} ?>
							</span>
						</td>
						<td>
							<?php if ($data->parent_jabatan != '0') {
								$jbt = $this->jabatan->get2($data->parent_jabatan)->row();
								echo $jbt->nama_jabatan;
							} ?>
						</td>
						<td class="text-center">
							<a href="<?= site_url('jabatan/edit/' . $data->id_jabatan) ?>" class="btn btn-xs btn-block btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
							<?php if ($data->nama_jabatan != '-' && $data->uraian != '(tidak ada jabatan)') { ?>
								<a href="<?= site_url('jabatan/del/' . $data->id_jabatan) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-block btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$('#data').DataTable();
</script>