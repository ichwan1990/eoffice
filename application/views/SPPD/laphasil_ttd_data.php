<div class="page-title">
	<div class="title_right">
		<h3>Lap. Hasil: Mengetahui (ttd laporan)
			<br>
			<small>Kode : 
				<?php $id_sppd = $this->uri->segment(2);
				$query = $this->db->query("SELECT * FROM tb_sppd WHERE id_sppd = '$id_sppd'");
				echo $query->row()->no_sppd;
				?>
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
				<?php $query_cek = $this->db->query("SELECT * FROM tb_sppd_lap_ttd WHERE id_kegiatan = '$id_sppd'");
				if($query_cek->num_rows() == 0) { ?>
					<a href="<?=site_url('sppd/'.$this->uri->segment(2).'/ttd/add?b='.$_GET['b']."&t=".$_GET['t'])?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>
				<?php } ?>
				<div class="clearfix"></div>
			</div>
			<div class="x_content table-responsive">
				<table class="table table-bordered" id="data">
					<thead>
						<tr>
							<th>Mengetahui</th>
							<th>Tgl Surat</th>
							<th><i class="fa fa-gear"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($row->num_rows() > 0) {
							foreach ($row->result() as $r => $data) { ?>
								<tr>
									<td><?=$data->nama_lengkap."<br><i>".$data->nama_jabatan."</i><br>".$data->nip?></td>
									<td><?=tgl_indo($data->tgl_surat)?></td>
									<td class="text-center">
										<a href="<?=site_url('sppd/'.$this->uri->segment(2).'/ttd/edit/'.$data->id_lap_ttd.'?b='.$_GET['b']."&t=".$_GET['t'])?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
										<a href="<?=site_url('sppd/'.$this->uri->segment(2).'/ttd/del/'.$data->id_lap_ttd.'?b='.$_GET['b']."&t=".$_GET['t'])?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>
							<?php
							}
						} else {
							echo "<tr><td colspan=\"3\" align=\"center\">Tidak ada data</td></tr>";
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>