<div class="page-title">
	<div class="title_left">
		<h3>Data Pengikut Pelaksana
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
				<div class="clearfix"></div>
			</div>
			<div class="x_content table-responsive">
				<table class="table table-bordered" id="data">
					<thead>
						<tr>
							<th>#</th>
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
								<tr style="background-color: #eff;">
									<td>*</td>
									<td><?=$data->nip?></td>
									<td><?=$data->nama_lengkap."<br><i>".$data->nama_jabatan."</i>"?></td>
									<td><?=$data->uraian2?></td>
									<td class="text-center">
										<a href="<?=site_url('sppd/pengikut/'.$this->uri->segment(3).'/'.$data->id_pelaksana.'/add')?>" class="btn btn-xs btn-success">Tambah Pengikut</a>
						            </td>
								</tr>
								<?php
								$this->db->select('*, tb_sppd_pengikut.uraian as uraian3');
								$this->db->from('tb_sppd_pengikut');
								$this->db->join('tb_pegawai', 'tb_sppd_pengikut.pegawai = tb_pegawai.id_user');
								$this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
								$this->db->where('id_pelaksana', $data->id_pelaksana);
								$query = $this->db->get();
								foreach ($query->result() as $r => $data) { ?>
									<tr>
										<td></td>
										<td><?=$data->nip?></td>
										<td><?=$data->nama_lengkap."<br><i>".$data->nama_jabatan."</i>"?></td>
										<td><?=$data->uraian3?></td>
										<td class="text-center">
											<a href="<?=site_url('sppd/pengikut/'.$this->uri->segment(3).'/del/'.$data->id_pengikut)?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-danger">Hapus Pengikut</a>
							            </td>
									</tr>
								<?php
								}
							} 
						} else {
							echo "<tr><td colspan=\"5\" align=\"center\">Tidak ada data</td></tr>";
						} ?>
					</tbody>
				</table>
				<script type="text/javascript">
					// $('#data').DataTable({
			  //           columnDefs: [
			  //               {
			  //                   "searchable": false,
			  //                   "orderable": false,
			  //                   "targets": [0]
			  //               }
			  //           ],
			  //           "order": [4, "desc"]
			  //       });
				</script>
			</div>
		</div>
	</div>
</div>