<?php
/* This project is developed by yukcoding.co.id */
include_once 'libs/_header.php';
echo '<link rel="icon" type="image/png" href="'.base_url().'assets/build/images/icon.png">';
echo "<title>Cetak Laporan Hasil</title>";
echo '<link href="'.base_url().'assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">';

echo '<br><br><div class="container">';
date_default_timezone_set('Asia/Jakarta');
echo date('H:i:s'), ' Generating data to word ...', EOL;
echo '<br><a href="'.base_url().'libs/results/Laporan/LaporanHasil-'.$row->id_sppd.'.docx" class="btn btn-success">Download File</a>';
echo '</div>';

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('libs/templates/laporan_hasil.docx');

if($row->tgl_berangkat == $row->tgl_kembali) {
	$tgl = tgl_bln_indo($row->tgl_berangkat);
} else {
	$tgl1 = substr($row->tgl_berangkat,8,2);
	$tgl2 = substr($row->tgl_kembali,8,2);
	$bln1 = substr($row->tgl_berangkat,5,2);
	$bln2 = substr($row->tgl_kembali,5,2);
	$thn1 = substr($row->tgl_berangkat,0,4);
	$thn2 = substr($row->tgl_kembali,0,4);
	if($tgl1 != $tgl2 && $bln1 == $bln2 && $thn1 == $thn2) {
		$tgl = $tgl1." - ".tgl_bln_indo($row->tgl_kembali);
	} else {
		$tgl = tgl_bln_indo($row->tgl_berangkat)." - ".tgl_bln_indo($row->tgl_kembali);
	}
}

$templateProcessor->setValue('nama_kegiatan', $row->maksud);
$templateProcessor->setValue('tgl_kegiatan', $tgl);
$templateProcessor->setValue('tgl_surat', tgl_bln_indo($ttd->tgl_surat));

$templateProcessor->cloneRow('dasar', $dasar->num_rows());
$no = 1;
foreach ($dasar->result() as $r => $data) {
	$templateProcessor->setValue('dasar#'.$no, $data->uraian);
	$templateProcessor->setValue('no_dasar#'.$no, $no);
	$no++;
}

$templateProcessor->cloneRow('laporan', $hal->num_rows());
$no2 = 1;
foreach ($hal->result() as $h => $data) {
	$templateProcessor->setValue('laporan#'.$no2, $data->uraian);
	$templateProcessor->setValue('no_laporan#'.$no2, $no2);
	$no2++;
}

$a = $pelaksana->num_rows(); $b = $pengikut->num_rows();
$jml_pelaksana = intval($a) + intval($b);
$templateProcessor->cloneRow('pelpen', $jml_pelaksana);
$no_i = 1; $no_j =1; $no_k = 1;
foreach ($pelaksana->result() as $r => $data) {
	$templateProcessor->setValue('no#'.$no_i++, $no_j++);
	$templateProcessor->setValue('pelpen#'.$no_k++, $data->nama_lengkap);
	$this->db->select('nama_lengkap');
	$this->db->from('tb_sppd_pengikut');
	$this->db->join('tb_pegawai', 'tb_sppd_pengikut.pegawai = tb_pegawai.id_user');
	$this->db->where('id_pelaksana', $data->id_pelaksana);
	$query = $this->db->get();
	foreach ($query->result() as $r => $data) {
		$templateProcessor->setValue('no#'.$no_i++, $no_j++);
		$templateProcessor->setValue('pelpen#'.$no_k++, $data->nama_lengkap);
	}
}
// $templateProcessor->cloneRow('pelpen', $pelpen->num_rows());
// $no3 = 1;
// foreach ($pelpen->result() as $p => $data) {
// 	$templateProcessor->setValue('pelpen#'.$no3, $data->nama_lengkap);
// 	$templateProcessor->setValue('no#'.$no3, $no3);
// 	$no3++;
// }

$templateProcessor->setValue('jabatan', $ttd->nama_jabatan);
$templateProcessor->setValue('nama_pegawai', $ttd->nama_lengkap);
$templateProcessor->setValue('nip', $ttd->nip);


$templateProcessor->saveAs('libs/results/Laporan/LaporanHasil-'.$row->id_sppd.'.docx');

/* This project is developed by yukcoding.co.id */