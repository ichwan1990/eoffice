<div class="card">
	<header class="card-header">
		<a href="<?= site_url('dashboard') ?>" class="btn btn-sm btn-dark float-right"><i class="fa fa-angle-left"></i> Kembali</a>
	</header>
	<div class="card-content">
		<div class="content col-md-6">
			<div class="col-md-6">
				<form action="<?= site_url('profile/proses') ?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
					<?php if ($this->session->userdata('level_user') != '0') { ?>
						<div class="form-group">
							<label class="control-label">NIP <span class="required">*</span></label>
							<input type="number" name="nip" class="form-control" value="<?= $row->nip ?>" required>
						</div>
					<?php } ?>
					<div class="form-group">
						<label class="control-label">Nama Lengkap *</label>
						<input type="hidden" name="id" value="<?= $row->id_user ?>">
						<input type="text" name="nama" class="form-control" value="<?= $row->nama_lengkap ?>" required>
					</div>
					<div class="form-group">
						<label class="control-label">Alamat *</label>
						<textarea name="alamat" class="form-control" rows="3" required><?= $row->alamat ?></textarea>
					</div>
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
						<input type="text" name="username" class="form-control" value="<?= $row->username ?>" pattern=".{5,}">
					</div>
					<div class="form-group">
						<label class="control-label">Password</label>
						<input type="text" name="password" class="form-control" pattern=".{5,}">
						<small>(Biarkan kosong jika password tidak diganti)</small>
					</div>
			</div>
		</div>
	</div>
	<footer class="card-footer">
		<div class="ln_solid"></div>
		<div class="form-group">
			<input type="submit" name="edit" class="btn btn-success" value="Simpan">
			<button class="btn btn-default" type="reset">Reset</button>
		</div>
		</form>
	</footer>
</div>