<div class="card">
	<div class="card-header">
		<a href="<?= site_url('tujuan_surat') ?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<form action="<?= site_url('tujuan_surat/proses') ?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
			<div class="form-group">
				<label class="control-label">Alamat Tujuan <span class="required">*</span></label>
				<input type="hidden" name="id" value="<?= $row->id_tujuan ?>">
				<input type="text" name="tujuan" class="form-control" value="<?= $row->alamat_tujuan ?>" required>
			</div>
			<div class="form-group">
				<label class="control-label">Uraian</label>
				<textarea name="uraian" class="form-control"><?= $row->uraian ?></textarea>
			</div>
	</div>
	<div class="card-footer">
		<div class="form-group">
			<input type="submit" name="<?= $page ?>" value="Simpan" class="btn btn-success">
			<button class="btn btn-default" type="reset">Reset</button>
		</div>
		</form>
	</div>
</div>