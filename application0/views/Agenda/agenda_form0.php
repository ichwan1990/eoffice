<div class="page-title">
	<div class="title_left">
		<h3><?=$judul?> Agenda</h3>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('agenda')?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form action="<?=site_url('agenda/proses')?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">No. Agenda <span class="required">*</span></label>
						<div class="col-md-2 col-sm-4 col-xs-12">
							<input type="hidden" name="id" value="<?=$row->id_agenda?>">
							<input type="number" name="no" class="form-control col-md-7 col-xs-12" value="<?=$row->no_agenda?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Mulai Acara *</label>
						<div class="col-md-3 col-sm-5 col-xs-12">
							<input type="date" name="tgl_start" class="form-control col-md-7 col-xs-12" value="<?=$row->tgl_start?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Jam Mulai Acara *</label>
						<div class="col-md-3 col-sm-5 col-xs-12">
							<input type="text" name="jam_start" class="form-control col-md-7 col-xs-12" value="<?=$row->jam_start?>" placeholder="12:00" required>
						</div>
						<label class="control-label hidden-sm hidden-xs">WIB</label>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Selesai Acara *</label>
						<div class="col-md-3 col-sm-5 col-xs-12">
							<input type="date" name="tgl_end" class="form-control col-md-7 col-xs-12" value="<?=$row->tgl_end?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Jam Selesai Acara *</label>
						<div class="col-md-3 col-sm-5 col-xs-12">
							<input type="text" name="jam_end" class="form-control col-md-7 col-xs-12" value="<?=$row->jam_end?>"  placeholder="12:00" required>
							<!-- <small>* <u>Note</u><br>AM : 12 malam - 11.59 siang<br>PM : 12 siang - 11.59 malam</small> -->
						</div>
						<label class="control-label hidden-sm hidden-xs">WIB</label>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Perihal Acara *</label>
						<div class="col-md-5 col-sm-5 col-xs-12">
							<textarea name="hal" class="form-control col-md-7 col-xs-12" required><?=$row->perihal_acara?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Tempat Acara *</label>
						<div class="col-md-5 col-sm-5 col-xs-12">
							<textarea name="tempat" class="form-control col-md-7 col-xs-12" required><?=$row->tempat_acara?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-4 col-sm-4 col-xs-12">Keterangan</label>
						<div class="col-md-5 col-sm-5 col-xs-12">
							<textarea name="ket" class="form-control col-md-7 col-xs-12" rows="3"><?=$row->keterangan?></textarea>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
							<input type="submit" name="<?=$page?>" value="Simpan" class="btn btn-success">
							<button class="btn btn-default" type="reset">Reset</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>