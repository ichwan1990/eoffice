<div class="card">
	<div class="card-header">
		<a href="<?= site_url('pegawai') ?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<form action="<?= site_url('pegawai/proses') ?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
					<div class="form-group">
						<label class="control-label">NIK <span class="required">*</span></label>
						<input type="hidden" name="id" value="<?= $row->id_user ?>">
						<input type="text" name="nip" class="form-control" value="<?= $row->nip ?>" required>
					</div>
					<div class="form-group">
						<label class="control-label">Nama Lengkap *</label>
						<input type="text" name="nama" class="form-control" value="<?= $row->nama_lengkap ?>" required>
					</div>
					<div class="form-group">
						<label class="control-label">Golongan</label>
						<?= form_dropdown('golongan', $golongan, $selectedgolongan, ['class' => 'form-control', 'id' => 'golongan']) ?>
					</div>
					<div class="form-group">
						<label class="control-label">Jabatan *</label>
						<?= form_dropdown('jabatan', $jabatan, $selectedjabatan, ['class' => 'form-control', 'id' => 'jabatan', 'required' => 'required']) ?>
					</div>
					<div class="form-group">
						<label class="control-label">Alamat *</label>
						<textarea name="alamat" class="form-control" rows="3" required><?= $row->alamat ?></textarea>
					</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">No. Telepon *</label>
					<input type="text" name="telp" class="form-control" value="<?= $row->no_telp ?>" required>
				</div>
				<div class="form-group">
					<label class="control-label">Email *</label>
					<input type="email" name="email" class="form-control" value="<?= $row->email ?>" required>
				</div>
				<div class="form-group">
					<label class="control-label">Username</label>
					<!-- <input type="text" name="username" class="form-control" pattern=".{5,}"> -->
					<input type="text" name="username" class="form-control" value="<?= $row->username ?>">
				</div>
				<div class="form-group">
					<label class="control-label">Password</label>
					<input type="text" name="password" class="form-control">
					<small>(Biarkan kosong jika password tidak diganti)</small>
				</div>
				<div class="form-group">
					<label class="control-label">Role Akun</label>
					<select name="level_user" class="form-control">
						<option value="5" <?= $row->level_user == '5' ? 'selected' : null ?>>Pegawai</option>
						<option value="1" <?= $row->level_user == '1' ? 'selected' : null ?>>Tata Usaha</option>
						<option value="2" <?= $row->level_user == '2' ? 'selected' : null ?>>Direktur</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
		<div class="form-group">
			<div class="row">
				<input type="submit" name="<?= $page ?>" class="btn m-1 btn-success" value="Simpan">
				<button class="btn m-1 btn-default" type="reset">Reset</button>
			</div>
		</div>
		</form>
	</div>
</div>
<script>
	$("#golongan").select2({
		theme: "bootstrap"
	});
	$("#jabatan").select2({
		theme: "bootstrap"
	});
</script>