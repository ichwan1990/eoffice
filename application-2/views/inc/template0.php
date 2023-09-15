<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?> | e-Office RSUMP</title>
	<link href="<?= base_url() ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- <link href="<?= base_url() ?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet"> -->
	<link href="<?= base_url() ?>assets/build/css/custom.css" rel="stylesheet">
	<link rel="icon" type="image/png" href="<?= base_url() ?>assets/build/images/icon.png">

	<link href="<?= base_url() ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<!-- <link href="<?= base_url() ?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet"> -->
	<link href="<?= base_url() ?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendors/select2/select2.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/vendors/select2/select2-bootstrap.css" rel="stylesheet">

</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="" class="site_title"><span>e-Office RSUMP</span></a>
					</div>
					<div class="clearfix"></div>
					<div class="profile clearfix">
						<div class="profile_pic">
							<img src="<?= base_url() ?>assets/build/images/user.png" class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>Selamat datang,</span>
							<h2>
								<?= ucfirst($this->user_m->get_user($this->session->userdata('iduser'))->row()->nama_lengkap) ?>
							</h2>
						</div>
					</div>
					<br />
					<!-- sidebar menu -->
					<?php include_once "menu.php"; ?>
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav no-print">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						</div>

						<ul class="nav navbar-nav navbar-right">
							<li class="">
								<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<img src="<?= base_url() ?>assets/build/images/user.png">
									<?= ucfirst($this->user_m->get_user($this->session->userdata('iduser'))->row()->username) ?>
									<span class=" fa fa-angle-down"></span>
								</a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">
									<li>
										<a href="<?= site_url('profile') ?>"> Profile</a>
									</li>
									<li><a href="<?= site_url('auth/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
								</ul>
							</li>
							<?php if ($this->session->userdata('level_jabatan') != '6' && $this->session->userdata('level_user') != '0') { ?>
								<li role="presentation" class="dropdown">
									<a href="javascript:(0);" title="Surat Belum Disposisi" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
										<i class="fa fa-envelope-o"></i>
										<?php
										$CI = &get_instance();
										$CI->load->model('surat_in_m');
										$CI->load->model('disposisi_m');
										if ($this->session->userdata('level_user') == '2') {
											$in = $CI->surat_in_m->get();
										} else {
											$in = $CI->surat_in_m->get2();
										}
										$jml = 0;
										foreach ($in->result() as $r => $d) {
											if ($CI->disposisi_m->cek_ada_disposisi($d->id_surat_in)->num_rows() == 0) {
												$jml = $jml + 1;
											}
										} ?>
										<span class="badge bg-red"><?= $jml ?></span>
									</a>
									<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu" style="max-height:350px; overflow-x:auto;">
										<?php
										foreach ($in->result() as $r => $data) {
											if ($CI->disposisi_m->cek_ada_disposisi($data->id_surat_in)->num_rows() == 0) { ?>
												<li>
													<a href="<?= site_url('disposisi/' . $data->id_surat_in . '?h=2') ?>">
														<span><?= $data->no_surat ?></span>
														<span class="time"><?= tgl_indo($data->tgl_surat) ?></span>
														<span class="message"><?= substr($data->perihal, 0, 90) ?> </span>
													</a>
												</li>
										<?php
											}
										} ?>
										<li>
											<div class="text-center">
												<a href="<?= site_url('surat_masuk?s=n') ?>">
													<strong><?= $jml != 0 ? "Lihat Semua Surat Belum Disposisi" : "Semua Surat Sudah Disposisi" ?></strong>
													<i class="fa fa-angle-right"></i>
												</a>
											</div>
										</li>
									</ul>
								</li>
							<?php } ?>
						</ul>
					</nav>
				</div>
			</div>


			<script src="<?= base_url() ?>assets/vendors/jquery/dist/jquery.min.js"></script>
			<script src="<?= base_url() ?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
			<script src="<?= base_url() ?>assets/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
			<script src="<?= base_url() ?>assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
			<script src="<?= base_url() ?>assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
			<!-- <script src="<?= base_url() ?>assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script> -->
			<script src="<?= base_url() ?>assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
			<script src="<?= base_url() ?>assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
			<!-- <script src="<?= base_url() ?>assets/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script> -->
			<script src="<?= base_url() ?>assets/vendors/select2/select2.full.js"></script>
			<style>
				@media print {

					.no-print,
					.no-print * {
						display: none !important;
					}
				}

				[class^='select2'] {
					border-radius: 0px !important;
				}

				.select2-results {
					color: #524F4E !important;
				}

				table {
					page-break-after: auto;
				}

				tr {
					page-break-inside: avoid;
					page-break-after: auto;
				}

				td {
					page-break-inside: avoid;
					page-break-after: auto;
				}

				thead {
					display: table-row-group;
				}

				tfoot {
					display: table-footer-group;
				}
			</style>

			<div class="right_col" role="main">
				<?= $contents ?>
			</div>

			<!-- footer content -->
			<footer>
				<div class="pull-right no-print">
					© 2021 - Created with <span style="color: #e25555;">&#9829;</span> by IT RSU Muslimat Ponorogo
				</div>
				<div class="clearfix"></div>
			</footer>
		</div>
	</div>

	<script src="<?= base_url() ?>assets/vendors/fastclick/lib/fastclick.js"></script>
	<script src="<?= base_url() ?>assets/vendors/nprogress/nprogress.js"></script>
	<!-- <script src="<?= base_url() ?>assets/vendors/iCheck/icheck.min.js"></script> -->
	<script src="<?= base_url() ?>assets/build/js/custom.js"></script>
	<script>
		$(document).ready(function() {
			$(".nav  li.disabled a").click(function() {
				return false;
			});
		});
	</script>
</body>

</html>