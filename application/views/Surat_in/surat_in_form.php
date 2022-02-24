<div class="card">
    <div class="card-header">
        <a href="<?= site_url('surat_masuk') ?>?s=<?= @$_GET['s'] ?>" class="btn btn-sm btn-dark float-right"><i class="fa fa-angle-left"></i> Kembali</a>
    </div>
    <?php $attr = array('class' => 'form-horizontal form-label-left', 'autocomplete' => 'off');
    echo form_open_multipart('surat_masuk/proses', $attr); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>No. Agenda <span class="required">*</span></label>
                    <input type="hidden" name="id" value="<?= $row->id_surat_in ?>">
                    <input type="text" name="no_agenda" class="form-control" value="<?= $row->no_agenda ?>" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="middle-name" class="control-label">Kategori *</label>
                    <?= form_dropdown('kategori', $kategori, $selectedkategori, ['class' => 'form-control', 'id' => 'kategori', 'required' => 'required']) ?>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="middle-name" class="control-label">No. Surat *</label>
                    <input type="text" name="no_surat" class="form-control" value="<?= $row->no_surat ?>" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="middle-name" class="control-label">Tanggal Surat *</label>
                    <input type="date" name="tgl_surat" class="form-control" value="<?= $row->tgl_surat ?>" required>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="middle-name" class="control-label">Tanggal Selesai</label>
                    <input type="date" name="tgl_selesai" class="form-control" value="<?= $row->tgl_selesai ?>">
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Pengirim Surat *</label>
                    <div class="radio">
                        <label>
                            <input type="radio" value="1" name="input_pengirim" id="input_pengirim1" required <?= $row->input_pengirim == "1" ? "checked" : null ?>> Input Manual
                        </label>
                    </div>
                    <div class="radio" id="div_pengirim1">
                        <input type="text" name="pengirim" id="pengirim1" class="form-control" value="<?= $row->pengirim ?>" required>
                    </div><br>
                    <div class="radio">
                        <label>
                            <input type="radio" value="2" name="input_pengirim" id="input_pengirim2" <?= $row->input_pengirim == "2" ? "checked" : null ?>> Data Master Pengirim
                        </label>
                    </div>
                    <div class="radio" id="div_pengirim2">
                        <?php
                        echo form_dropdown('pengirim', $pengirim, $selectedpengirim, ['class' => 'form-control', 'required' => 'required', 'id' => 'pengirim2']) ?>
                    </div>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label class="control-label">Perihal *</label>
                    <textarea name="hal" class="form-control" required><?= $row->perihal ?></textarea>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <div class="card-footer">
        <div class="row">

        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function set_required() {
        if ($('#input_pengirim1').is(':checked')) {
            $('#pengirim1').attr('name', 'pengirim');
            $('#pengirim2').removeAttr('name');
            $('#pengirim2').attr('readonly', 'readonly');
            $('#pengirim1').removeAttr('readonly');
            $('#pengirim2').val('');
            // $('#pengirim2').removeAttr('required');
        } else if ($('#input_pengirim2').is(':checked')) {
            $('#pengirim2').attr('name', 'pengirim');
            $('#pengirim1').removeAttr('name');
            $('#pengirim1').attr('readonly', 'readonly');
            $('#pengirim2').removeAttr('readonly');
            $('#pengirim1').val('');
        }
    }

    window.onload = set_required();
    $('#input_pengirim1').click(function() {
        set_required();
    })
    $('#input_pengirim2').click(function() {
        set_required();
    })

    $("#kategori").select2({
        theme: "bootstrap"
    })

    $("#pengirim2").select2({
        theme: "bootstrap"
    });
</script>