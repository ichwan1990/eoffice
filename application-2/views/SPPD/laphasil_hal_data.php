<div class="page-title">
	<div class="title_left">
		<h3>Lap. Hasil: Data Hal Dilaporkan
			<br>
			<small>Kode : 
				<?php $id_sppd = $this->uri->segment(2);
				$query = $this->db->query("SELECT * FROM tb_sppd WHERE id_sppd = '$id_sppd'");
				echo $query->row()->no_sppd; ?>
			</small>
		</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('sppd/report?b='.$_GET['b']."&t=".$_GET['t']."&s=1")?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<a href="<?=site_url('sppd/'.$this->uri->segment(2).'/hal/add?b='.$_GET['b']."&t=".$_GET['t'])?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-bordered" id="data">
					<thead>
						<tr>
							<th>#</th>
							<th>Uraian</th>
							<th><i class="fa fa-gear"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						if($row->num_rows() > 0) {
							foreach ($row->result() as $r => $data) { ?>
								<tr>
									<td style="width:5%;"><?=$no++?>.</td>
									<td><?=$data->uraian?></td>
									<td class="text-center" style="width:140px">
										<a href="<?=site_url('sppd/'.$this->uri->segment(2).'/hal/edit/'.$data->id_lap_hal.'?b='.$_GET['b']."&t=".$_GET['t'])?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
										<a href="<?=site_url('sppd/'.$this->uri->segment(2).'/hal/del/'.$data->id_lap_hal.'?b='.$_GET['b']."&t=".$_GET['t'])?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>
							<?php
							}
						} else {
							echo "<tr><td colspan=\"2\" align=\"center\">Tidak ada data</td></tr>";
						} ?>
					</tbody>
				</table>
				<script type="text/javascript">
					$('#data').DataTable();
				</script>
			</div>
		</div>
	</div>
</div>