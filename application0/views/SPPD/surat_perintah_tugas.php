<div class="page-title">
	<div class="title_left">
		<h3>Surat Perintah Tugas</h3>
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
						<?php foreach ($row as $r => $data) {
							$id_sppd = $data->id_sppd;
							?>
							<tr>
								<td><?=$data->no_sppd?></td>
								<td><?=substr($data->tgl_sppd, 0, 4)?></td>
								<td><?=$data->maksud?></td>
								<td><?=$data->tempat_tujuan?></td>
								<td class="text-center">
									<?php $query_cek = $this->db->query("SELECT * FROM tb_sppd_dasar WHERE id_sppd = '$id_sppd'");
									if($query_cek->num_rows() > 0) { ?>
										<a href="<?=site_url('sppd/surat_pt/print/'.$data->id_sppd)?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-print"></i> Cetak SPT (PDF)</a><br>
										<a href="<?=site_url('sppd/surat_pt_w/print/'.$data->id_sppd)?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-print"></i> Cetak SPT (Word)</a><br/>
									<?php
									} else { ?>
										<a class="btn btn-xs btn-default" onclick="alert('Dasar belum di input')"><i class="fa fa-print"></i> Cetak SPT</a><br/>
									<?php
									}
									
									$query_cek2 = $this->db->query("SELECT * FROM tb_sppd_pelaksana WHERE id_sppd = '$id_sppd'");
									if($query_cek2->num_rows() > 0) { ?>
										<a href="<?=site_url('sppd/surat_sppd/print/'.$data->id_sppd)?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-print"></i> Cetak Lampiran SPT (PDF)</a><br>
										<a href="<?=site_url('sppd/surat_sppd_w/print/'.$data->id_sppd)?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-print"></i> Cetak Lampiran SPT (Word)</a>
									<?php
									} else { ?>
										<a class="btn btn-xs btn-default" onclick="alert('Pelaksana belum di input')"><i class="fa fa-print"></i> Cetak Lampiran SPT</a>
									<?php
									} ?>
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