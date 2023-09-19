<div class="card">
    <div class="card-header">
        <a href="<?= site_url('surat_masuk') ?>?s=<?= @$_GET['s'] ?>" class="btn btn-sm btn-dark float-right"><i class="fa fa-angle-left"></i> Kembali</a>
    </div>
    <?php 
        $attr = array('class' => 'form-horizontal form-label-left', 'autocomplete' => 'off');
        echo form_open_multipart('surat_masuk/proses', $attr); 
    ?>
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
                <div class="form-group d-none">
                    <label class="control-label">Isi Ringkas *</label>
                    <textarea name="isi" class="form-control" rows="5"><?= $row->isi_ringkas ?></textarea>
                </div>
                <!-- /.form-group -->
                <div class="form-group clearfix">
                    <label class="control-label">Sifat Surat *</label>
                    <div class="row ">
                        <div class="m-4">
                            <div class="icheck-primary d-inline">
                                <input type="radio" value="Biasa" name="sifat" id="Biasa" required <?= $row->sifat_surat == "Biasa" ? "checked" : null ?>>
                                <label for="Biasa">
                                    Biasa
                                </label>
                            </div>
                        </div>
                        <div class="m-4">
                            <div class="icheck-warning d-inline">
                                <input type="radio" value="Segera" name="sifat" id="Segera" <?= $row->sifat_surat == "Segera" ? "checked" : null ?>>
                                <label for="Segera">
                                    Segera
                                </label>
                            </div>
                        </div>
                        <div class="m-4">
                            <div class="icheck-dark d-inline">
                                <input type="radio" value="Rahasia" name="sifat" id="Rahasia" <?= $row->sifat_surat == "Rahasia" ? "checked" : null ?>>
                                <label for="Rahasia">
                                    Rahasia
                                </label>
                            </div>
                        </div>
                        <div class="m-4">
                            <div class="icheck-danger d-inline">
                                <input type="radio" value="Penting" name="sifat" id="Penting" <?= $row->sifat_surat == "Penting" ? "checked" : null ?>>
                                <label for="Penting">
                                    Penting
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label class="control-label">File Surat</label>
                    <div class="custom-file">
                        <input type="file" name="file_surat" class="custom-file-input" id="file_surat_masuk">
                        <label class="custom-file-label" for="file_surat_masuk">Pilih file</label>
                        <small>(Biarkan kosong jika tidak ada)</small>
                    </div>
                </div>
                <!-- /.form-group -->
                <div class="form-group d-none">
                    <label class="control-label">Keterangan</label>
                    <textarea name="ket" class="form-control" rows="4"><?= $row->keterangan ?></textarea>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <div class="card-footer">
        <div class="row float-right">
            <input type="submit" name="<?= $page ?>" value="Simpan" class="btn btn-success">
            <button class="btn btn-default mx-3" type="reset">Reset</button>
        </div>
        </form>
    </div>
</div>
<!-- <script type="text/javascript">
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
        theme: "bootstrap4"
    })

    $("#pengirim2").select2({
        theme: "bootstrap4"
    });


    $('#file_surat_masuk').on('change', function() {
        // Ambil nama file 
        let fileName = $(this).val().split('\\').pop();
        // Ubah "Choose a file" label sesuai dengan nama file yag akan diupload
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script> -->