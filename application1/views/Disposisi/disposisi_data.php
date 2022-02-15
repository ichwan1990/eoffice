<div class="page-title">
	<div class="title_left">
		<h3>Disposisi Surat Masuk</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content">
				<table class="table">
					<thead>
						<tr>
							<td>Surat dari :<br><b><?=$surat->pengirim?></b></td>
							<td>Tanggal Diterima :<br><b><?=tgl_indo($surat->tgl_catat)?></b></td>
						</tr>
						<tr>
							<td>No. Surat :<br><b><?=$surat->no_surat?></b></td>
							<td>No. Agenda :<br><b><?=$surat->no_agenda?></b></td>
						</tr>
						<tr>
							<td>Tanggal Surat :<br><b><?=tgl_indo($surat->tgl_surat)?></b></td>
							<td>Sifat :<br>
								<b><?=$surat->sifat_surat?></b>
							</td>
						</tr>
						<tr>
							<td colspan="2">Perihal :<br><b><?=$surat->perihal?></b></td>
						</tr>
					</thead>
				</table>
			</div>
			<div class="x_title">
				<div class="pull-left">
					<?php
					if($this->session->userdata('level_jabatan') != 2 && $this->session->userdata('level_user') != 1) { ?>
						<a href="<?=current_url().'?h=1'?>" class="btn btn-sm btn-primary">History Disposisi Atasan</a> 
					<?php
					}
					if(($this->session->userdata('level_jabatan') != 5 && $this->session->userdata('level_user') != 1) || $this->session->userdata('level_user') == 1) {
						if($this->session->userdata('level_user') == 2 || $this->session->userdata('level_user') == 1) {
							$t = "History Disposisi";
						} else {
							$t = "History Disposisi Pribadi dan Bawahan";
						} ?>
						<a href="<?=current_url().'?h=2'?>" class="btn btn-sm btn-primary"><?=$t?></a>
					<?php
					} ?>
				</div>
				<div class="pull-right">
					<a href="<?=site_url('surat_masuk')?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
					<?php
					if($this->disposisi->cek_ada_disposisi($this->uri->segment('2'))->num_rows() == 0 && $this->session->userdata('level_jabatan') != 5) { ?>
						<a href="<?=site_url('disposisi/'.$this->uri->segment(2).'/add')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Disposisi</a> 
					<?php } ?>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php
			$h = @$_GET['h'];
			if($h != null) {
			?>
			<div class="x_content">
				<table class="table table-bordered" id="data">
					<thead>
						<tr>
							<th>#</th>
							<th>Disposisi Oleh</th>
							<th>Diteruskan Kepada</th>
							<th>Dengan Hormat Harap</th>
							<th>Catatan Disposisi</th>
							<th><i class="fa fa-gear"></i></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						if($h == 1) {
							$row = $this->disposisi->get_disposisi_atasan($this->session->userdata('idjabatan'), $this->uri->segment('2'))->result();
						} else if($h == 2) {
							if($this->session->userdata('level_user') == 1) {
								$row = $this->disposisi->get_disposisi_all($this->uri->segment('2'))->result();
							} else {
								$row = $this->disposisi->get_disposisi_bawahan($this->session->userdata('idjabatan'), $this->uri->segment('2'))->result();
							}
						}
						foreach ($row as $r => $data) { ?>
							<tr>
								<td><?=$no++?></td>
								<td><?=$data->nama_jabatan?><br><?=$data->nama_lengkap?></td>
								<td>
									<?php
									if($data->input_teruskan == '1') {
										$row_tjn = $this->disposisi->disp_detail_tujuan($data->id_disposisi)->result();
										foreach ($row_tjn as $key) {
											echo "<li style=\"margin-left:5px;\">".$key->nama_jabatan."<br>".$key->nama_lengkap."</li>";
										}
									} else {
										echo "<b><i>Diarsipkan</i></b>";
									}
									?>
								</td>
								<td>
									<?php
									$row_tjn = $this->disposisi->disp_detail_perintah($data->id_disposisi)->result();
									foreach ($row_tjn as $key) {
										echo "<li style=\"margin-left:5px;\">".$key->isi_perintah."</li>";
									}
									?>
								</td>
								<td><?=$data->catatan?></td>
								<td class="text-center">
									<!-- <a href="<?=site_url('disposisi/'.$this->uri->segment(2).'/detail/'.$data->id_disposisi)?>" class="btn btn-xs btn-info">Detail</a> -->
									<?php if($data->user_input == $this->session->userdata('iduser')) { ?>
										<a href="<?=site_url('disposisi/'.$this->uri->segment(2).'/del/'.$data->id_disposisi)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
							        <?php } ?>
					            </td>
							</tr>
						<?php } ?>
					</tbody>
				</table> 
				<script type="text/javascript">
					$('#data').DataTable();
				</script>
			</div>
			<?php } ?>
		</div>
	</div>
</div>