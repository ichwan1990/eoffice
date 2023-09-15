<div class="page-title">
	<div class="title_left">
		<h3>Tambah Pegawai</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('pegawai')?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form action="<?=site_url('pegawai/proses')?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">NIK <span class="required">*</span></label>
						<div class="col-sm-3 col-xs-12">
							<input type="hidden" name="id" value="<?=$row->id_user?>">
							<input type="text" name="nip" class="form-control col-md-7 col-xs-12" value="<?=$row->nip?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Nama Lengkap *</label>
						<div class="col-sm-4 col-xs-12">
							<input type="text" name="nama" class="form-control col-md-7 col-xs-12" value="<?=$row->nama_lengkap?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Golongan</label>
						<div class="col-sm-4 col-xs-12">
							<?=form_dropdown('golongan', $golongan, $selectedgolongan, ['class' => 'form-control', 'id' => 'golongan'])?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Jabatan *</label>
						<div class="col-sm-5 col-xs-12">
							<?=form_dropdown('jabatan', $jabatan, $selectedjabatan, ['class' => 'form-control', 'id' => 'jabatan', 'required' => 'required'])?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Alamat *</label>
						<div class="col-sm-5 col-xs-12">
							<textarea name="alamat" class="form-control col-md-7 col-xs-12" rows="3" required><?=$row->alamat?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">No. Telepon *</label>
						<div class="col-sm-3 col-xs-12">
							<input type="text" name="telp" class="form-control col-md-7 col-xs-12" value="<?=$row->no_telp?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Email *</label>
						<div class="col-sm-4 col-xs-12">
							<input type="email" name="email" class="form-control col-md-7 col-xs-12" value="<?=$row->email?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Username</label>
						<div class="col-sm-3 col-xs-12">
							<!-- <input type="text" name="username" class="form-control col-md-7 col-xs-12" pattern=".{5,}"> -->
							<input type="text" name="username" class="form-control col-md-7 col-xs-12" value="<?=$row->username?>">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Password</label>
						<div class="col-sm-3 col-xs-12">
							<input type="text" name="password" class="form-control col-md-7 col-xs-12">
							<small>(Biarkan kosong jika password tidak diganti)</small>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Role Akun</label>
						<div class="col-sm-3 col-xs-12">
							<select name="level_user" class="form-control">
	                            <option value="5" <?=$row->level_user == '5' ? 'selected' : null?>>Pegawai</option>
	                            <option value="1" <?=$row->level_user == '1' ? 'selected' : null?>>Tata Usaha</option>
	                            <option value="2" <?=$row->level_user == '2' ? 'selected' : null?>>Direktur</option>
							</select>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-sm-6 col-xs-12 col-sm-offset-4">
							<input type="submit" name="<?=$page?>" class="btn btn-success" value="Simpan">
							<button class="btn btn-default" type="reset">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
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