<div class="page-title">
	<div class="title_left">
		<h3><?= $judul ?> Surat Keluar</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?= site_url('surat_keluar') ?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<?php $attr = array('class' => 'form-horizontal form-label-left', 'autocomplete' => 'off');
				echo form_open_multipart('surat_keluar/proses', $attr); ?>
				<div class="form-group">
					<label class="control-label col-md-4 col-sm-4 col-xs-12">No. Agenda <span class="required">*</span></label>
					<div class="col-md-2 col-sm-3 col-xs-12">
						<input type="hidden" name="id" value="<?= $row->id_surat_out ?>">
						<input type="number" name="no_agenda" id="no_agenda" class="form-control col-md-7 col-xs-12" value="<?= $row->no_agenda ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4 col-sm-4 col-xs-12">Kategori *</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<?= form_dropdown('kategori', $kategori, $selectedkategori, ['id' => 'kategori', 'class' => 'form-control', 'id' => 'kategori', 'required' => 'required']) ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4 col-sm-4 col-xs-12">Pengirim *</label>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<?= form_dropdown('pengolah', $pengolah, $selectedpengolah, ['id' => 'pengolah', 'class' => 'form-control', 'required' => 'required']) ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4 col-sm-4 col-xs-12">No. Surat *</label>
					<div class="col-md-5 col-sm-5 col-xs-12">
						<input type="text" name="no_surat" id="no_surat" class="form-control col-md-7 col-xs-12" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Surat *</label>
					<div class="col-md-3 col-sm-4 col-xs-12">
						<input type="date" name="tgl_surat" id="tgl_surat" class="form-control col-md-3 col-sm-3 col-xs-12" value="<?= $row->tgl_surat ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4 col-sm-4 col-xs-12">Perihal *</label>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<textarea name="hal" class="form-control col-md-7 col-xs-12" required><?= $row->perihal ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4 col-sm-4 col-xs-12">Isi Ringkas </label>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<textarea name="isi" class="form-control col-md-7 col-xs-12" rows="5"><?= $row->isi_ringkas ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4 col-sm-4 col-xs-12">Tujuan Surat *</label>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<?= form_dropdown('tujuan', $tujuan, $selectedtujuan, ['class' => 'form-control', 'required' => 'required']) ?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4 col-sm-4 col-xs-12">File Surat</label>
					<div class="col-md-3 col-sm-4 col-xs-12">
						<input type="file" name="file_surat" class="form-control col-md-7 col-xs-12">
						<small>(Biarkan kosong jika tidak ada)</small>
					</div>
				</div>
				<div class="form-group hidden">
					<label class="control-label col-md-4 col-sm-4 col-xs-12">Keterangan</label>
					<div class="col-md-5 col-sm-6 col-xs-12">
						<textarea name="ket" class="form-control col-md-7 col-xs-12" rows="3"><?= $row->keterangan ?></textarea>
					</div>
				</div>
				<div class="ln_solid"></div>
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
						<input type="submit" name="<?= $page ?>" value="Simpan" class="btn btn-success">
						<button class="btn btn-default" type="reset">Reset</button>
					</div>
				</div>
				</form>
				<script type="text/javascript">
					function set_nosurat() {
						var no_agenda = $('#no_agenda').val();
						var kat = $('#kategori option:selected').text();
						if (kat != '') {
							var kategori = kat.slice(0, kat.indexOf('-')).trim();
						} else {
							var kategori = '0';
						}
						var pgh = $('#pengolah').val();
						if (pgh != '') {
							var pengolah = pgh;
						} else {
							var pengolah = '0';
						}
						const month = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
						d = new Date;
						var year = d.getFullYear();
						let bulan = month[d.getMonth()];
						var no_surat = no_agenda + '.' + pengolah + '.' + kategori + '.RS-MP.' + bulan + '.' + year;
						$('#no_surat').val(no_surat);
						// alert(no_surat);
					}

					$("#kategori").change(function() {
						set_nosurat();
					});

					$("#pengolah").change(function() {
						set_nosurat();
					});

					window.onload = set_nosurat();

					$("#pengolah").select2({
						theme: "bootstrap"
					});
				</script>
			</div>
		</div>
	</div>
</div>