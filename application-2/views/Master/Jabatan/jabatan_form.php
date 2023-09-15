<div class="card">
	<div class="card-header">
		<a href="<?= site_url('jabatan') ?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<div class="col-md-6">
			<form action="<?= site_url('jabatan/proses') ?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
				<div class="form-group">
					<label class="control-label">Nama Jabatan <span class="required">*</span></label>
					<input type="hidden" name="id" value="<?= $row->id_jabatan ?>">
					<input type="text" name="nama" class="form-control" value="<?= $row->nama_jabatan ?>" required>
				</div>
				<div class="form-group">
					<label class="control-label">Kode Jabatan *</label>
					<input type="text" name="kode" class="form-control" value="<?= $row->kode_surat ?>" required>
				</div>
				<div class="form-group">
					<label class="control-label">Level *</label>
					<select name="level" class="form-control" required>
						<option value=""></option>
						<!-- <option value="1">Level 1 (Pengagenda)</option> -->
						<option value="2" <?= $row->level_jabatan == '2' ? 'selected' : null ?>>Level 1 (Direktur)</option>
						<option value="3" <?= $row->level_jabatan == '3' ? 'selected' : null ?>>Level 2 (Wakil Direktur)</option>
						<option value="4" <?= $row->level_jabatan == '4' ? 'selected' : null ?>>Level 3 (Kepala Bidang)</option>
						<option value="5" <?= $row->level_jabatan == '5' ? 'selected' : null ?>>Level 4 (Kepala Seksi)</option>
					</select>
					<div class="form-group">
						<label class="control-label">Atasan</label>
						<?= form_dropdown('parent_jabatan', $jabatan2, $selectedjabatan2, ['class' => 'form-control', 'id' => 'atasan', 'required' => 'required']) ?>
					</div>
					<div class="form-group">
						<label for="middle-name" class="control-label">Uraian</label>
						<textarea name="uraian" class="form-control" <?php if ($row->uraian == '(tidak ada jabatan)') {
																			echo "readonly";
																		} ?>><?= $row->uraian ?></textarea>
					</div>
				</div>
		</div>
		<div class="card-footer">
			<div class="form-group">
				<div class="col-sm-6 col-xs-12 col-sm-offset-4">
					<input type="submit" name="<?= $page ?>" value="Simpan" class="btn btn-success">
					<button class="btn btn-default" type="reset">Reset</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	<script>
		$("#atasan").select2({
			theme: "bootstrap"
		});
	</script>