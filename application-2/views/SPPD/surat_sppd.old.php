<div class="page-title">
	<div class="title_left">
		<h3>Surat Perintah Perjalanan Dinas</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content">
				<table class="table table-bordered" id="data">
					<thead>
						<tr>
							<th>No. SPPD</th>
							<th>Tahun</th>
							<th>Perihal Kegiatan</th>
							<th>Tempat Kegiatan</th>
							<th><i class="fa fa-gear"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($row as $r => $data) { ?>
							<tr>
								<td><?=$data->no_sppd?></td>
								<td><?=substr($data->tgl_sppd, 0, 4)?></td>
								<td><?=$data->maksud?></td>
								<td><?=$data->tempat_tujuan?></td>
								<td class="text-center">
									<a href="<?=site_url('sppd/surat_sppd/print/'.$data->id_sppd)?>" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-print"></i> Cetak Surat</a>
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