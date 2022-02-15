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
										    <option value="b">Bulan ini</option>
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
								<th>No. Surat<br>Tgl.Surat / Tgl.Terima</th>
								<th>Pengirim<br>Sifat Surat</th>
								<th>Perihal</br>Kategori</th>
								<th>Dokumen<br>Tgl.Selesai</th>
								<th>
								    <i class="fa fa-gear"></i>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							$nosurat = 1;
							foreach ($row as $r => $data) {
							    if ( $nosurat != $data->no_agenda) { //Untuk menghilangkan disposisi double
							         
								if(@$_GET['s'] == '' || @$_GET['s'] == 'A') { 
							        
							    ?>
									<tr>
										<td align='center'><?=$no++."<hr>".$data->no_agenda?></td>
										<td><?=$data->no_surat."<hr>".tgl_bln_indo($data->tgl_surat)." / ".tgl_bln_indo($data->tgl_catat)?></td>
										<td><?php
										    echo $data->pengirim."<hr>";
										    
										    if($data->sifat_surat == 'Biasa'){
                								echo '<b><a class="btn btn-sm btn-default">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Segera'){
                							    echo '<b><a class="btn btn-sm btn-warning">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Rahasia'){
                							    echo '<b><a class="btn btn-sm btn-dark">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Penting'){
                							    echo '<b><a class="btn btn-sm btn-danger">'.$data->sifat_surat .'</a></b>';
                							}
										?>
										</td>
										<td><p><?=$data->perihal."<hr>".$data->nama_kategori?></p></td>
										<td>
											<?php 
											if($data->file_surat == '') {
												echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
											} else {
												echo '<b>File</b> : <a href="./uploads/surat_masuk/'.$data->file_surat.'" target="_blank" class="btn btn-xs btn-success">Baca</a>';
											}
											echo "</br>";
											if ($data->tgl_selesai != "0000-00-00"){
    											 echo "<i class='fa fa-check-circle'> ".tgl_indo($data->tgl_selesai). "</i>" ;
    										}
											?>
										</td>
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
														<a href="<?=site_url('disposisi/'.$data->id_surat_in.'?h=2')?>" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-file-text"></i> Lihat Disposisi</a>
													</div>
												<?php
												}
											} else {
												if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0 ) {
													?>
													<div>
														<a href="<?=site_url('disposisi/'.$data->id_surat_in.'?h=2')?>" class="btn btn-xs btn-primary"><i class="fa fa-file-text"></i> Input Disposisi</a>
													</div>
												<?php
												} else { ?>
													<div>
														<a href="<?=site_url('disposisi/'.$data->id_surat_in.'?h=2')?>" class="btn btn-xs btn-info"><i class="fa fa-file-text"></i> Lihat Disposisi</a>
													</div>
												<?php
												}
											}
											?>
											
										</td>
									</tr>
								<?php
							    } else if(@$_GET['s'] == 'n') {$nosurat = $data->no_surat;
									if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) {
									?>
									<tr>
										<td align='center'><?=$no++."<hr>".$data->no_agenda?></td>
										<td><?=$data->no_surat."<hr>".tgl_bln_indo($data->tgl_surat)." / ".tgl_bln_indo($data->tgl_catat)?></td>
										<td><?php
										    echo $data->pengirim."<hr>";
										    
										    if($data->sifat_surat == 'Biasa'){
                								echo '<b><a class="btn btn-sm btn-default">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Segera'){
                							    echo '<b><a class="btn btn-sm btn-warning">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Rahasia'){
                							    echo '<b><a class="btn btn-sm btn-dark">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Penting'){
                							    echo '<b><a class="btn btn-sm btn-danger">'.$data->sifat_surat .'</a></b>';
                							}
										?>
										</td>
										<td><p><?=$data->perihal."<hr>".$data->nama_kategori?></p></td>
										<td>
											<?php 
											if($data->file_surat == '') {
												echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
											} else {
												echo '<b>File</b> : <a href="./uploads/surat_masuk/'.$data->file_surat.'" target="_blank" class="btn btn-xs btn-success">Baca</a>';
											} 
											echo "</br>";
											if ($data->tgl_selesai != "0000-00-00"){
    											 echo "<i class='fa fa-check-circle'> ".tgl_indo($data->tgl_selesai). "</i>" ;
    										}
											?>
										</td>
										<td class="text-center">
											<?php if($this->session->userdata('level_user') == '1') { ?>
												<div>
													<a href="<?=site_url('surat_masuk/edit/'.$data->id_surat_in)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
													<a href="<?=site_url('surat_masuk/del/'.$data->id_surat_in)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
												</div>
											<?php }
											if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0 ) { ?>
												<div>
													<a href="<?=site_url('disposisi/'.$data->id_surat_in.'?h=2')?>" class="btn btn-xs btn-primary"><i class="fa fa-file-text"></i> Input Disposisi</a>
												</div>
											<?php
											} else { ?>
												<div>
													<a href="<?=site_url('disposisi/'.$data->id_surat_in.'?h=2')?>" class="btn btn-xs btn-info"><i class="fa fa-file-text"></i> Lihat Disposisi</a>
												</div>
											<?php
											} ?>
											</br>
											<i><?= tgl_indo($data->tgl_selesai) ?></i>
										</td>
									</tr>
									<?php
									}
							    } else if(@$_GET['s'] == 'b') {$nosurat = $data->no_surat;
							        $bulan = date('m');
							        $bln_saja = substr($data->tgl_catat,5,2);
							        if ($bln_saja == $bulan ){
									if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() != 0) {
									?>
									<tr>
										<td align='center'><?=$no++."<hr>".$data->no_agenda?></td>
										<td><?=$data->no_surat."<hr>".tgl_bln_indo($data->tgl_surat)." / ".tgl_bln_indo($data->tgl_catat)?></td>
										<td><?php
										    echo $data->pengirim."<hr>";
										    
										    if($data->sifat_surat == 'Biasa'){
                								echo '<b><a class="btn btn-sm btn-default">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Segera'){
                							    echo '<b><a class="btn btn-sm btn-warning">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Rahasia'){
                							    echo '<b><a class="btn btn-sm btn-dark">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Penting'){
                							    echo '<b><a class="btn btn-sm btn-danger">'.$data->sifat_surat .'</a></b>';
                							}
										?>
										</td>
										<td><p><?=$data->perihal."<hr>".$data->nama_kategori?></p></td>
										<td>
											<?php 
											if($data->file_surat == '') {
												echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
											} else {
												echo '<b>File</b> : <a href="./uploads/surat_masuk/'.$data->file_surat.'" target="_blank" class="btn btn-xs btn-success">Baca</a>';
											} 
											echo "</br>";
											if ($data->tgl_selesai != "0000-00-00"){
    											 echo "<i class='fa fa-check-circle'> ".tgl_indo($data->tgl_selesai). "</i>" ;
    										}
											?>
										</td>
										<td class="text-center">
											<?php if($this->session->userdata('level_user') == '1') { ?>
												<div>
													<a href="<?=site_url('surat_masuk/edit/'.$data->id_surat_in)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
													<a href="<?=site_url('surat_masuk/del/'.$data->id_surat_in)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
												</div>
											<?php }
											if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0 ) { ?>
												<div>
													<a href="<?=site_url('disposisi/'.$data->id_surat_in.'?h=2')?>" class="btn btn-xs btn-primary"><i class="fa fa-file-text"></i> Input Disposisi</a>
												</div>
											<?php
											} else { ?>
												<div>
													<a href="<?=site_url('disposisi/'.$data->id_surat_in.'?h=2')?>" class="btn btn-xs btn-info"><i class="fa fa-file-text"></i> Lihat Disposisi</a>
												</div>
											<?php
											} ?>
											</br>
											<i><?= tgl_indo($data->tgl_selesai) ?></i>
										</td>
									</tr>
									<?php
									}
							    }
								} else if(@$_GET['s'] == 'y') {$nosurat = $data->no_surat;
									if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() != 0) {
									?>
									<tr>
										<td align='center'><?=$no++."<hr>".$data->no_agenda?></td>
										<td><?=$data->no_surat."<hr>".tgl_bln_indo($data->tgl_surat)." / ".tgl_bln_indo($data->tgl_catat)?></td>
										<td><?php
										    echo $data->pengirim."<hr>";
										    
										    if($data->sifat_surat == 'Biasa'){
                								echo '<b><a class="btn btn-sm btn-default">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Segera'){
                							    echo '<b><a class="btn btn-sm btn-warning">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Rahasia'){
                							    echo '<b><a class="btn btn-sm btn-dark">'.$data->sifat_surat .'</a></b>';
                							} else if ($data->sifat_surat == 'Penting'){
                							    echo '<b><a class="btn btn-sm btn-danger">'.$data->sifat_surat .'</a></b>';
                							}
										?>
										</td>
										<td><p><?=$data->perihal."<hr>".$data->nama_kategori?></p></td>
										<td>
											<?php
											if($data->file_surat == '') {
												echo '<b>File</b> : <i>Tidak ada file yang diupload</i>';
											} else {
												echo '<b>File</b> : <a href="./uploads/surat_masuk/'.$data->file_surat.'" target="_blank" class="btn btn-xs btn-success">Baca</a>';
											} 
											echo "</br>";
											if ($data->tgl_selesai != "0000-00-00"){
    											 echo "<i class='fa fa-check-circle'> ".tgl_indo($data->tgl_selesai). "</i>" ;
    										}
											?>
										</td>
										<td class="text-center">
											<?php if($this->session->userdata('level_user') == '1') { ?>
												<div>
													<a href="<?=site_url('surat_masuk/edit/'.$data->id_surat_in)?>" class="btn btn-xs btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
													<a href="<?=site_url('surat_masuk/del/'.$data->id_surat_in)?>" onclick="return confirm('Apakah Anda yakin?')"  class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
												</div>
											<?php }
											if($this->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) { ?>
												<div>
													<a href="<?=site_url('disposisi/'.$data->id_surat_in.'?h=2')?>" class="btn btn-xs btn-primary"><i class="fa fa-file-text"></i> Input Disposisi</a>
												</div>
											<?php
											} else { ?>
												<div>
													<a href="<?=site_url('disposisi/'.$data->id_surat_in.'?h=2')?>" class="btn btn-xs btn-info"><i class="fa fa-file-text"></i> Lihat Disposisi</a>
												</div>
											<?php
											} ?>
											</br>
											<i><?= tgl_indo($data->tgl_selesai) ?></i>
										</td>
									</tr>
									<?php
									}
								}
							       $nosurat = $data->no_agenda; //Untuk menghilangkan surat yang doubel disposisi nya.
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