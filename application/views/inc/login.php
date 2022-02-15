<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Aplikasi Surat Menyurat dan Disposisi RSU Muslimat Ponorogo">
	<meta name="author" content="IT RSU Muslimat Ponorogo">
	<title>Login - e-Office RSUMP</title>
	<link rel="icon" type="image/png" href="<?= base_url('assets/build/images/icon.png') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/build/login') ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/build/login') ?>/css/bootstrap-extend.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/build/login') ?>/css/site.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/build/login/css/login-v2.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/build/login') ?>/css/sweetalert.css">
	<link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">
	<style>
		body {
			overflow: hidden;
		}

		.text {
			color: #e80b18;
		}
	</style>
</head>

<body class="animsition page-login-v2 layout-full page-dark">
	<!--[if lt IE 8]>
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please upgrade your browser to improve your experience.</p>
	<![endif]-->
	<!-- Page -->
	<div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
		<div class="page-content">
			<div class="page-brand-info">
				<div class="brand">
					<h2 class="brand-text font-size-40" style="margin:0;">e-Office RSUMP</h2>
				</div>
				<p class="font-size-20">Aplikasi yang digunakan untuk mempermudah pengarsipan dan pengolahan persuratan
					<b>RSU Muslimat Ponorogo</b>
				</p>
			</div>
			<div class="page-login-main" style="padding-bottom:220px">
				<div class="brand" align="center">
					<img class="brand-img" style='width:100px;' src="<?= base_url('assets/build/images') ?>/icon.png">
				</div>
				<!-- <div class="loader vertical-align-middle loader-ellipsis"></div> -->
				<form action="" method="post" class='form-signin' autocomplete="off">
					<div style="margin-bottom:20px;">
						<span class="text"><b><?= $this->session->flashdata('alert') ?></b></span>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="text" class="form-control empty" id="username" name="username">
						<label class="floating-label" for="inputEmail">Username</label>
						<div align="left">
							<span class="text"><b><?= form_error('username') ?></b></span>
						</div>
					</div>
					<div class="form-group form-material floating" data-plugin="formMaterial">
						<input type="password" class="form-control empty" id="password" name="password">
						<label class="floating-label" for="inputPassword">Password</label>
						<div align="left">
							<span class="text"><b><?= form_error('password') ?></b></span>
						</div>
					</div>
					<div class="form-group clearfix">
						<a class="float-right" onclick="forgot()" style="cursor:pointer;">Lupa password?</a>
					</div>
					<button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
				</form>
			</div>
		</div>
	</div>
	<script src="<?= base_url('assets/build/login') ?>/js/jquery.js"></script>s
	<script src="<?= base_url('assets/build/login') ?>/js/babel-external-helpers.js"></script>
	<script src="<?= base_url('assets/build/login') ?>/js/bootstrap.js"></script>
	<script src="<?= base_url('assets/build/login') ?>/js/Component.js"></script>
	<script src="<?= base_url('assets/build/login') ?>/js/Plugin.js"></script>
	<script src="<?= base_url('assets/build/login') ?>/js/Base.js"></script>
	<script src="<?= base_url('assets/build/login') ?>/js/Config.js"></script>
	<script src="<?= base_url('assets/build/login') ?>/js/Site.js"></script>
	<script src="<?= base_url('assets/build/login') ?>/js/material.js"></script>
	<script src="<?= base_url('assets/build/login') ?>/js/sweetalert.js"></script>
	<script src="<?= base_url('assets/build/login') ?>/js/bootbox-sweetalert.js"></script>
	<script>
		function forgot() {
			swal({
				title: "Lupa Password?",
				text: "Silahkan hubungi admin",
				type: "info"
			}, function() {
			});
		}
	</script>
</body>

</html>