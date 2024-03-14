<div class="card">
	<div class="card-header">
		<a href="<?= site_url('agenda') ?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<form action="<?= site_url('agenda/proses') ?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">No. Agenda <span class="required">*</span></label>
						<input type="hidden" name="id" value="<?= $row->id_agenda ?>">
						<input type="number" name="no" class="form-control" value="<?= $row->no_agenda ?>" required>
					</div>
					<div class="form-group">
						<label class="control-label">Tanggal Mulai Acara *</label>
						<input type="date" name="tgl_start" class="form-control" value="<?= $row->tgl_start ?>" required>
					</div>
					<div class="form-group">
						<label class="control-label">Jam Mulai Acara *</label>
						<input type="text" name="jam_start" class="form-control" value="<?= $row->jam_start ?>" placeholder="12:00" required>
						<label class="control-label hidden-sm hidden-xs">WIB</label>
					</div>
					<div class="form-group">
						<label class="control-label">Tanggal Selesai Acara *</label>
						<input type="date" name="tgl_end" class="form-control" value="<?= $row->tgl_end ?>" required>
					</div>
					<div class="form-group">
						<label class="control-label">Jam Selesai Acara *</label>
						<input type="text" name="jam_end" class="form-control" value="<?= $row->jam_end ?>" placeholder="12:00" required>
						<!-- <small>* <u>Note</u><br>AM : 12 malam - 11.59 siang<br>PM : 12 siang - 11.59 malam</small> -->
						<label class="control-label hidden-sm hidden-xs">WIB</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Perihal Acara *</label>
						<textarea name="hal" class="form-control" required><?= $row->perihal_acara ?></textarea>
					</div>
					<div class="form-group">
						<label class="control-label">Tempat Acara *</label>
						<textarea name="tempat" class="form-control" required><?= $row->tempat_acara ?></textarea>
					</div>
					<div class="form-group">
						<label class="control-label">Keterangan</label>
						<textarea name="ket" class="form-control" rows="3"><?= $row->keterangan ?></textarea>
					</div>
				</div>
			</div>
	</div>
	<div class="card-footer">
		<div class="form-group">
			<input type="submit" name="<?= $page ?>" value="Simpan" class="btn btn-success">
			<button class="btn btn-default" type="reset">Reset</button>
		</div>
	</div>
	</form>
</div>
</div>