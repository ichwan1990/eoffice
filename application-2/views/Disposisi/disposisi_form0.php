<div class="page-title">
	<div class="title_left">
		<h3><?=$judul?> Disposisi</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('disposisi/'.$this->uri->segment(2).'?h=2')?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_title">
				<table class="table table-bordered" style="margin-bottom: 5px;">
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
			<div class="x_content">
				<form action="<?=site_url('disposisi/proses')?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="hidden" name="id_surat_in" value="<?=$surat->id_surat_in?>">
								<input type="hidden" name="id" value="<?=$row->id_disposisi?>">
								<label>
									<input type="radio" value="1" name="input_teruskan" id="input_teruskan1" required <?=$row->input_teruskan == "1" || $row->input_teruskan == null ? "checked" : null?>> Diteruskan kepada :
								</label>
								<?php
								$no = 1;
								if($tujuan != null) {
									foreach ($tujuan as $tjn) { ?>
										<div class="checkbox" style="margin-left: 15px;">
											<label>
												<input type="checkbox" name="tujuan[]" id="tujuan-<?=$no++?>" class="tujuan" value="<?=$tjn->id_user?>"> <?=$tjn->nama_jabatan?><br><?=$tjn->nama_lengkap?>
											</label>
										</div>
									<?php
									}
								} else {
									echo "<br><span>Belum ada user pegawai</span>";
								}
								?>
							</div>
							<div class="form-group">
								<label>
									<input type="radio" value="2" name="input_teruskan" id="input_teruskan2" <?=$row->input_teruskan == "2" ? "checked" : null?>> Arsipkan
								</label>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="form-group hidden">
								<label>Dengan hormat harap :</label>
								<?php
								$no2 = 1;
								foreach ($disp_perintah as $dp) { ?>
									<div class="checkbox" style="margin-left: 10px;">
										<label>
											<input type="checkbox" name="perintah[]" id="perintah-<?=$no2++?>" value="<?=$dp->id_disp_perintah?>"> <?=$dp->isi_perintah?>
										</label>
									</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="form-group">
								<label>Catatan :</label>
								<textarea name="catatan" class="form-control" rows="7"><?=$row->catatan?></textarea>
							</div>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<input type="submit" name="<?=$page?>" value="Simpan" class="btn btn-success">
						<button class="btn btn-default" type="reset">Reset</button>
					</div>
				</form>
				<script type="text/javascript">
				function set_click() {
					if($('#input_teruskan1').is(':checked')) {
						$('.tujuan').removeAttr('onclick');
					} else if($('#input_teruskan2').is(':checked')) {
						$('.tujuan').attr('onclick', 'return false');
						$('.tujuan').prop('checked', false);
					}
				}

				window.onload = set_click();
				$('#input_teruskan1').click(function() {
					set_click();
				})
				$('#input_teruskan2').click(function() {
					set_click();
				})
				</script>
			</div>
		</div>
	</div>
</div>