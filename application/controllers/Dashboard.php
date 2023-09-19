<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		cek_session();
		$this->load->model('surat_in_m', 'surat_in');
		$this->load->model('surat_out_m', 'surat_out');
		$this->load->model('agenda_m', 'agenda');
		$this->load->model('sppd_m', 'sppd');
		
//  		$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
	    //$this->output->enable_profiler(TRUE); 
		$data = array(
			'surat_masuk' => $this->surat_in->get()->num_rows(),
			'surat_keluar' => 0,//$this->surat_out->get()->num_rows(),
			'agenda' => 0,//$this->agenda->get()->num_rows(),
			'sppd' => 0,//$this->sppd->get()->num_rows(),
		);
		$this->template->set('title', 'Dashboard');
		$this->template->load('inc/template', 'inc/dashboard', $data);
    }

}
