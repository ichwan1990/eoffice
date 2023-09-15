<div class="card">
	<div class="card-header">
		<a href="<?= site_url('tujuan_surat/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Tujuan</a>
	</div>
	<div class="card-body">
		<table class="table table-bordered" id="data">
			<thead>
				<tr>
					<th>#</th>
					<th>Alamat Tujuan</th>
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
						<td><?= $data->alamat_tujuan ?></td>
						<td><?= $data->uraian ?></td>
						<td class="text-center">
							<!-- <div> -->
							<a href="<?= site_url('tujuan_surat/edit/' . $data->id_tujuan) ?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
							<!-- </div> -->
							<!-- <div> -->
							<a href="<?= site_url('tujuan_surat/del/' . $data->id_tujuan) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
							<!-- </div> -->
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