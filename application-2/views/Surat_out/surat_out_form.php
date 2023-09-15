<div class="card">
	<div class="card-header">
		<a href="<?= site_url('surat_keluar') ?>" class="btn btn-sm btn-dark float-right"><i class="fa fa-angle-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<?php $attr = array('class' => 'form-horizontal form-label-left', 'autocomplete' => 'off');
				echo form_open_multipart('surat_keluar/proses', $attr); ?>
				<div class="form-group">
					<label class="control-label">No. Agenda <span class="required">*</span></label>
					<input type="hidden" name="id" value="<?= $row->id_surat_out ?>">
					<input type="number" name="no_agenda" id="no_agenda" class="form-control" value="<?= $row->no_agenda ?>" required>
				</div>
				<div class="form-group">
					<label class="control-label">Kategori *</label>
					<?= form_dropdown('kategori', $kategori, $selectedkategori, ['id' => 'kategori', 'class' => 'form-control', 'id' => 'kategori', 'required' => 'required']) ?>
				</div>
				<div class="form-group">
					<label class="control-label">Pengirim *</label>
					<?= form_dropdown('pengolah', $pengolah, $selectedpengolah, ['id' => 'pengolah', 'class' => 'form-control', 'required' => 'required']) ?>
				</div>
				<div class="form-group">
					<label class="control-label">Tanggal Surat *</label>
					<input type="date" name="tgl_surat" class="form-control datepicker-input" value="<?= $row->tgl_surat ?>" required>
				</div>
				<div class="form-group">
					<label class="control-label">No. Surat *</label>
					<input type="text" name="no_surat" id="no_surat" class="form-control" required>
				</div>
				<div class="form-group">
					<label class="control-label">Tujuan Surat *</label>
					<a class="btn btn-primary btn-xs" href="<?= site_url('tujuan_surat/add') ?>">Tambah Pengirim</a>
					<?= form_dropdown('tujuan', $tujuan, $selectedtujuan, ['class' => 'form-control', 'required' => 'required']) ?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Perihal *</label>
					<textarea name="hal" class="form-control" required><?= $row->perihal ?></textarea>
				</div>
				<div class="form-group">
					<label class="control-label">Lampiran </label>
					<textarea name="isi" class="form-control"><?= $row->isi_ringkas ?></textarea>
				</div>
				<div class="form-group">
					<label class="control-label">File Surat</label>
					<div class="custom-file">
						<input type="file" name="file_surat" class="custom-file-input" id="file_surat_keluar">
						<label class="custom-file-label" for="file_surat_masuk">Pilih file</label>
						<small>(Biarkan kosong jika tidak ada)</small>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Keterangan</label>
					<textarea name="ket" class="form-control" rows="3"><?= $row->keterangan ?></textarea>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card-footer">
	<div class="form-group">
		<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-4">
			<input type="submit" name="<?= $page ?>" value="Simpan" class="btn btn-success">
			<button class="btn btn-default" type="reset">Reset</button>
		</div>
	</div>
</div>
</form>
<script type="text/javascript">
	function set_nosurat() {
		var no_agenda = $('#no_agenda').val();
		var kat = $('#kategori option:selected').text();
		if (kat != '') {
			var kategori = kat.slice(0, kat.indexOf('-')).trim();
		} else {
			var kategori = '0';
		}
		var pgh = $('#pengolah').val();
		if (pgh != '') {
			var pengolah = pgh;
		} else {
			var pengolah = '0';
		}
		const month = ["I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII"];
		d = new Date($("input[name='tgl_surat']").val());
		let bulan = month[d.getMonth()];
		var year = d.getFullYear();
		var no_surat = no_agenda + '.' + pengolah + '.' + kategori + '.RS-MP.' + bulan + '.' + year;
		$('#no_surat').val(no_surat);
		//alert(no_surat);
	}

	$("#kategori").change(function() {
		set_nosurat();
	});

	$("input[name='tgl_surat']").change(function() {
		set_nosurat();
	});

	$("#pengolah").change(function() {
		var pgh = $('#pengolah').val();
		$.ajax({
			url: '<?php echo site_url("surat_keluar/no_agenda"); ?>',
			data: {
				'id_pengolah': pgh
			},
			cache: false,
			type: "GET",
			contentType: "application/json",
			success: function(data) {
				//console.log(data);
				$('#no_agenda').val(data);
				set_nosurat();
			}
		});
	});

	$('#file_surat_keluar').on('change', function() {
		// Ambil nama file 
		let fileName = $(this).val().split('\\').pop();
		// Ubah "Choose a file" label sesuai dengan nama file yag akan diupload
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
	});

	$("#no_agenda").change(function() {
		set_nosurat();
	});
	window.onload = set_nosurat();

	$("#pengolah").select2({
		theme: "bootstrap4"
	});

	$("#tujuan").select2({
		theme: "bootstrap4"
	});

	$('#myModal').on('shown.bs.modal', function() {
		$('#myInput').trigger('focus')
	})
</script>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Tujuan Surat</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
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
			<div class="modal-footer">
				<div class="form-group">
					<input type="submit" name="<?= $page ?>" value="Simpan" class="btn btn-success">
					<button class="btn btn-default" type="reset">Reset</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>