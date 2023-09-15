<?php
/* This project is developed by yukcoding.co.id */
include_once 'libs/_header.php';
echo '<link rel="icon" type="image/png" href="'.base_url().'assets/build/images/icon.png">';
echo "<title>Cetak Surat Perintah Tugas</title>";
echo '<link href="'.base_url().'assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">';
// echo '<link href="'.base_url().'assets/build/css/custom.min.css" rel="stylesheet">';

echo '<br><br><div class="container">';
date_default_timezone_set('Asia/Jakarta');
echo date('H:i:s'), ' Generating data to word ...', EOL;
echo '<br><a href="'.base_url().'libs/results/SPT/SuratPerintahTugas-'.$row->id_sppd.'.docx" class="btn btn-success">Download File</a>';
echo '</div>';

$templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('libs/templates/perintah_tugas.docx');

function hari_indo($tanggal) {
	$day = date('D', strtotime($tanggal));
	$dayList = array('Sun' => 'Minggu', 'Mon' => 'Senin', 'Tue' => 'Selasa', 'Wed' => 'Rabu', 'Thu' => 'Kamis', 'Fri' => 'Jumat', 'Sat' => 'Sabtu');
	return $dayList[$day];
}

if($row->tgl_berangkat == $row->tgl_kembali) {
	$hari = hari_indo($row->tgl_berangkat);
	$tgl = tgl_bln_indo($row->tgl_berangkat);
} else {
	$hari = hari_indo($row->tgl_berangkat)." - ".hari_indo($row->tgl_kembali);
	$tgl = tgl_bln_indo($row->tgl_berangkat)." - ".tgl_bln_indo($row->tgl_kembali);
}

$templateProcessor->setValue('no_sppd', $row->no_sppd);
$templateProcessor->setValue('tgl_sppd', tgl_bln_indo($row->tgl_sppd));  
$templateProcessor->setValue('maksud', $row->maksud);
$templateProcessor->setValue('hari', $hari);
$templateProcessor->setValue('tanggal', $tgl);
$templateProcessor->setValue('tempat', $row->tempat_tujuan); 

$templateProcessor->cloneRow('dasar', $dasar->num_rows());

$no_a = 1; $no_b =1; $no_c = 1;
foreach ($dasar->result() as $r => $data) {
	$templateProcessor->setValue('dasar#'.$no_a++, $data->uraian);
	$templateProcessor->setValue('no_dasar#'.$no_b++, $no_c++);
};

$a = $pelaksana->num_rows();
$b = $pengikut->num_rows();
$jml_pelaksana = intval($a) + intval($b);
$templateProcessor->cloneRow('no_pelaksana', $jml_pelaksana);

$no_i = 1; $no_j =1; $no_k = 1; $no_l = 1; $no_m = 1;
foreach ($pelaksana->result() as $r => $data) {
	$templateProcessor->setValue('no_pelaksana#'.$no_i++, $no_j++);
	$templateProcessor->setValue('nama_pelaksana#'.$no_k++, $data->nama_lengkap);
	$templateProcessor->setValue('nip_pelaksana#'.$no_l++, $data->nip);
	$templateProcessor->setValue('jabatan_pelaksana#'.$no_m++, $data->nama_jabatan);

	$this->db->select('*');
	$this->db->from('tb_sppd_pengikut');
	$this->db->join('tb_pegawai', 'tb_sppd_pengikut.pegawai = tb_pegawai.id_user');
	$this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
	$this->db->where('id_pelaksana', $data->id_pelaksana);
	$query = $this->db->get();
	foreach ($query->result() as $r => $data) {
		$templateProcessor->setValue('no_pelaksana#'.$no_i++, $no_j++);
		$templateProcessor->setValue('nama_pelaksana#'.$no_k++, $data->nama_lengkap);
		$templateProcessor->setValue('nip_pelaksana#'.$no_l++, $data->nip);
		$templateProcessor->setValue('jabatan_pelaksana#'.$no_m++, $data->nama_jabatan);
	}
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

$templateProcessor->saveAs('libs/results/SPT/SuratPerintahTugas-'.$row->id_sppd.'.docx');

/* This project is developed by yukcoding.co.id */