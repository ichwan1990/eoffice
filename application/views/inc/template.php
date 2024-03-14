<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | e-Office RSUMP</title>
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/build/images/icon.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/dist/css/adminlte.min.css">
    <!-- Calendar -->
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/fullcalendar/main.css">

    <style>
        body {
            font-family: 'Share Tech', sans-serif;
            font-size: .875rem !important;
        }
        
        .dropdown-menu {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>

    <!-- jQuery -->
    <script src="<?= base_url('assets/theme') ?>/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item dropdown">
                    <!-- <?php $data = hitung_disposisi_2(); ?> -->
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge"><?= $data['jml'] ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <?php if ($this->session->userdata('level_user') == '1') {  ?>
                            <a href="<?= site_url('surat_masuk/add') ?>" class="dropdown-item dropdown-header bg-primary">Tambah Surat Masuk</a>
                        <?php
                        }
                        $CI = &get_instance();
                        $CI->load->model('disposisi_m', 'disposisi');
                        $no = 0;
                        foreach ($data['row'] as $r => $data) {
                            if ($CI->disposisi->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) {
                        ?>
                                <div class="dropdown-divider"></div>
                                <a href="<?= site_url('disposisi/' . $data->id_surat_in . '?h=2') ?>" class="dropdown-item">

                                    <div class="media">
                                        <!-- <img src="<?= base_url() ?>assets/build/images/user.png" alt="User Avatar" class="img-size-50 mr-3 img-circle"> -->
                                        <div class="media-body">
                                            <p class="dropdown-item-title text-bold text-secondary">
                                                <?= $data->no_surat ?>
                                                <?php
                                                if ($data->sifat_surat == 'Biasa') {
                                                    echo '<span class="float-right text-sm text-primary"><i class="fas fa-star"></i></span>';
                                                } elseif ($data->sifat_surat == 'Segera') {
                                                    echo '<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>';
                                                } elseif ($data->sifat_surat == 'Rahasia') {
                                                    echo '<span class="float-right text-sm text-dark"><i class="fas fa-star"></i></span>';
                                                } elseif ($data->sifat_surat == 'Penting') {
                                                    echo '<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>';
                                                }
                                                ?>
                                                <!-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> -->
                                            </p>
                                            <p class="text-sm"><?= substr($data->perihal, 0, 90) ?></p>
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i><?= tgl_indo($data->tgl_surat) ?></p>
                                        </div>
                                    </div>

                                </a>
                        <?php
                            }
                        }
                        ?>
                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('surat_masuk?s=n') ?>" class="dropdown-item dropdown-footer bg-warning">Surat Masuk Belum Disposisi</a>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user">
                            <strong><?= ucfirst($this->user_m->get_user($this->session->userdata('iduser'))->row()->nama_lengkap) ?></strong>
                        </i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('profile') ?>" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i>Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('auth/logout') ?>" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= base_url() ?>" class="brand-link">
                <img src="<?= base_url('assets/build/images') ?>/icon.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><b>e</b>Office - <i>RSUMP</i></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url() ?>assets/build/images/user.png" class="img-circle profile_img">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= ucfirst($this->user_m->get_user($this->session->userdata('iduser'))->row()->nama_lengkap) ?></a>
                    </div>
                </div>

                <?php include_once "menu.php"; ?>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $title ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <?= $contents ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 2.1
            </div>
            <strong>Copyright &copy; 2021</strong> - Created with <span style="color: #e25555;">&#9829;</span> by IT RSU Muslimat Ponorogo
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    
    <script src="<?= base_url('assets/theme') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/theme') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?= base_url('assets/theme') ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('assets/theme') ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url('assets/theme') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/theme') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/theme') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('assets/theme') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/theme') ?>/dist/js/adminlte.min.js"></script>
    <script src="<?= base_url('assets/theme') ?>/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?= base_url('assets/theme') ?>/plugins/chart.js/Chart.min.js"></script>
    <!-- Calendar -->
    <script src="<?= base_url('assets/theme') ?>/plugins/moment/moment.min.js"></script>
    <script src="<?= base_url('assets/theme') ?>/plugins/fullcalendar/main.js"></script>
    <?php
    include "js.php";
    ?>
    <!--<script>
            
      $(function () {

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Surat Masuk',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        {
          label               : 'Surat Keluar',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [65, 59, 80, 81, 56, 55, 40]
        },
      ]
    }
        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
          labels: [
              'Biasa',
              'Penting',
              'Segera',
              'Rahasia',
          ],
          datasets: [
            {
              data: [700,500,400,600],
              backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
            }
          ]
        }
        var donutOptions     = {
          maintainAspectRatio : false,
          responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
          type: 'doughnut',
          data: donutData,
          options: donutOptions
        })
    

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        var temp1 = areaChartData.datasets[1]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0
    
        var barChartOptions = {
          responsive              : true,
          maintainAspectRatio     : false,
          datasetFill             : false
        }
    
        new Chart(barChartCanvas, {
          type: 'bar',
          data: barChartData,
          options: barChartOptions
        })
    
      })

    </script>-->
</body>

</html>