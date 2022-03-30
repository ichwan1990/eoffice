<div class="card">
    <div class="card-header">
        <a href="<?= site_url('agenda/calendar') ?>" class="btn btn-sm btn-info mr-2" id="tambah"><i class="fa fa-calendar"></i> Lihat Calendar</a>
        <?php if ($this->session->userdata('level_user') == '1') { ?>
            <!-- <a href="<?= site_url('agenda/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Agenda</a> -->
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Tambah Agenda
            </button>
        <?php } ?>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="data">
            <thead>
                <tr>
                    <th>No Agenda</th>
                    <th>Tgl Mulai Acara</th>
                    <th>Tgl Selesai Acara</th>
                    <th>Perihal Acara</th>
                    <th>Tempat Acara</th>
                    <th>Keterangan</th>
                    <?php if ($this->session->userdata('level_user') == '1') { ?>
                        <th><i class="fa fa-gear"></i></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($row1 as $r => $data) { ?>
                    <tr>
                        <td><?= $data->no_agenda ?></td>
                        <td><?= tgl_indo($data->tgl_start) ?><br><?= $data->jam_start ?> WIB</td>
                        <td><?= tgl_indo($data->tgl_end) ?><br><?= $data->jam_end ?> WIB</td>
                        <td><?= $data->perihal_acara ?></td>
                        <td><?= $data->tempat_acara ?></td>
                        <td><?= $data->keterangan ?></td>
                        <?php if ($this->session->userdata('level_user') == '1') { ?>
                            <td class="text-center">
                                <!-- <div> -->
                                <a href="<?= site_url('agenda/edit/' . $data->id_agenda) ?>" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-default" title="Edit"><i class="fa fa-edit"></i></a>
                                <!-- </div> -->
                                <!-- <div> -->
                                <a href="<?= site_url('agenda/del/' . $data->id_agenda) ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-xs btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                <!-- </div> -->
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-primary">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('agenda/proses') ?>" method="post" class="form-horizontal form-label-left" autocomplete="off">
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-md-2">
                                <label class="control-label">No. Agenda <span class="required">*</span></label>
                            </div>
                            <div class="col-md-10">
                                <input type="hidden" name="id" value="">
                                <input type="number" name="no" class="form-control" value="<?= $row->no_agenda ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-md-2">
                                <label class="control-label">Tanggal Mulai Acara *</label>
                            </div>
                            <div class="col-md-10">
                                <input type="date" name="tgl_start" class="form-control" value="<?= $row->tgl_start ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-md-2">
                                <label class="control-label">Jam Mulai Acara *</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="jam_start" class="form-control" value="<?= $row->jam_start ?>" placeholder="12:00" required>
                            </div>
                            <div class="col-md-1">
                                <label class="control-label hidden-sm hidden-xs">WIB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-md-2">
                                <label class="control-label">Tanggal Selesai Acara *</label>
                            </div>
                            <div class="col-md-10">
                                <input type="date" name="tgl_end" class="form-control" value="<?= $row->tgl_end ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-md-2">
                                <label class="control-label">Jam Selesai Acara *</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="jam_end" class="form-control" value="<?= $row->jam_end ?>" placeholder="12:00" required>
                                <!-- <small>* <u>Note</u><br>AM : 12 malam - 11.59 siang<br>PM : 12 siang - 11.59 malam</small> -->
                            </div>
                            <div class="col-md-1">
                                <label class="control-label hidden-sm hidden-xs">WIB</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-md-2">
                                <label class="control-label">Perihal Acara *</label>
                            </div>
                            <div class="col-md-10">
                                <textarea name="hal" class="form-control" required><?= $row->perihal_acara ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-md-2">
                                <label class="control-label">Tempat Acara *</label>
                            </div>
                            <div class="col-md-10">
                                <textarea name="tempat" class="form-control" required><?= $row->tempat_acara ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class=" col-md-2">
                                <label class="control-label">Keterangan</label>
                            </div>
                            <div class="col-md-10">
                                <textarea name="ket" class="form-control" rows="3"><?= $row->keterangan ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="<?= $page ?>" value="Simpan" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
    // $('#data').DataTable();
</script>