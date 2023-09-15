<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		cek_session();
		$this->load->model('surat_in_m', 'surat_in');
		$this->load->model('surat_out_m', 'surat_out');
		$this->load->model('agenda_m', 'agenda');
		$this->load->model('sppd_m', 'sppd');
		$this->load->model('disposisi_m', 'disposisi');
	}

	public function index()
	{
		// $data = hitung_disposisi_2();
		// // var_dump($data['jml']);
		// // exit();
		// if ($this->session->userdata('level_user') == '2') {
		// 	$in = $this->surat_in->get_disp();
		// } else {
		// 	$in = $this->surat_in->get2();
		// }
		// $jml = 0;

		// //Hitung Jumlah Surat yang belum di Disposisi
		// foreach ($in->result() as $r => $d) {
		// 	if ($this->disposisi->cek_ada_disposisi($d->id_surat_in)->num_rows() == 0) {
		// 		$jml = $jml + 1;
		// 	}
		// }

		// if ($this->session->userdata('level_user') == '1') {
		// 	$data['row'] = $this->surat_in->get_tatausaha()->result();
		// } else if ($this->session->userdata('level_user') == '2') {
		// 	$data['row'] = $this->surat_in->get()->result();
		// } else {
		// 	$data['row'] = $this->surat_in->get2()->result();
		// }

		$data = array(
			'surat_masuk' => $this->surat_in->get()->num_rows(),
			'surat_keluar' => $this->surat_out->get()->num_rows(),
			'agenda' => $this->agenda->get()->num_rows(),
			// 'jml' => $jml,
			// 'row' => $data['row'],
		);
		$this->template->set('title', 'Dashboard');
		$this->template->load('inc/template', 'inc/dashboard', $data);
	}
}
