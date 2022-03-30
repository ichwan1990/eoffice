<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - e-Office RSUMP</title>
    <link rel="icon" type="image/png" href="<?= base_url('assets/build/images/icon.png') ?>">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/theme') ?>/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/build/login') ?>/css/sweetalert.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-danger">
            <div class="card-header text-center">
                <a href="<?= base_url() ?>" class="h1"><b>e</b>Office - <i>RSUMP</i></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="" method="post" class='form-signin' autocomplete="off">
                    <div class="mb-3">
                        <span class="text"><b><?= $this->session->flashdata('alert') ?></b></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                                <span class="text"><b><?= form_error('username') ?></b></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                <span class="text"><b><?= form_error('password') ?></b></span>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <p class="mb-1">
                                <a onclick="forgot()" style="cursor:pointer;">Lupa password?</a>
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/theme') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/theme') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/theme') ?>/dist/js/adminlte.min.js"></script>

    <script src="<?= base_url('assets/build/login') ?>/js/sweetalert.js"></script>
    <script src="<?= base_url('assets/build/login') ?>/js/bootbox-sweetalert.js"></script>
    <script>
        function forgot() {
            swal({
                title: "Lupa Password?",
                text: "Silahkan hubungi admin",
                type: "info"
            }, function() {});
        }
    </script>
</body>

</html>