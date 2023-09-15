<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengirim_surat extends CI_Controller {

	var $title = "Pengirim Surat";

	function __construct()
	{
		parent::__construct();
		cek_session();
		cek_admin();
		$this->load->model('pengirim_m', 'pengirim');
	}

	public function index()
	{
		$data['row'] = $this->pengirim->get()->result();
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'Master/Pengirim/pengirim_data', $data);
    }

    public function add()
    {
    	$pengirim = new stdClass();
		$pengirim->id_pengirim = null;
		$pengirim->nama_pengirim = null;
		$pengirim->uraian = null;
		$data = array('page' => 'add', 'row' => $pengirim, 'judul' => 'Tambah');
		$this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Master/Pengirim/pengirim_form', $data);   
    }

	public function edit($id)
	{
		if($id != "") {
			$sql = $this->pengirim->get($id);
			if($sql->num_rows() > 0) {
				$pengirim = $sql->row();
				$data = array('page' => 'edit', 'row' => $pengirim, 'judul' => 'Edit');
				$this->template->set('title', $this->title);
		        $this->template->load('inc/template', 'Master/Pengirim/pengirim_form', $data);  
			} else {
				redirect('pengirim_surat');	
			}
		} else {
			echo "<script>window.location='".site_url('pengirim_surat')."';</script>";
		}
	}

    public function proses()
	{
		if(@$_POST['add']) {
			$data = $this->input->post(null, TRUE);
			$this->pengirim->add($data);
		} else if(@$_POST['edit']) {
			$data = $this->input->post(null, TRUE);
			$this->pengirim->edit($data);
		}
		redirect('pengirim_surat');
	}

    public function del($id)
	{
		if($id != '') {
			$this->pengirim->del($id);
		}
		redirect('pengirim_surat');
	}

}
