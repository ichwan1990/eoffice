<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class golongan extends CI_Controller {

	var $title = "Golongan";

	function __construct()
	{
		parent::__construct();
		cek_session();
		cek_admin();
		$this->load->model('golongan_m', 'golongan');
	}

	public function index()
	{
		$data['row'] = $this->golongan->get()->result();
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'Master/Golongan/golongan_data', $data);
    }

    public function add()
    {
    	$golongan = new stdClass();
		$golongan->id_gol = null;
		$golongan->kode_gol = null;
		$golongan->nama_gol = null;
		$golongan->uraian = null;
		
		$data = array(
			'page' => 'add',
			'row' => $golongan,
			'judul' => 'Tambah'
		);
		$this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Master/Golongan/golongan_form', $data);   
    }

	public function edit($id)
	{
		if($id != "") {
			$sql = $this->golongan->get($id);
			if($sql->num_rows() > 0) {
				$golongan = $sql->row();
				$data = array(
					'page' => 'edit',
					'row' => $golongan,
					'judul' => 'Edit'
				);
				$this->template->set('title', $this->title);
		        $this->template->load('inc/template', 'Master/Golongan/golongan_form', $data);  
			} else {
				redirect('golongan');	
			}
		} else {
			echo "<script>window.location='".site_url('golongan')."';</script>";
		}
	}

    public function proses()
	{
		if(@$_POST['add']) {
			if($this->golongan->cek_kode_gol($this->input->post('gol'))->num_rows() > 0) {
                echo "<script>alert('Golongan sudah diinput sebelumnya'); window.location='add';</script>";
            } else {
				$data = $this->input->post(null, TRUE);
				$this->golongan->add($data);
			}
		} else if(@$_POST['edit']) {
			if($this->golongan->cek_kode_gol($this->input->post('gol'), $this->input->post('id'))->num_rows() > 0) {
                echo "<script>alert('Kode surat sudah diinput sebelumnya'); window.location='edit/".$this->input->post('id')."';</script>";
            } else {
				$data = $this->input->post(null, TRUE);
				$this->golongan->edit($data);
			}
		}
		redirect('golongan');
	}

    public function del($id)
	{
		if($id != '') {
			$this->golongan->del($id);
		}
		redirect('golongan');
	}

}
