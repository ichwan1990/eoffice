<div class="page-title">
	<div class="title_left">
		<h3>Edit SPPD</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('sppd')?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form action="<?=site_url('sppd/proses')?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">No. SPPD <span class="required">*</span></label>
						<div class="col-sm-5 col-xs-12">
							<input type="hidden" name="id" value="<?=$row->id_sppd?>">
							<input type="text" name="no_sppd" value="<?=$row->no_sppd?>" class="form-control col-md-7 col-xs-12" required>
						</div>
					</div>
					<div class="form-group">
						<label for="middle-name" class="control-label col-sm-4 col-xs-12">Maksud *</label>
						<div class="col-sm-5 col-xs-12">
							<textarea name="maksud" class="form-control col-md-7 col-xs-12" rows="3"><?=$row->maksud?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Pejabat Pemberi Perintah *</label>
						<div class="col-sm-5 col-xs-12">
							<?=form_dropdown('pejabat', $pejabat, $selectedpejabat, ['class' => 'form-control', 'required' => 'required'])?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Kendaraan *</label>
						<div class="col-sm-5 col-xs-12">
							<input type="text" name="kendaraan" value="<?=$row->kendaraan?>" class="form-control col-md-7 col-xs-12" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Tempat Berangkat *</label>
						<div class="col-sm-5 col-xs-12">
							<input type="text" name="t_berangkat" value="<?=$row->tempat_berangkat?>" class="form-control col-md-7 col-xs-12" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Tempat Tujuan *</label>
						<div class="col-sm-5 col-xs-12">
							<input type="text" name="t_tujuan" value="<?=$row->tempat_tujuan?>" class="form-control col-md-7 col-xs-12" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Tanggal Berangkat *</label>
						<div class="col-sm-5 col-xs-12">
							<input type="date" name="tgl_berangkat" value="<?=$row->tgl_berangkat?>" class="form-control col-md-7 col-xs-12" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Tanggal Kembali *</label>
						<div class="col-sm-5 col-xs-12">
							<input type="date" name="tgl_kembali" value="<?=$row->tgl_kembali?>" class="form-control col-md-7 col-xs-12" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Kegiatan *</label>
						<div class="col-sm-5 col-xs-12">
							<?=form_dropdown('kegiatan', $kegiatan, $selectedkeg, ['class' => 'form-control', 'required' => 'required'])?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Tanggal Surat *</label>
						<div class="col-sm-5 col-xs-12">
							<input type="date" name="tgl_sppd" value="<?=$row->tgl_sppd?>" class="form-control col-md-7 col-xs-12" required>
						</div>
					</div>
					<!-- <div class="form-group">
						<label for="middle-name" class="control-label col-sm-4 col-xs-12">Mengetahui (ttd) *</label>
						<div class="col-sm-5 col-xs-12">
							<?=form_dropdown('ttd', $ttd, $selectedttd, ['class' => 'form-control', 'required' => 'required'])?>
						</div>
					</div> -->
					<div class="form-group">
						<label for="middle-name" class="control-label col-sm-4 col-xs-12">Keterangan</label>
						<div class="col-sm-5 col-xs-12">
							<textarea name="ket" class="form-control col-md-7 col-xs-12" rows="3"><?=$row->ket2?></textarea>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-sm-6 col-xs-12 col-sm-offset-4">
							<input type="submit" name="edit" value="Simpan" class="btn btn-success">
							<button class="btn btn-default" type="reset">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>