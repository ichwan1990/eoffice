<div class="page-title">
	<div class="title_left">
		<h3><?=$judul?> Golongan Pegawai</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('golongan')?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form action="<?=site_url('golongan/proses')?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Golongan <span class="required">*</span></label>
						<div class="col-sm-5 col-xs-12">
							<input type="hidden" name="id" value="<?=$row->id_gol?>">
							<input type="text" name="gol" class="form-control col-md-7 col-xs-12" value="<?=$row->kode_gol?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Nama Golongan *</label>
						<div class="col-sm-5 col-xs-12">
							<input type="text" name="nama_gol" class="form-control col-md-7 col-xs-12" value="<?=$row->nama_gol?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="middle-name" class="control-label col-sm-4 col-xs-12">Uraian</label>
						<div class="col-sm-5 col-xs-12">
							<textarea name="uraian" class="form-control col-md-7 col-xs-12"><?=$row->uraian?></textarea>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-sm-6 col-xs-12 col-sm-offset-4">
							<input type="submit" name="<?=$page?>" value="Simpan" class="btn btn-success">
							<button class="btn btn-default" type="reset">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>