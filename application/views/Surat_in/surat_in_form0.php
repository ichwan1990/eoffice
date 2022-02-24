<div class="page-title">
	<div class="title_left">
		<h3><?=$judul?> Surat Masuk</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('surat_masuk')?>?s=<?=@$_GET['s']?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<?php $attr = array('class' => 'form-horizontal form-label-left', 'autocomplete' => 'off');
				echo form_open_multipart('surat_masuk/proses', $attr); ?>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">No. Agenda <span class="required">*</span></label>
						<div class="col-md-2 col-sm-3 col-xs-12">
							<input type="hidden" name="id" value="<?=$row->id_surat_in?>">
							<input type="text" name="no_agenda" class="form-control col-md-6 col-xs-12" value="<?=$row->no_agenda?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Kategori *</label>
						<div class="col-md-4 col-sm-5 col-xs-12">
							<?=form_dropdown('kategori', $kategori, $selectedkategori, ['class' => 'form-control', 'id' => 'kategori', 'required' => 'required'])?>
						</div>
					</div>
					<div class="form-group">
						<label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">No. Surat *</label>
						<div class="col-md-4 col-sm-5 col-xs-12">
							<input type="text" name="no_surat" class="form-control col-md-6 col-xs-12" value="<?=$row->no_surat?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Surat *</label>
						<div class="col-md-3 col-sm-4 col-xs-12">
							<input type="date" name="tgl_surat" class="form-control col-md-6 col-xs-12" value="<?=$row->tgl_surat?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="middle-name" class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Selesai</label>
						<div class="col-md-3 col-sm-4 col-xs-12">
							<input type="date" name="tgl_selesai" class="form-control col-md-6 col-xs-12" value="<?=$row->tgl_selesai?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Pengirim Surat *</label>
						<div class="col-md-5 col-sm-6 col-xs-12">
							<div class="radio">
								<label>
									<input type="radio" value="1" name="input_pengirim" id="input_pengirim1" required <?=$row->input_pengirim == "1" ? "checked" : null?>> Input Manual
								</label>
							</div>
							<div class="radio" id="div_pengirim1">
								<input type="text" name="pengirim" id="pengirim1" class="form-control col-md-6 col-xs-12" value="<?=$row->pengirim?>" required>
							</div><br>
							<div class="radio"> 
								<label>
									<input type="radio" value="2" name="input_pengirim" id="input_pengirim2" <?=$row->input_pengirim == "2" ? "checked" : null?>> Data Master Pengirim
								</label>
							</div>
							<div class="radio" id="div_pengirim2">
								<?php
								echo form_dropdown('pengirim', $pengirim, $selectedpengirim, ['class' => 'form-control', 'required' => 'required', 'id' => 'pengirim2'])?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Perihal *</label>
						<div class="col-md-5 col-sm-6 col-xs-12">
							<textarea name="hal" class="form-control col-md-6 col-xs-12" required><?=$row->perihal?></textarea>
						</div>
					</div>
					<div class="form-group hidden">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Isi Ringkas *</label>
						<div class="col-md-5 col-sm-6 col-xs-12">
							<textarea name="isi" class="form-control col-md-6 col-xs-12" rows="5" ><?=$row->isi_ringkas?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Sifat Surat *</label>
						<div class="col-md-5 col-sm-6 col-xs-12">
							<div class="radio">
								<label>
									<input type="radio" value="Biasa" name="sifat" required <?=$row->sifat_surat == "Biasa" ? "checked" : null?>> Biasa
								</label>
							</div>
							<div class="radio"> 
								<label>
									<input type="radio" value="Segera" name="sifat" <?=$row->sifat_surat == "Segera" ? "checked" : null?>> Segera
								</label>
							</div>
							<div class="radio"> 
								<label>
									<input type="radio" value="Rahasia" name="sifat" <?=$row->sifat_surat == "Rahasia" ? "checked" : null?>> Rahasia
								</label>
							</div>
							<div class="radio"> 
								<label>
									<input type="radio" value="Penting" name="sifat" <?=$row->sifat_surat == "Penting" ? "checked" : null?>> Penting
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">File Surat</label>
						<div class="col-md-3 col-sm-4 col-xs-12">
							<input type="file" name="file_surat" class="form-control col-md-6 col-xs-12">
							<small>(Biarkan kosong jika tidak ada)</small>
						</div>
					</div>
					<div class="form-group hidden">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Keterangan</label>
						<div class="col-md-5 col-sm-6 col-xs-12">
							<textarea name="ket" class="form-control col-md-6 col-xs-12" rows="4"><?=$row->keterangan?></textarea>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
							<input type="submit" name="<?=$page?>" value="Simpan" class="btn btn-success">
							<button class="btn btn-default" type="reset">Reset</button>
						</div>
					</div>
				</form>
				<script type="text/javascript">
				function set_required() {
					if($('#input_pengirim1').is(':checked')) {
						$('#pengirim1').attr('name', 'pengirim');
						$('#pengirim2').removeAttr('name');
						$('#pengirim2').attr('readonly', 'readonly');
						$('#pengirim1').removeAttr('readonly');
						$('#pengirim2').val('');
						// $('#pengirim2').removeAttr('required');
					} else if($('#input_pengirim2').is(':checked')) {
						$('#pengirim2').attr('name', 'pengirim');
						$('#pengirim1').removeAttr('name');
						$('#pengirim1').attr('readonly', 'readonly');
						$('#pengirim2').removeAttr('readonly');
						$('#pengirim1').val('');
					}
				}

				window.onload = set_required();
				$('#input_pengirim1').click(function() {
					set_required();
				})
				$('#input_pengirim2').click(function() {
					set_required();
				})
		
				$("#kategori").select2({
					theme: "bootstrap"
				})
				
				$("#pengirim2").select2({
					theme: "bootstrap"
				});
				</script>
			</div>
		</div>
	</div>
</div>