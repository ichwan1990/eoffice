<div class="page-title">
	<div class="title_left">
		<h3><?=$judul?> Profile</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('dashboard')?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form action="<?=site_url('profile/proses')?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
					<?php if($this->session->userdata('level_user') != '0') { ?>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">NIP <span class="required">*</span></label>
						<div class="col-sm-3 col-xs-12">
							<input type="number" name="nip" class="form-control col-md-7 col-xs-12" value="<?=$row->nip?>" required>
						</div>
					</div>
					<?php } ?>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Nama Lengkap *</label>
						<div class="col-sm-4 col-xs-12">
							<input type="hidden" name="id" value="<?=$row->id_user?>">
							<input type="text" name="nama" class="form-control col-md-7 col-xs-12" value="<?=$row->nama_lengkap?>" required>
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
							<input type="text" name="username" class="form-control col-md-7 col-xs-12" value="<?=$row->username?>" pattern=".{5,}">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Password</label>
						<div class="col-sm-3 col-xs-12">
							<input type="text" name="password" class="form-control col-md-7 col-xs-12" pattern=".{5,}">
							<small>(Biarkan kosong jika password tidak diganti)</small>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-sm-6 col-xs-12 col-sm-offset-4">
							<input type="submit" name="edit" class="btn btn-success" value="Simpan">
							<button class="btn btn-default" type="reset">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>