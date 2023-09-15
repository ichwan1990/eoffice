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
        <li class="nav-item">
            <a href="<?= site_url('agenda') ?>" class="nav-link <?= $page == 'agenda' && $page2 != 'report' ? "active" : null ?>">
                <i class="nav-icon fas fa-calendar"></i>
                <p>
                    Agenda
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('surat_masuk')."?s=b" ?>" class="nav-link <?= ($page == 'surat_masuk' || $page == 'disposisi')  && $page2 != 'report' ? "active" : null ?>">
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
    </ul>
</nav>
<!-- /.sidebar-menu -->