<?php
$page = $this->uri->segment(1);
$page2 = $this->uri->segment(2);
$page3 = $this->uri->segment(3); ?>
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="<?= site_url('dashboard') ?>" class="nav-link <?= $page == 'dashboard' ? "active" : null ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <?php if ($this->session->userdata('level_user') == '0') {
            if ($page == 'jabatan') {
                $active = 'menu-open"';
                $block = 'active';
                $c1 = 'active';
                $c2 = null;
                $c3 = null;
                $c4 = null;
                $c5 = null;
                $c6 = null;
            } else if ($page == 'pegawai') {
                $active = 'menu-open"';
                $block = 'active';
                $c2 = 'active';
                $c1 = null;
                $c3 = null;
                $c4 = null;
                $c5 = null;
                $c6 = null;
            } else if ($page == 'kategori_surat') {
                $active = 'menu-open"';
                $block = 'active';
                $c3 = 'active';
                $c1 = null;
                $c2 = null;
                $c4 = null;
                $c5 = null;
                $c6 = null;
            } else if ($page == 'pengirim_surat') {
                $active = 'menu-open"';
                $block = 'active';
                $c4 = 'active';
                $c1 = null;
                $c2 = null;
                $c3 = null;
                $c5 = null;
                $c6 = null;
            } else if ($page == 'tujuan_surat') {
                $active = 'menu-open"';
                $block = 'active';
                $c5 = 'active';
                $c1 = null;
                $c2 = null;
                $c3 = null;
                $c4 = null;
                $c6 = null;
            } else if ($page == 'golongan') {
                $active = 'menu-open"';
                $block = 'style="display:block"';
                $c6 = 'active';
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
            }
        ?>
            <li class="nav-item <?= $active ?>">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-box"></i>
                    <p>
                        Master
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= site_url('golongan') ?>" class="nav-link <?= $c6 ?>">
                            <i class="far fa-circle nav-icon"></i>
                            Golongan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('jabatan') ?>" class="nav-link <?= $c1 ?>">
                            <i class="far fa-circle nav-icon"></i>
                            Jabatan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('pegawai') ?>" class="nav-link <?= $c2 ?>">
                            <i class="far fa-circle nav-icon"></i>
                            Pegawai
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('kategori_surat') ?>" class="nav-link <?= $c3 ?>">
                            <i class="far fa-circle nav-icon"></i>
                            Kategori Surat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('pengirim_surat') ?>" class="nav-link <?= $c4 ?>">
                            <i class="far fa-circle nav-icon"></i>
                            Pengirim Surat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('tujuan_surat') ?>" class="nav-link <?= $c5 ?>">
                            <i class="far fa-circle nav-icon"></i>
                            Tujuan Surat
                        </a>
                    </li>
                </ul>
            </li>
        <?php } else { ?>
            <li class="nav-item">
                <a href="<?= site_url('agenda') ?>" class="nav-link <?= $page == 'agenda' && $page2 != 'report' ? "active" : null ?>">
                    <i class="nav-icon fas fa-calendar"></i>
                    <p>
                        Agenda
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('surat_masuk') . "?s=b" ?>" class="nav-link <?= ($page == 'surat_masuk' || $page == 'disposisi')  && $page2 != 'report' ? "active" : null ?>">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>
                        Surat Masuk
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" <?= ($page == 'surat_masuk' && @$_GET['s'] != '')  ? 'style="display: block;"' : null ?>>
                    <li class="nav-item">
                        <a href="<?= site_url('surat_masuk?s=A') ?>" class="nav-link <?= ($page == 'surat_masuk' && @$_GET['s'] == 'A')  ? "active" : null ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Semua Surat</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('surat_masuk?s=b') ?>" class="nav-link <?= ($page == 'surat_masuk' && @$_GET['s'] == 'b')  ? "active" : null ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Surat Bulan Ini</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('surat_masuk?s=n') ?>" class="nav-link <?= ($page == 'surat_masuk' && @$_GET['s'] == 'n')  ? "active" : null ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Belum Disposisi</p>
                            <span class="right badge badge-danger"><?= $jml ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('surat_masuk?s=y') ?>" class="nav-link <?= ($page == 'surat_masuk' && @$_GET['s'] == 'y')  ? "active" : null ?>">
                            <i class="far fa-circle nav-icon"></i>
                            Sudah Disposisi
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('surat_keluar') ?>" class="nav-link <?= $page == 'surat_keluar' && $page2 != 'report' ? "active" : null ?>">
                    <i class="nav-icon fas fa-envelope-open"></i>
                    <p>
                        Surat Keluar
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="" class="nav-link ">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Laporan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="<?= site_url('surat_masuk/report') ?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Surat Masuk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('surat_keluar/report') ?>" class="nav-link <?= $page == 'surat_keluar' && $page2 == 'report' ? "active" : null ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Surat Keluar</p>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
    </ul>
</nav>
<!-- /.sidebar-menu -->