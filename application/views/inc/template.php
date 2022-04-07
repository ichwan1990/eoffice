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
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/dist/css/adminlte.min.css">

    <style>
        body {
            font-family: 'Share Tech', sans-serif;
            font-size: .875rem !important;
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
                <li class="nav-item dropdown scroll-menu scroll-menu-2x">
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
                    } ?>
                    <!-- <a class="nav-link" href="<?= site_url('surat_masuk?s=n') ?>">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge"><?= $jml ?></span>
                    </a> -->
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge"><?= $jml ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg  dropdown-menu-right">
                        <span class="dropdown-item dropdown-header badge-danger "><?= $jml ?> Surat Masuk</span>
                        <?php
                        foreach ($in->result() as $r => $data) {
                            if ($CI->disposisi_m->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) { ?>
                                <div class="dropdown-divider"></div>
                                <a href="<?= site_url('disposisi/' . $data->id_surat_in . '?h=2') ?>" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <!-- <img src="<?= base_url('assets/theme') ?>/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
                                        <div class="media-body">
                                            <div class="dropdown-item-title">
                                                <strong> <?= $data->no_surat ?></strong>
                                                <?php if ($data->sifat_surat == "Biasa") {
                                                    echo  '<span class="float-right text-sm text-success"><i class="fas fa-star"></i></span>';
                                                } elseif ($data->sifat_surat == "Segera") {
                                                    echo  '<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>';
                                                } elseif ($data->sifat_surat == "Penting") {
                                                    echo  '<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>';
                                                } else {
                                                    echo  '<span class="float-right text-sm text-black"><i class="fas fa-star"></i></span>';
                                                } ?>
                                            </div>
                                            <p class="text-sm"><?= substr($data->perihal, 0, 90) ?></p>
                                            <p class="text-sm text-muted"><i class="far fa-calendar mr-1"></i> <?= tgl_indo($data->tgl_surat) ?></p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                        <?php
                            }
                        } ?>
                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('surat_masuk?s=A') ?>" class="dropdown-item dropdown-footer">Lihat Semua Surat</a>
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
                <b>Version</b> 1.0
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
    <?php
    include "js.php";
    ?>
</body>

</html>