<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tujuan_surat extends CI_Controller
{

	var $title = "Tujuan Surat";

	function __construct()
	{
		parent::__construct();
		cek_session();
		//cek_admin();
		$this->load->model('Tujuan_m', 'tujuan');
	}

	public function index()
	{
		$data['row'] = $this->tujuan->get()->result();
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'Master/Tujuan/tujuan_data', $data);
	}

	public function add()
	{
		$tujuan = new stdClass();
		$tujuan->id_tujuan = null;
		$tujuan->alamat_tujuan = null;
		$tujuan->uraian = null;
		$data = array('page' => 'add', 'row' => $tujuan, 'judul' => 'Tambah');
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'Master/Tujuan/tujuan_form', $data);
	}

	public function edit($id)
	{
		if ($id != "") {
			$sql = $this->tujuan->get($id);
			if ($sql->num_rows() > 0) {
				$tujuan = $sql->row();
				$data = array('page' => 'edit', 'row' => $tujuan, 'judul' => 'Edit');
				$this->template->set('title', $this->title);
				$this->template->load('inc/template', 'Master/Tujuan/tujuan_form', $data);
			} else {
				redirect('tujuan_surat');
			}
		} else {
			echo "<script>window.location='" . site_url('tujuan_surat') . "';</script>";
		}
	}

	public function proses()
	{
		if (@$_POST['add']) {
			$data = $this->input->post(null, TRUE);
			$this->tujuan->add($data);
		} else if (@$_POST['edit']) {
			$data = $this->input->post(null, TRUE);
			$this->tujuan->edit($data);
		}
		redirect('tujuan_surat');
	}

	public function del($id)
	{
		if ($id != '') {
			$this->tujuan->del($id);
		}
		redirect('tujuan_surat');
	}
}
