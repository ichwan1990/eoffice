<div class="page-title">
	<div class="title_left">
		<h3><?=$judul?> Master Kegiatan DPA
		</h3>
	</div>
</div>
<div class="clearfix"></div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title" align="right">
				<a href="<?=site_url('sppd/kegiatan')?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form action="<?=site_url('sppd/kegiatan/proses')?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Kode Rekening Kegiatan *</label>
						<div class="col-sm-5 col-xs-12">
							<input type="hidden" name="id" value="<?=$row->id_keg?>">
							<input type="text" name="kode_rek" class="form-control col-md-7 col-xs-12" value="<?=$row->kode_rek?>" required>
						</div>
					</div>
                    <div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Nama Kegiatan *</label>
						<div class="col-sm-5 col-xs-12">
                            <input type="text" name="nama_keg" class="form-control col-md-7 col-xs-12" value="<?=$row->nama_keg?>" required>
						</div>
					</div>
                    <div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Nama PPTK *</label>
						<div class="col-sm-5 col-xs-12">
                                <?=form_dropdown('pejabat', $pejabat, $selectedpejabat, ['class' => 'form-control', 'id' => 'pptk', 'required' => 'required'])?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Bendahara *</label>
						<div class="col-sm-5 col-xs-12">
                                <?=form_dropdown('pejabat2', $pejabat2, $selectedpejabat2, ['class' => 'form-control', 'id' => 'bendahara', 'required' => 'required'])?>
						</div>
					</div>
                    <div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Jumlah Anggaran *</label>
						<div class="col-sm-5 col-xs-12">
                            <input type="number" name="jumlah_anggaran" class="form-control col-md-7 col-xs-12" value="<?=$row->jumlah_anggaran?>" required>
						</div>
					</div>
                    <div class="form-group">
						<label class="control-label col-sm-4 col-xs-12">Keterangan</label>
						<div class="col-sm-7 col-xs-12">
							<textarea name="keterangan" id="editor1" class="form-control col-md-7 col-xs-12"><?=$row->keterangan?></textarea>
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

<script src="<?=base_url()?>assets/vendors/ckeditor/ckeditor.js"></script>
<script>
CKEDITOR.replace('editor1');

$("#pptk").select2({
	theme: "bootstrap"
});

$("#bendahara").select2({
	theme: "bootstrap"
});
</script>