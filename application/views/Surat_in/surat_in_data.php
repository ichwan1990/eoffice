<div class="page-title">
	<div class="title_left">
		<h3>Data Surat Masuk</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<?php if($this->session->userdata('level_user') == '1') { ?>
				<div class="x_title" align="right">
					<a href="<?=site_url('surat_masuk/add')?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Surat Masuk</a>
					<div class="clearfix"></div>
				</div>
			<?php }
			if($this->session->userdata('level_user') != '1') { ?>
				<div class="x_content">
					<div class="row">
						<div class="col-sm-6 col-xs-12"> 
							<form action="<?=site_url('surat_masuk')?>" method="get">
								<div class="row">
									<div class="col-sm-6 col-xs-8">
										<select name="s" class="form-control" required>
											<option value="A">Semua Surat</option>
											<option value="n" <?=@$_GET['s'] == 'n' ? 'selected' : null?>>Belum Disposisi</option>
											<option value="y" <?=@$_GET['s'] == 'y' ? 'selected' : null?>>Sudah Disposisi</option>
										</select>
									</div>
									<div class="col-sm-4">
										<input type="submit" value="Filter" class="btn btn-success">
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="ln_solid"></div>
				<?php } ?>
				<div class="table-responsive">
					<table class="table table-bordered" id="data">
						<thead>
							<tr>
								<th>No. Agenda</th>
								<th>No. Surat<br>Tgl Surat</th>
								<th>Pengirim</th>
								<th>Perihal</th>
								<th>Isi Ringkas<br>File</th>
								<th>Ket.</th>
								<th><i class="fa fa-gear"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($row as $r => $data) {
								if(@$_GET['s'] == '' || @$_GET['s'] == 'A') { ?>
									<tr>
										<td align='center'><?=$no++."<hr>".$data->no_agenda?></td>
										<td><?=$data->no_surat."<hr>".tgl_bln_indo($data->tgl_surat)?></td>
										<td><?=$data->pengirim?></td>
										<td><?=$data->perihal?></td>
										<td>
											<?php echo $data->file_surat."<hr>";
											if($data->file_surat == '') {
												echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
											} else {
												echo '<b>File</b> : <a href="./uploads/surat_masuk/'.$data->file_surat.'" target="_blank" class="btn btn-xs btn-warning">Download</a>';
											} ?>
										</td>
										<td><?=$data->keterangan?></td>
										<td class="text-center">
											<?php if($this->session->userdata('level_user') == '1') { ?>
												<div>
													<a href="<?=site_url('surat_masuk/edit/'.$data->id_surat_in)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
													<a href="<?=site_url('surat_masuk/del/'.$data->id_surat_in)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
												</div>
											<?php }
											if($this->session->userdata('level_user') == '1') {
												if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) {
													?>
													<div>
														<button class="btn btn-xs btn-default">Belum Ada Disposisi</button>
													</div>
												<?php
												} else { ?>
													<div>
														<a href="<?=site_url('disposisi/'.$data->id_surat_in)?>" class="btn btn-xs btn-info"><i class="fa fa-file-text"></i> Lihat Disposisi</a>
													</div>
												<?php
												}
											} else {
												if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0 && $this->session->userdata('level_jabatan') != 5) {
													?>
													<div>
														<a href="<?=site_url('disposisi/'.$data->id_surat_in)?>" class="btn btn-xs btn-primary"><i class="fa fa-file-text"></i> Input Disposisi</a>
													</div>
												<?php
												} else { ?>
													<div>
														<a href="<?=site_url('disposisi/'.$data->id_surat_in)?>" class="btn btn-xs btn-info"><i class="fa fa-file-text"></i> Lihat Disposisi</a>
													</div>
												<?php
												}
											} ?>
										</td>
									</tr>
								<?php
								} else if(@$_GET['s'] == 'n') {
									if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) {
									?>
									<tr>
										<td align='center'><?=$no++."<hr>".$data->no_agenda?></td>
										<td><?=$data->no_surat."<hr>".tgl_bln_indo($data->tgl_surat)?></td>
										<td><?=$data->pengirim?></td>
										<td><?=$data->perihal?></td>
										<td>
											<?php echo $data->isi_ringkas."<hr>";
											if($data->file_surat == '') {
												echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
											} else {
												echo '<b>File</b> : <a href="./uploads/surat_masuk/'.$data->file_surat.'" target="_blank">Download</a>';
											} ?>
										</td>
										<td><?=$data->keterangan?></td>
										<td class="text-center">
											<?php if($this->session->userdata('level_user') == '1') { ?>
												<div>
													<a href="<?=site_url('surat_masuk/edit/'.$data->id_surat_in)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
													<a href="<?=site_url('surat_masuk/del/'.$data->id_surat_in)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
												</div>
											<?php }
											if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0 && $this->session->userdata('level_user') != '5') { ?>
												<div>
													<a href="<?=site_url('disposisi/'.$data->id_surat_in)?>" class="btn btn-xs btn-primary"><i class="fa fa-file-text"></i> Input Disposisi</a>
												</div>
											<?php
											} else { ?>
												<div>
													<a href="<?=site_url('disposisi/'.$data->id_surat_in)?>" class="btn btn-xs btn-info"><i class="fa fa-file-text"></i> Lihat Disposisi</a>
												</div>
											<?php
											} ?>
										</td>
									</tr>
									<?php
									}
								} else if(@$_GET['s'] == 'y') {
									if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() != 0) {
									?>
									<tr>
										<td><?=$no++?>.</td>
										<td><?=$data->no_surat."<hr>".tgl_bln_indo($data->tgl_surat)?></td>
										<td><?=$data->pengirim?></td>
										<td><?=$data->perihal?></td>
										<td>
											<?php echo $data->isi_ringkas."<hr>";
											if($data->file_surat == '') {
												echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
											} else {
												echo '<b>File</b> : <a href="./uploads/surat_masuk/'.$data->file_surat.'" target="_blank">Download</a>';
											} ?>
										</td>
										<td><?=$data->keterangan?></td>
										<td class="text-center">
											<?php if($this->session->userdata('level_user') == '1') { ?>
												<div>
													<a href="<?=site_url('surat_masuk/edit/'.$data->id_surat_in)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
													<a href="<?=site_url('surat_masuk/del/'.$data->id_surat_in)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
												</div>
											<?php }
											if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0 && $this->session->userdata('level_user') != 5) { ?>
												<div>
													<a href="<?=site_url('disposisi/'.$data->id_surat_in)?>" class="btn btn-xs btn-primary"><i class="fa fa-file-text"></i> Input Disposisi</a>
												</div>
											<?php
											} else { ?>
												<div>
													<a href="<?=site_url('disposisi/'.$data->id_surat_in)?>" class="btn btn-xs btn-info"><i class="fa fa-file-text"></i> Lihat Disposisi</a>
												</div>
											<?php
											} ?>
										</td>
									</tr>
									<?php
									}
								}
							}?>
						</tbody>
					</table> 
					<script type="text/javascript">
						$('#data').DataTable();
                    </script>
				</div>
			</div>
		</div>
	</div>
</div>