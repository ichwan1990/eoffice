<div class="card">
	<div class="card-header">
		<a href="<?= site_url('golongan/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Golongan</a>
	</div>
	<div class="card-body">
		<table class="table table-bordered" id="data">
			<thead>
				<tr>
					<th>#</th>
					<th>Golongan</th>
					<th>Nama Golongan</th>
					<th>Uraian</th>
					<th><i class="fa fa-gear"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($row as $r => $data) { ?>
					<tr>
						<td><?= $no++ ?>.</td>
						<td><?= $data->kode_gol ?></td>
						<td><?= $data->nama_gol ?></td>
						<td><?= $data->uraian ?></td>
						<td class="text-center">
							<a href="<?= site_url('golongan/edit/' . $data->id_gol) ?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
							<a href="<?= site_url('golongan/del/' . $data->id_gol) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
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