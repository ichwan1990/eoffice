<?php 
$page = $this->uri->segment(1);
$page2 = $this->uri->segment(2);
$page3 = $this->uri->segment(3); ?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<h3>Menu Utama</h3>
		<ul class="nav side-menu">
			<li <?= $page == 'dashboard' ? 'class="active"' : null ?>><a href="<?= site_url('dashboard') ?>"><i class="fa fa-home"></i> Dashboard</a></li>
			<?php
			if ($this->session->userdata('level_user') == '1' || $this->session->userdata('level_user') == '2') { ?>
				<li <?= $page == 'agenda' && $page2 != 'report' ? 'class="active"' : null ?>><a href="<?= site_url('agenda') ?>"><i class="fa fa-calendar"></i> Agenda</a></li>
			<?php }
			if ($this->session->userdata('level_user') != '0') { ?>
				<li <?= ($page == 'surat_masuk' || $page == 'disposisi')  && $page2 != 'report' ? 'class="active"' : null ?>><a href="<?= site_url('surat_masuk') ?>"><i class="fa fa-envelope"></i> Surat Masuk</a></li>
			<?php }
			if ($this->session->userdata('level_user') != '0') { ?>
				<li <?= $page == 'surat_keluar' && $page2 != 'report' ? 'class="active"' : null ?>><a href="<?= site_url('surat_keluar') ?>"><i class="fa fa-envelope-o"></i> Surat Keluar</a></li>
			<?php }

			if ($this->session->userdata('level_user') == '0') {
				if ($page == 'jabatan') {
					$active = 'class="active"';
					$block = 'style="display:block"';
					$c1 = 'class="current-page"';
					$c2 = null;
					$c3 = null;
					$c4 = null;
					$c5 = null;
					$c6 = null;
				} else if ($page == 'pegawai') {
					$active = 'class="active"';
					$block = 'style="display:block"';
					$c2 = 'class="current-page"';
					$c1 = null;
					$c3 = null;
					$c4 = null;
					$c5 = null;
					$c6 = null;
				} else if ($page == 'kategori_surat') {
					$active = 'class="active"';
					$block = 'style="display:block"';
					$c3 = 'class="current-page"';
					$c1 = null;
					$c2 = null;
					$c4 = null;
					$c5 = null;
					$c6 = null;
				} else if ($page == 'pengirim_surat') {
					$active = 'class="active"';
					$block = 'style="display:block"';
					$c4 = 'class="current-page"';
					$c1 = null;
					$c2 = null;
					$c3 = null;
					$c5 = null;
					$c6 = null;
				} else if ($page == 'tujuan_surat') {
					$active = 'class="active"';
					$block = 'style="display:block"';
					$c5 = 'class="current-page"';
					$c1 = null;
					$c2 = null;
					$c3 = null;
					$c4 = null;
					$c6 = null;
				} else if ($page == 'golongan') {
					$active = 'class="active"';
					$block = 'style="display:block"';
					$c6 = 'class="current-page"';
					$c1 = null;
					$c2 = null;
					$c3 = null;
					$c4 = null;
					$c5 = null;
				} else {
					$active = null;
					$block = null;
					$c1 = null;
					$c2 = null;
					$c3 = null;
					$c4 = null;
					$c5 = null;
					$c6 = null;
				} ?>
				<li <?= $active ?>><a><i class="fa fa-folder-open-o"></i> Master<span class="fa fa-chevron-down"></span></a>
					<ul class="nav child_menu" <?= $block ?>>
						<li <?= $c6 ?>><a href="<?= site_url('golongan') ?>">Golongan</a></li>
						<li <?= $c1 ?>><a href="<?= site_url('jabatan') ?>">Jabatan</a></li>
						<li <?= $c2 ?>><a href="<?= site_url('pegawai') ?>">Pegawai</a></li>
						<li <?= $c3 ?>><a href="<?= site_url('kategori_surat') ?>">Kategori Surat</a></li>
						<li <?= $c4 ?>><a href="<?= site_url('pengirim_surat') ?>">Pengirim Surat</a></li>
						<li <?= $c5 ?>><a href="<?= site_url('tujuan_surat') ?>">Tujuan Surat</a></li>
					</ul>
				</li>
			<?php
			}
			if ($page == 'surat_masuk' && $page2 == 'report') {
				$active = 'class="active"';
				$block = 'style="display:block"';
				$d1 = 'class="current-page"';
				$d2 = null;
				$d3 = null;
			} else if ($page == 'surat_keluar' && $page2 == 'report') {
				$active = 'class="active"';
				$block = 'style="display:block"';
				$d2 = 'class="current-page"';
				$d1 = null;
				$d3 = null;
			} else if ($page == 'agenda' && $page2 == 'report') {
				$active = 'class="active"';
				$block = 'style="display:block"';
				$d3 = 'class="current-page"';
				$d1 = null;
				$d2 = null;
			} else {
				$active = null;
				$block = null;
				$d1 = null;
				$d2 = null;
				$d3 = null;
			} ?>
			<li><a><i class="fa fa-file-text-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu" <?= $block ?>>
					<li><a href="<?= site_url('surat_masuk/report') ?>">Surat Masuk</a></li>
					<li><a href="<?= site_url('surat_keluar/report') ?>">Surat Keluar</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<?php if ($this->session->userdata('level_user') == '1') { ?>
	<div class="menu_section">
		<ul class="nav side-menu">
			<?php
			if ($page == 'sppd' && ($page2 == '' || $page2 == 'dasar' || $page2 == 'pelaksana' || $page2 == 'pengikut' || $page2 == 'add' || $page2 == 'edit')) {
				$active = 'class="active"';
				$block = 'style="display:block"';
				$e2 = 'class="current-page"';
				$e1 = null;
				$e3 = null;
				$e4 = null;
			} else if ($page == 'sppd' && $page2 == 'kegiatan') {
				$active = 'class="active"';
				$block = 'style="display:block"';
				$e1 = 'class="current-page"';
				$e2 = null;
				$e3 = null;
				$e4 = null;
			} else if ($page == 'sppd' && $page2 == 'surat_sppd') {
				$active = 'class="active"';
				$block = 'style="display:block"';
				$e3 = 'class="current-page"';
				$e1 = null;
				$e2 = null;
				$e4 = null;
			} else if ($page == 'sppd' && $page2 == 'report') {
				$active = 'class="active"';
				$block = 'style="display:block"';
				$e4 = 'class="current-page"';
				$e1 = null;
				$e2 = null;
				$e3 = null;
			} else if ($page == 'sppd' && ($page3 == 'ttd' || $page3 == 'hal' || $page3 == 'pelpen')) {
				$active = 'class="active"';
				$block = 'style="display:block"';
				$e4 = 'class="current-page"';
				$e1 = null;
				$e2 = null;
				$e3 = null;
			} else {
				$active = null;
				$block = null;
				$e1 = null;
				$e2 = null;
				$e3 = null;
				$e4 = null;
			} ?>
			<li class="disabled" ><a><i class="fa fa-briefcase"></i> SPPD <span class="fa fa-chevron-down" ></span></a>
				<ul class="nav child_menu" <?= $block ?>>
					<li <?= $e1 ?>><a href="<?= site_url('sppd/kegiatan') ?>">Master Kegiatan</a></li>
					<li <?= $e2 ?>><a href="<?= site_url('sppd') ?>">Input SPPD</a></li>
					<li <?= $e3 ?>><a href="<?= site_url('sppd/surat_sppd') ?>">Cetak SPPD</a></li>
					<li <?= $e4 ?>><a href="<?= site_url('sppd/report') ?>">Laporan SPPD</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<?php } ?>
</div>


<!-- Developed by yukcoding.co.id -->