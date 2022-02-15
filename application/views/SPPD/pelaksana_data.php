<div class="page-title">
	<div class="title_left">
		<h3>Data Pelaksana
			<br>
			<small>Kode : 
				<?php $id_sppd = $this->uri->segment(3);
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
				<a href="<?=site_url('sppd')?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<?php $query_cek = $this->db->query("SELECT * FROM tb_sppd_pelaksana WHERE id_sppd = '$id_sppd'");
				if($query_cek->num_rows() == 0) { ?>
					<a href="<?=site_url('sppd/pelaksana/'.$this->uri->segment(3).'/add')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Pelaksana</a>
				<?php } ?>
				<div class="clearfix"></div>
			</div>
			<div class="x_content table-responsive">
				<table class="table table-bordered" id="data">
					<thead>
						<tr>
							<th>NIP</th>
							<th>Nama Pegawai</th>
							<th>Uraian</th>
							<th><i class="fa fa-gear"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($row->num_rows() > 0) {
							foreach ($row->result() as $r => $data) { ?>
								<tr>
									<td><?=$data->nip?></td>
									<td><?=$data->nama_lengkap."<br><i>".$data->nama_jabatan."</i>"?></td>
									<td><?=$data->uraian2?></td>
									<td class="text-center" style="width:140px">
										<a href="<?=site_url('sppd/pelaksana/'.$this->uri->segment(3).'/edit/'.$data->id_pelaksana)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
										<a href="<?=site_url('sppd/pelaksana/'.$this->uri->segment(3).'/del/'.$data->id_pelaksana)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
						            </td>
								</tr>
							<?php
							} 
						} else {
							echo "<tr><td colspan=\"4\" align=\"center\">Tidak ada data</td></tr>";
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>