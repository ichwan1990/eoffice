<div class="card">
    <div class="card-header">
        <a href="<?= site_url('pengirim_surat') ?>" class="btn btn-sm btn-dark"><i class="fa fa-angle-left"></i> Kembali</a>
        <div class="clearfix"></div>
    </div>
    <div class="card-body">
        <form action="<?= site_url('pengirim_surat/proses') ?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
            <div class="form-group">
                <label class="control-label col-sm-4 col-xs-12">Nama Pengirim <span class="required">*</span></label>
                <div class="col-sm-4 col-xs-12">
                    <input type="hidden" name="id" value="<?= $row->id_pengirim ?>">
                    <input type="text" name="nama" class="form-control col-md-7 col-xs-12" value="<?= $row->nama_pengirim ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4 col-xs-12">Uraian</label>
                <div class="col-sm-5 col-xs-12">
                    <textarea name="uraian" class="form-control col-md-7 col-xs-12"><?= $row->uraian ?></textarea>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-sm-6 col-xs-12 col-sm-offset-4">
                    <input type="submit" name="<?= $page ?>" value="Simpan" class="btn btn-success">
                    <button class="btn btn-default" type="reset">Reset</button>
                </div>
            </div>
        </form>
    </div>
</div>