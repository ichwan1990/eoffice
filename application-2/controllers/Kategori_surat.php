<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_surat extends CI_Controller {

	var $title = "Kategori Surat";

	function __construct()
	{
		parent::__construct();
		cek_session();
		cek_admin();
		$this->load->model('Kategori_m', 'kategori');
	}

	public function index()
	{
		$data['row'] = $this->kategori->get('tb_kategori_surat')->result();
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'Master/Kategori/kategori_surat_data', $data);
    }

    public function add()
    {
    	$kategori = new stdClass();
		$kategori->id_kategori = null;
		$kategori->kode_kategori = null;
		$kategori->nama_kategori = null;
		$kategori->uraian = null;
		$data = array('page' => 'add', 'row' => $kategori, 'judul' => 'Tambah');
		$this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Master/Kategori/kategori_surat_form', $data);   
    }

	public function edit($id)
	{
		if($id != "") {
			$sql = $this->kategori->get('tb_kategori_surat', $id);
			if($sql->num_rows() > 0) {
				$kategori = $sql->row();
				$data = array('page' => 'edit', 'row' => $kategori, 'judul' => 'Edit');
				$this->template->set('title', $this->title);
		        $this->template->load('inc/template', 'Master/Kategori/kategori_surat_form', $data);  
			} else {
				redirect('kategori_surat');	
			}
		} else {
			echo "<script>window.location='".site_url('kategori_surat')."';</script>";
		}
	}

    public function proses()
	{
		if(@$_POST['add']) {
			if($this->kategori->cek_kode('tb_kategori_surat', $this->input->post('kode'))->num_rows() > 0) {
				echo "<script>alert('Kode kategori sudah digunakan sebelumnya'); window.location='add';</script>";
			} else {
				$data = $this->input->post(null, TRUE);
				$this->kategori->add('tb_kategori_surat', $data);
			}
		} else if(@$_POST['edit']) {
			if($this->kategori->cek_kode('tb_kategori_surat', $this->input->post('kode'), $this->input->post('id'))->num_rows() > 0) {
				echo "<script>alert('Kode kategori sudah digunakan sebelumnya'); window.location='edit/".$this->input->post('id')."';</script>";
			} else {
				$data = $this->input->post(null, TRUE);
				$this->kategori->edit('tb_kategori_surat', $data);
			}
		}
		redirect('kategori_surat');
	}

    public function del($id)
	{
		if($id != '') {
			$this->kategori->del('tb_kategori_surat', $id);
		}
		redirect('kategori_surat');
	}

}
