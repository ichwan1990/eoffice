<div class="row">

    <?php

    // $CI = &get_instance();

    //$CI->load->model('surat_in_m');

    //$CI->load->model('disposisi_m');

    //if ($this->session->userdata('level_user') == '2') {

    //    $in = $CI->surat_in_m->get_disp();

    // } else {

    //    $in = $CI->surat_in_m->get2();

    //}

    //$jml = 0;

    //foreach ($in->result() as $r => $d) {

    //    if ($CI->disposisi_m->cek_ada_disposisi($d->id_surat_in)->num_rows() == 0) {

    //        $jml = $jml + 1;

    //  }

    //}

    $data = hitung_disposisi_2();

    //var_dump($data);

    //exit();

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

                    <h3><?= $data['jml'] ?></h3>



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



    <div class="col-12">

        <div class="callout callout-danger">

            <h5><i class="fas fa-info"></i> Informasi:</h5>

            <b>eOffice Versi 2.1 Tahun 2023</b>

            <p>Aplikasi ini masih dalam pengembangan dan optimalisasi peforma sehingga apabila ada ditemukan error silahkan menghubungi Tim IT (ext.220). Terimakasih</p>

        </div>

        <div class="row" style="display: none;">

            <div class="col-md-6">

                <div class="card card-danger">

                    <div class="card-header">

                        <h3 class="card-title">Donut Chart</h3>

                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse">

                                <i class="fas fa-minus"></i>

                            </button>

                            <button type="button" class="btn btn-tool" data-card-widget="remove">

                                <i class="fas fa-times"></i>

                            </button>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="chartjs-size-monitor">

                            <div class="chartjs-size-monitor-expand">

                                <div class="">



                                </div>

                            </div>

                            <div class="chartjs-size-monitor-shrink">

                                <div class=""></div>

                            </div>

                        </div>

                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 764px;" width="764" height="250" class="chartjs-render-monitor"></canvas>

                    </div>



                </div>

            </div>

            <div class="col-md-6">

                <div class="card card-success">

                    <div class="card-header">

                        <h3 class="card-title">Bar Chart</h3>

                        <div class="card-tools">

                            <button type="button" class="btn btn-tool" data-card-widget="collapse">

                                <i class="fas fa-minus"></i>

                            </button>

                            <button type="button" class="btn btn-tool" data-card-widget="remove">

                                <i class="fas fa-times"></i>

                            </button>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="chart">

                            <div class="chartjs-size-monitor">

                                <div class="chartjs-size-monitor-expand">

                                    <div class="">

                                    </div>

                                </div>

                                <div class="chartjs-size-monitor-shrink">

                                    <div class="">



                                    </div>

                                </div>

                            </div>

                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 764px;" width="764" height="250" class="chartjs-render-monitor"></canvas>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>