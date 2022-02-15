<div class="page-title">
	<div class="title_left">
		<h3><?= $judul ?> Jabatan Pegawai</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?= site_url('jabatan') ?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form action="<?= site_url('jabatan/proses') ?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Nama Jabatan <span class="required">*</span></label>
						<div class="col-sm-5 col-xs-12">
							<input type="hidden" name="id" value="<?= $row->id_jabatan ?>">
							<input type="text" name="nama" class="form-control col-md-7 col-xs-12" value="<?= $row->nama_jabatan ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Kode Jabatan *</label>
						<div class="col-sm-5 col-xs-12">
							<input type="text" name="kode" class="form-control col-md-7 col-xs-12" value="<?= $row->kode_surat ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Level *</label>
						<div class="col-sm-3 col-xs-12">
							<select name="level" class="form-control" required>
								<option value=""></option>
								<!-- <option value="1">Level 1 (Pengagenda)</option> -->
								<option value="2" <?= $row->level_jabatan == '2' ? 'selected' : null ?>>Level 1 (Direktur)</option>
								<option value="3" <?= $row->level_jabatan == '3' ? 'selected' : null ?>>Level 2 (Wakil Direktur)</option>
								<option value="4" <?= $row->level_jabatan == '4' ? 'selected' : null ?>>Level 3 (Kepala Bidang)</option>
								<option value="5" <?= $row->level_jabatan == '5' ? 'selected' : null ?>>Level 4 (Kepala Seksi)</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Atasan</label>
						<div class="col-sm-5 col-xs-12">
							<?= form_dropdown('parent_jabatan', $jabatan2, $selectedjabatan2, ['class' => 'form-control', 'id' => 'atasan', 'required' => 'required']) ?>
						</div>
					</div>
					<div class="form-group">
						<label for="middle-name" class="control-label col-sm-4 col-xs-12">Uraian</label>
						<div class="col-sm-5 col-xs-12">
							<textarea name="uraian" class="form-control col-md-7 col-xs-12" <?php if ($row->uraian == '(tidak ada jabatan)') {
																								echo "readonly";
																							} ?>><?= $row->uraian ?></textarea>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-sm-6 col-xs-12 col-sm-offset-4">
							<input type="submit" name="<?= $page ?>" value="Simpan" class="btn btn-success">
							<button class="btn btn-default" type="reset">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$("#atasan").select2({
		theme: "bootstrap"
	});
</script>