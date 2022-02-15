<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends CI_Controller {

	var $title = "Surat Keluar";

	function __construct()
	{
		parent::__construct();
		cek_session();
		$this->load->model('surat_out_m', 'surat_out');
	}

	public function index()
	{
		cek_level_1();
		$data['row'] = $this->surat_out->get()->result();
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'Surat_out/surat_out_data', $data);
    }

    public function add()
    {
		cek_level_1();
    	$surat_out = new stdClass();
		$surat_out->id_surat_out = null;
		$surat_out->no_agenda = $this->surat_out->no_agenda()->row()->no + 1;
		$surat_out->tgl_surat = null;
		$surat_out->no_surat = null;
		$surat_out->perihal = null;
		$surat_out->isi_ringkas = null;
		$surat_out->keterangan = null;
		$this->load->model('kategori_m', 'kategori');
        $sql1 = $this->kategori->get('tb_kategori_surat');
        $kategori[null] = '';
        foreach($sql1->result() as $ktg) {
            $kategori[$ktg->id_kategori] = $ktg->kode_kategori." - ".$ktg->nama_kategori;
        }
		$this->load->model('tujuan_m', 'tujuan');
        $sql2 = $this->tujuan->get();
        $tujuan[null] = '';
        foreach($sql2->result() as $tjn) {
            $tujuan[$tjn->id_tujuan] = $tjn->alamat_tujuan;
        }
        $this->load->model('jabatan_m', 'pengolah');
        $sql3 = $this->pengolah->getfor_suratout();
        $pengolah[null] = '';
        foreach($sql3->result() as $pgh) {
            $pengolah[$pgh->kode_surat] = $pgh->nama_jabatan;
        }
		$data = array(
			'page' => 'add', 
			'row' => $surat_out, 
			'judul' => 'Tambah',
			'kategori' => $kategori, 'selectedkategori' => null,
			'tujuan' => $tujuan, 'selectedtujuan' => null,
			'pengolah' => $pengolah, 'selectedpengolah' => null,
		);
		$this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Surat_out/surat_out_form', $data);   
    }

	public function edit($id)
	{
		cek_level_1();
		if($id != "") {
			$sql = $this->surat_out->get($id);
			if($sql->num_rows() > 0) {
				$surat_out = $sql->row();
				$this->load->model('kategori_m', 'kategori');
                $sql1 = $this->kategori->get('tb_kategori_surat');
                $kategori[null] = '';
                foreach($sql1->result() as $ktg) {
                    $kategori[$ktg->id_kategori] = $ktg->kode_kategori." - ".$ktg->nama_kategori;
                }
				$this->load->model('tujuan_m', 'tujuan');
		        $sql2 = $this->tujuan->get();
		        $tujuan[null] = '';
		        foreach($sql2->result() as $tjn) {
		            $tujuan[$tjn->id_tujuan] = $tjn->alamat_tujuan;
		        }

		        $this->load->model('jabatan_m', 'pengolah');
		        $sql3 = $this->pengolah->getfor_suratout();
		        $pengolah[null] = '';
		        foreach($sql3->result() as $pgh) {
		            $pengolah[$pgh->kode_surat] = $pgh->nama_jabatan;
		        }
				$data = array(
					'page' => 'edit', 
					'row' => $surat_out, 
					'judul' => 'Edit',
					'kategori' => $kategori, 'selectedkategori' => $surat_out->kategori,
					'tujuan' => $tujuan, 'selectedtujuan' => $surat_out->tujuan,
					'pengolah' => $pengolah, 'selectedpengolah' => $surat_out->pengolah,
				);
				$this->template->set('title', $this->title);
		        $this->template->load('inc/template', 'Surat_out/surat_out_form', $data);  
			} else {
				redirect('surat_keluar');	
			}
		} else {
			echo "<script>window.location='".site_url('surat_keluar')."';</script>";
		}
	}

    public function proses()
	{
		cek_level_1();
		if(@$_POST['add']) {
			if(@$_FILES['file_surat']['name'] != '') {
				$config['upload_path']   = './uploads/surat_keluar/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|docx|doc|xls|xlsx|txt|ppt|pptx|rtf';
				$config['file_name']     = 'Surat-Out-'.date('ymd').'-'.substr(md5(rand()),0,10);
				$config['max_size']		 = '20480';
				$this->load->library('upload', $config);
				if($this->surat_out->cek_no_agenda($this->input->post('no_agenda'))->num_rows() > 0) {
	                echo "<script>alert('No. Agenda sudah diinput sebelumnya'); window.location='add';</script>";
	            } else {
					if($this->upload->do_upload('file_surat')){
						$data = $this->input->post(null, TRUE);
						$data['file'] = $this->upload->data('file_name');
						$this->surat_out->add($data);
						echo "<script>window.location='".site_url('surat_keluar')."';</script>";
					} else {
						$error = $this->upload->display_errors();
						echo "<script>alert('".$error."');</script>";
						echo "<script>window.location='".site_url('surat_keluar/add')."';</script>";
					}
				}
			} else {
				if($this->surat_out->cek_no_agenda($this->input->post('no_agenda'))->num_rows() > 0) {
	                echo "<script>alert('No. Agenda sudah diinput sebelumnya'); window.location='add';</script>";
	            } else {
					$data = $this->input->post(null, TRUE);
					$data['file'] = '';
					$this->surat_out->add($data);
					echo "<script>window.location='".site_url('surat_keluar')."';</script>";
				}
			}
		} else if(@$_POST['edit']) {
			if(@$_FILES['file_surat']['name'] != '') {
				$config['upload_path']   = './uploads/surat_keluar/';
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|docx|doc|xls|xlsx|txt|ppt|pptx|rtf';
				$config['file_name']     = 'Surat_Keluar-'.date('ymd').'-'.substr(md5(rand()),0,10);
				$config['max_size']		 = '20480';
				$this->load->library('upload', $config);
				if($this->surat_out->cek_no_agenda($this->input->post('no_agenda'), $this->input->post('id'))->num_rows() > 0) {
	                echo "<script>alert('No. Agenda sudah diinput sebelumnya'); window.location='edit/".$this->input->post('id')."';</script>";
	            } else {
					if($this->upload->do_upload('file_surat')){
						$surat_out = $this->surat_out->get($this->input->post('id'))->row();
						if($surat_out->file_surat != "") {
							$target_file = './uploads/surat_keluar/'.$surat_out->file_surat;
							if(file_exists($target_file)) {
								unlink($target_file);
							}
						}
						$data = $this->input->post(null, TRUE);
						$data['file'] = $this->upload->data('file_name');
						$this->surat_out->edit($data);
						echo "<script>window.location='".site_url('surat_keluar')."';</script>";
						// print_r($data);
					} else {
						$error = $this->upload->display_errors();
						echo "<script>alert('".$error."');</script>";
						echo "<script>window.location='".site_url('surat_keluar/edit/'.$this->input->post('id'))."';</script>";
					}
				}
			} else {
				if($this->surat_out->cek_no_agenda($this->input->post('no_agenda'), $this->input->post('id'))->num_rows() > 0) {
	                echo "<script>alert('No. Agenda sudah diinput sebelumnya'); window.location='edit/".$this->input->post('id')."';</script>";
	            } else {
					$data = $this->input->post(null, TRUE);
					$data['file'] = '';
					$this->surat_out->edit($data);
					echo "<script>window.location='".site_url('surat_keluar')."';</script>";
				}
			}
		}
	}

    public function del($id)
	{
		cek_level_1();
		if($id != '') {
			if($this->session->userdata('level_user') == '1') {
				$surat_out = $this->surat_out->get($id)->row();
				if($surat_out->file_surat != "") {
					$target_file = './uploads/surat_keluar/'.$surat_out->file_surat;
					if(file_exists($target_file)) {
						unlink($target_file);
					}
				}
				$this->surat_out->del($id);
			}
		}
		redirect('surat_keluar');
	}

	public function report()
	{
		$this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Surat_out/surat_out_report'); 
	}

}
