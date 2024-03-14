<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	var $title = "Kebijakan";

	function __construct()
	{
		parent::__construct();
		cek_session();
		$this->load->model('surat_in_m', 'surat_in');
		$this->load->model('disposisi_m', 'disposisi');
		$this->load->model('dokumen_m', 'kebijakan');
	}

	public function index()
	{
		if($this->session->userdata('level_user') == '0') { redirect('dashboard'); }
		$this->template->set('title', $this->title);

		if($this->session->userdata('level_user') == '1') {
		    $data['row'] = $this->kebijakan->get()->result();
		} else if ($this->session->userdata('level_user') == '2') {
			$data['row'] = $this->kebijakan->get()->result();
		} else {
			$data['row'] = $this->kebijakan->get()->result();
		}
		$this->template->load('inc/template', 'Dokumen/dokumen_kebijakan_data', $data);
    }
    
    	public function kebijakan()
	{
		if($this->session->userdata('level_user') == '0') { redirect('dashboard'); }
		$this->template->set('title', $this->title);

		if($this->session->userdata('level_user') == '1') {
		    $data['row'] = $this->kebijakan->get()->result();
		} else if ($this->session->userdata('level_user') == '2') {
			$data['row'] = $this->kebijakan->get()->result();
		} else {
			$data['row'] = $this->kebijakan->get()->result();
		}
		$this->template->load('inc/template', 'Dokumen/dokumen_kebijakan_data', $data);
    }
/*
    public function add()
    {
    	if($this->session->userdata('level_user') == '0') { redirect('dashboard'); }
    	cek_level_1();
    	$kode_agenda = $this->surat_in->no_agenda();
    	$surat_in = new stdClass();
		$surat_in->id_surat_in = null;
		$surat_in->no_agenda = $kode_agenda;
		$surat_in->kategori = null;
		$surat_in->input_pengirim = null;
		$surat_in->pengirim = null;
		$surat_in->no_surat = null;
		$surat_in->tgl_surat = null;
		$surat_in->tgl_selesai = null;
		$surat_in->perihal = null;
		$surat_in->isi_ringkas = null;
		$surat_in->sifat_surat = null;
		$surat_in->keterangan = null;
		$this->load->model('kategori_m', 'kategori');
        $sql = $this->kategori->get('tb_kategori_surat');
        $kategori[null] = '';
        foreach($sql->result() as $ktg) {
            $kategori[$ktg->id_kategori] = $ktg->kode_kategori." - ".$ktg->nama_kategori;
        }
		$this->load->model('pengirim_m', 'pengirim');
        $sql = $this->pengirim->get();
        $pengirim[null] = '';
        foreach($sql->result() as $pgm) {
            $pengirim[$pgm->nama_pengirim] = $pgm->nama_pengirim;
        }
		$data = array(
			'page' => 'add', 
			'row' => $surat_in, 
			'judul' => 'Tambah',
			'kategori' => $kategori, 'selectedkategori' => null,
			'pengirim' => $pengirim, 'selectedpengirim' => null
		);
		$this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Surat_in/surat_in_form', $data);   
    }

	public function edit($id)
	{
		if($this->session->userdata('level_user') == '0') { redirect('dashboard'); }
		cek_level_1();
		if($id != "") {
			$sql = $this->surat_in->get($id);
			if($sql->num_rows() > 0) {
				$surat_in = $sql->row();
				$this->load->model('kategori_m', 'kategori');
                $sql = $this->kategori->get('tb_kategori_surat');
                $kategori[null] = '';
                foreach($sql->result() as $ktg) {
                    $kategori[$ktg->id_kategori] = $ktg->kode_kategori." - ".$ktg->nama_kategori;
                }
				$this->load->model('pengirim_m', 'pengirim');
		        $sql = $this->pengirim->get();
		        $pengirim[null] = '';
		        foreach($sql->result() as $pgm) {
		            $pengirim[$pgm->nama_pengirim] = $pgm->nama_pengirim;
		        }
				$data = array(
					'page' => 'edit', 
					'row' => $surat_in, 
					'judul' => 'Edit',
					'kategori' => $kategori, 'selectedkategori' => $surat_in->kategori,
					'pengirim' => $pengirim, 'selectedpengirim' => $surat_in->pengirim
				);
				$this->template->set('title', $this->title);
		        $this->template->load('inc/template', 'Surat_in/surat_in_form', $data);  
			} else {
				redirect('surat_masuk');	
			}
		} else {
			echo "<script>window.location='".site_url('surat_masuk')."';</script>";
		}
	}

    public function proses()
	{
		if($this->session->userdata('level_user') == '0') { redirect('dashboard'); }
		if(@$_POST['add']) {
			if(@$_FILES['file_surat']['name'] != '') {
				$config['upload_path']   = './uploads/surat_masuk/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|docx|doc|xls|xlsx|txt|ppt|pptx|rtf';
				$config['file_name']     = 'Surat-In-'.date('ymd').'-'.substr(md5(rand()),0,10);
				$config['max_size']		 = '10240';
				$config['create_thumb']  = 'False';
				$this->load->library('upload', $config);
				if($this->surat_in->cek_no_agenda($this->input->post('no_agenda'))->num_rows() > 0) {
	                echo "<script>alert('No. Agenda sudah diinput sebelumnya'); window.location='add';</script>";
	            } else {
					if($this->upload->do_upload('file_surat')){
						// chmod($target_file, 0777);
						$data = $this->input->post(null, TRUE);
						$data['file'] = $this->upload->data('file_name');
						$this->surat_in->add($data);
						echo "<script>window.location='".site_url('surat_masuk')."';</script>";
						// print_r($data);
					} else {
						$error = $this->upload->display_errors();
						echo "<script>alert('".$error."');</script>";
						echo "<script>window.location='".site_url('surat_masuk/add')."';</script>";
					}
				}
			} else {
				if($this->surat_in->cek_no_agenda($this->input->post('no_agenda'))->num_rows() > 0) {
	                echo "<script>alert('No. Agenda sudah diinput sebelumnya'); window.location='add';</script>";
	            } else {
					$data = $this->input->post(null, TRUE);
					$data['file'] = '';
					$this->surat_in->add($data);
					echo "<script>window.location='".site_url('surat_masuk')."';</script>";
				}
			}
		} else if(@$_POST['edit']) {
			if(@$_FILES['file_surat']['name'] != '') {
				$config['upload_path']   = './uploads/surat_masuk/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|docx|doc|xls|xlsx|txt|ppt|pptx|rtf';
				$config['file_name']     = 'Surat-In-'.date('ymd').'-'.substr(md5(rand()),0,10);
				$config['max_size']		 = '10240';
				$this->load->library('upload', $config);
				if($this->surat_in->cek_no_agenda($this->input->post('no_agenda'), $this->input->post('id'))->num_rows() > 0) {
	                echo "<script>alert('No. Agenda sudah diinput sebelumnya'); window.location='edit/".$this->input->post('id')."';</script>";
	            } else {
					if($this->upload->do_upload('file_surat')){
						$surat_in = $this->surat_in->get($this->input->post('id'))->row();
						if($surat_in->file_surat != "") {
							$target_file = './uploads/surat_masuk/'.$surat_in->file_surat;
							if(file_exists($target_file)) {
								unlink($target_file);
							}
						}
						$data = $this->input->post(null, TRUE);
						$data['file'] = $this->upload->data('file_name');
						$this->surat_in->edit($data);
						echo "<script>window.location='".site_url('surat_masuk')."';</script>";
					} else {
						$error = $this->upload->display_errors();
						echo "<script>alert('".$error."');</script>";
						echo "<script>window.location='".site_url('surat_masuk/edit/'.$this->input->post('id'))."';</script>";
					}
				}
			} else {
				if($this->surat_in->cek_no_agenda($this->input->post('no_agenda'), $this->input->post('id'))->num_rows() > 0) {
	                echo "<script>alert('No. Agenda sudah diinput sebelumnya'); window.location='edit/".$this->input->post('id')."';</script>";
	            } else {
					$data = $this->input->post(null, TRUE);
					$data['file'] = '';
					$this->surat_in->edit($data);
					echo "<script>window.location='".site_url('surat_masuk')."';</script>";
				}
			}
		}
	}

*/

    public function del($id)
	{
		if($this->session->userdata('level_user') == '0') { redirect('dashboard'); }
		if($id != '') {
			if($this->session->userdata('level_user') == '1') {
				$kebijakan = $this->kebijakan->get($id)->row();
				if($kebijakan->file_kebijakan != "") {
					$target_file = './uploads/kebijakan/'.$kebijakan->file_kebijakan;
					if(file_exists($target_file)) {
						unlink($target_file);
					}
				}
				if($this->kebijakan->del($id) == 1) {
					redirect('dokumen/kebijakan');
				} else {
					echo "<script>alert('Dokumen Kebijakan tidak dapat dihapus'); window.location='".site_url('dokumen/kebijakan')."';</script>";
				}
			}
		}
	}

	public function edaran()
	{
		$this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Dokumen/dokumen_edaran_data'); 
	}

}
