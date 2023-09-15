<div class="row">
    <?php
    $CI = &get_instance();
    $CI->load->model('surat_in_m');
    $CI->load->model('disposisi_m');
    if ($this->session->userdata('level_user') == '2') {
        $in = $CI->surat_in_m->get_disp();
    } else {
        $in = $CI->surat_in_m->get2();
    }
   $jml = 0;
    foreach ($in->result() as $r => $d) {
        if ($CI->disposisi_m->cek_ada_disposisi($d->id_surat_in)->num_rows() == 0) {
            $jml = $jml + 1;
      }
    }
    ?>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <?php
                if ($this->session->userdata('level_user') == '0' || $this->session->userdata('level_user') == '1' || $this->session->userdata('level_user') == '2') {
                    $count_surat = $surat_masuk;
                } else {
                    $count_surat = $this->surat_in->get3()->num_rows();
                } ?>
                <h3><?= $count_surat ?></h3>

                <p>Total Surat Masuk</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="<?= site_url('surat_masuk') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
        <?php if ($this->session->userdata('level_user') != '0') { ?>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $jml ?></h3>

                    <p>Surat Masuk Belum Disposisi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?= site_url('surat_masuk?s=n') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <?php } ?>
    <!-- ./col -->
    <?php
    if ($this->session->userdata('level_user') == '0' || $this->session->userdata('level_user') == '1' || $this->session->userdata('level_user') == '2') {
    ?>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $agenda ?></h3>

                    <p>Total Agenda</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?= site_url('agenda') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    <?php } ?>
    <!-- ./col -->
</div>