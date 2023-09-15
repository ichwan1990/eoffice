<div class="row">
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
	}
	?>

	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-inbox"></i></div>
			<?php
			if ($this->session->userdata('level_user') == '0' || $this->session->userdata('level_user') == '1' || $this->session->userdata('level_user') == '2') {
				$count_surat = $surat_masuk;
			} else {
				$count_surat = $this->surat_in->get3()->num_rows();
			} ?>
			<div class="count"><?= $count_surat ?></div>
			<h3><a href="<?= site_url('surat_masuk') ?>">Surat Masuk</a></h3>
			<p>Total</p>
		</div>
	</div>
	<?php if ($this->session->userdata('level_user') != '0') { ?>
		<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="tile-stats">
				<div class="icon"><i class="fa fa-download"></i></div>
				<?php $count_bln_ini = $this->surat_in->get4()->num_rows(); ?>
				<div class="count"><?= $count_bln_ini ?></div>
				<h3><a href="<?= site_url('surat_masuk?s=b') ?>">Surat Masuk</a></h3>
				<p>Bulan Ini</p>
			</div>
		</div>
	<?php } ?>
	<?php if ($this->session->userdata('level_user') != '0') { ?>
		<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="tile-stats">
				<div class="icon"><i class="fa fa-envelope"></i></div>
				<div class="count"><?= $jml ?></div>
				<h3><a href="<?= site_url('surat_masuk?s=n') ?>">Surat Masuk</a></h3>
				<p>Belum Disposisi</p>
			</div>
		</div>
	<?php } ?>
	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-envelope-o"></i></div>
			<div class="count"><?= $surat_keluar ?></div>
			<h3>Surat Keluar</h3>
			<p>Total</p>
		</div>
	</div>
	<?php
	if ($this->session->userdata('level_user') == '0' || $this->session->userdata('level_user') == '1' || $this->session->userdata('level_user') == '2') {
	?>
		<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<div class="tile-stats">
				<div class="icon"><i class="fa fa-calendar"></i></div>
				<div class="count"><?= $agenda ?></div>
				<h3><a href="<?= site_url('agenda') ?>">Agenda</a></h3>
				<p>Total</p>
			</div>
		</div>
	<?php } ?>

	<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 hidden">
		<div class="tile-stats">
			<div class="icon"><i class="fa fa-briefcase"></i></div>
			<div class="count"><?= $sppd ?></div>
			<h3>SPPD</h3>
			<p>Total</p>
		</div>
	</div>
</div>
<br />
<div>
	Selamat datang di aplikasi <b>Surat Menyurat dan Disposisi</b> - RSU Muslimat Ponorogo
</div>