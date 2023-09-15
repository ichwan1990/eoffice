<div class="card">
	<div class="card-header">
		<a href="<?= site_url('kategori_surat') ?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<form action="<?= site_url('kategori_surat/proses') ?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
			<div class="form-group">
				<label class="control-label">Kode Kategori <span class="required">*</span></label>
				<input type="hidden" name="id" value="<?= $row->id_kategori ?>">
				<input type="text" name="kode" class="form-control" value="<?= $row->kode_kategori ?>" required>
			</div>
			<div class="form-group">
				<label class="control-label">Nama Kategori <span class="required">*</span></label>
				<input type="text" name="nama" class="form-control" value="<?= $row->nama_kategori ?>" required>
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