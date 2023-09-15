<div class="page-title">
	<div class="title_left">
		<h3>Data SPPD</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('sppd/add')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-bordered" id="data">
					<thead>
						<tr>
							<th>No. SPPD</th>
							<th>Maksud</th>
							<th>Tahun</th>
							<th>Tempat Kegiatan</th>
							<th>Kode Rek.</th>
							<th>Data</th>
							<th><i class="fa fa-gear"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($row as $r => $data) { ?>
							<tr>
								<td><?=$data->no_sppd?></td>
								<td><?=$data->maksud?></td>
								<td><?=substr($data->tgl_berangkat, 0, 4)?></td>
								<td><?=$data->tempat_tujuan?></td>
								<td><?=$data->kode_rek?></td>
								<td class="text-center">
									<a href="<?=site_url('sppd/dasar/'.$data->id_sppd)?>" class="btn btn-xs btn-success">Dasar</a><br>
									<a href="<?=site_url('sppd/pelaksana/'.$data->id_sppd)?>" class="btn btn-xs btn-info">Pelaksana</a><br>
									<a href="<?=site_url('sppd/pengikut/'.$data->id_sppd)?>" class="btn btn-xs btn-info">Pengikut Pelaksana</a>
					            </td>
								<td class="text-center">
									<a href="<?=site_url('sppd/edit/'.$data->id_sppd)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
									<a href="<?=site_url('sppd/del/'.$data->id_sppd)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
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