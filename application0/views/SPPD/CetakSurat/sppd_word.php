<?php
/* This project is developed by yukcoding.co.id */
include_once 'libs/_header.php';
echo '<link rel="icon" type="image/png" href="'.base_url().'assets/build/images/icon.png">';
echo "<title>Cetak SPPD</title>";
echo '<link href="'.base_url().'assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">';

echo '<br><br><div class="container">';
date_default_timezone_set('Asia/Jakarta');
echo date('H:i:s'), ' Generating data to word ...', EOL;
echo '<br><a href="'.base_url().'libs/results/SPPD/SPPD-'.$row->id_sppd.'.docx" class="btn btn-success">Download File</a>';
echo '</div>';

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('libs/templates/sppd.docx');

function lama_hari($tgl1, $tgl2) {
	$date1 = date_create($tgl1);
	$date2 = date_create($tgl2);
	$diff = date_diff($date1, $date2);
	return $diff->format('%a') + 1;
}

$templateProcessor->setValue('no_sppd', $row->no_sppd);
$templateProcessor->setValue('tgl_sppd', tgl_bln_indo($row->tgl_sppd));  
$templateProcessor->setValue('maksud', $row->maksud);
$templateProcessor->setValue('kendaraan', $row->kendaraan);
$templateProcessor->setValue('tempat_berangkat', $row->tempat_berangkat);
$templateProcessor->setValue('tempat_tujuan', $row->tempat_tujuan);
$templateProcessor->setValue('lama', lama_hari($row->tgl_berangkat, $row->tgl_kembali));
$templateProcessor->setValue('tgl_berangkat', tgl_bln_indo($row->tgl_berangkat));
$templateProcessor->setValue('tgl_kembali', tgl_bln_indo($row->tgl_kembali));

$templateProcessor->setValue('kode_rek', $row->kode_rek);
$templateProcessor->setValue('keterangan', $row->keterangan);

$templateProcessor->setValue('jabatan_kepala', $row->nama_jabatan);

$data = $pelaksana->row();
$templateProcessor->setValue('nama_pelaksana', $data->nama_lengkap);
$templateProcessor->setValue('nip_pelaksana', $data->nip);
$templateProcessor->setValue('golongan_pelaksana', $data->golongan != 0 ? $data->nama_gol." (".$data->kode_gol.")" : null);
$templateProcessor->setValue('jabatan_pelaksana', $data->nama_jabatan);


$templateProcessor->cloneRow('no_pengikut', $pengikut->num_rows());
$no_i = 1; $no_j = 1; $no_k = 1;
foreach ($pengikut->result() as $r => $data) {
	$templateProcessor->setValue('no_pengikut#'.$no_i++, $no_j++);
	$templateProcessor->setValue('nama_pengikut#'.$no_k++, $data->nama_lengkap);
}

if($row->level_jabatan == '3') {
	$an = "an. Kepala Dinas Komunikasi dan Informatika";	
} else {
	$an = null;
}
$templateProcessor->setValue('an', $an);
$templateProcessor->setValue('jabatan_ttd', $row->jabatan_ttd);
$templateProcessor->setValue('nama_ttd', $row->nama_ttd);
$templateProcessor->setValue('nip_ttd', $row->nip);

$templateProcessor->saveAs('libs/results/SPPD/SPPD-'.$row->id_sppd.'.docx');

/* This project is developed by yukcoding.co.id */