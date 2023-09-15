<div class="card">
	<div class="card-header">
		<a href="<?= site_url('agenda/calendar') ?>" class="btn btn-sm btn-info"><i class="fa fa-calendar"></i> Lihat Calendar</a>
		<?php if ($this->session->userdata('level_user') == '1') { ?>
			<a href="<?= site_url('agenda/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Agenda</a>
		<?php } ?>
	</div>
	<div class="card-body">
		<table class="table table-bordered" id="data">
			<thead>
				<tr>
					<th>No Agenda</th>
					<th>Tgl Mulai Acara</th>
					<th>Tgl Selesai Acara</th>
					<th>Perihal Acara</th>
					<th>Tempat Acara</th>
					<th>Keterangan</th>
					<?php if ($this->session->userdata('level_user') == '1') { ?>
						<th><i class="fa fa-gear"></i></th>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($row as $r => $data) { ?>
					<tr>
						<td><?= $data->no_agenda ?></td>
						<td><?= tgl_indo($data->tgl_start) ?><br><?= $data->jam_start ?> WIB</td>
						<td><?= tgl_indo($data->tgl_end) ?><br><?= $data->jam_end ?> WIB</td>
						<td><?= $data->perihal_acara ?></td>
						<td><?= $data->tempat_acara ?></td>
						<td><?= $data->keterangan ?></td>
						<?php if ($this->session->userdata('level_user') == '1') { ?>
							<td class="text-center">
								<!-- <div> -->
								<a href="<?= site_url('agenda/edit/' . $data->id_agenda) ?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
								<!-- </div> -->
								<!-- <div> -->
								<a href="<?= site_url('agenda/del/' . $data->id_agenda) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
								<!-- </div> -->
							</td>
						<?php } ?>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$('#data').DataTable();
</script>