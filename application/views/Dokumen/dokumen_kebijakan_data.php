<div class="card">
	<div class="card-header">

		<div class="row">
			<div class="col-md-6 mt-1">
				<a href="<?= site_url('dokumen/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Kebijakan</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="x_content">
			<table class="table table-bordered" id="data">
				<thead>
					<tr>
						<th>#</th>
						<th>No. Kebijakan</th>
						<th>Tgl. Kebijakan</th>
						<th>Perihal</th>
						<th>File</th>
						<th>Pengolah</th>
						<th><i class="fas fa-cogs"></i></th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($row as $r => $data) { ?>
						<tr>
							<td><?= $no++ ?>.</td>
							<td><?= $data->no_kebijakan ?></td>
							<td><?= tgl_bln_indo($data->tgl_kebijakan) ?></td>
							<td><?= $data->perihal ?></td>
							<td>
								<?php 
								if ($data->file_kebijakan == '') {
									echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
								} else {
									echo '<b>File</b> : <a href="./uploads/kebijakan/' . $data->file_kebijakan . '" target="_blank">Download</a>';
								} ?>
							</td>
							<td>
							
							</td>
							<td class="text-center">
								<div>
									<a href="<?= site_url('dokumen/edit/' . $data->id_dokumen_kebijakan) ?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-pen"></i></a>
									<a href="<?= site_url('dokumen/del/' . $data->id_dokumen_kebijakan) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
								</div>
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