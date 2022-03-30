<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {

	var $title = "Jabatan";

	function __construct()
	{
		parent::__construct();
		cek_session();
		cek_admin();
		$this->load->model('Jabatan_m', 'jabatan');
	}

	public function index()
	{
		$data['row'] = $this->jabatan->get()->result();
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'Master/Jabatan/jabatan_data', $data);
    }

    public function add()
    {
    	$jabatan = new stdClass();
		$jabatan->id_jabatan = null;
		$jabatan->nama_jabatan = null;
		$jabatan->uraian = null;
		$jabatan->kode_surat = null;
		$jabatan->level_jabatan = null;
		
		$sql = $this->jabatan->get_atasan();
        $jabatan2[0] = '- empty -';
        foreach($sql->result() as $jbt) {
            $jabatan2[$jbt->id_jabatan] = "Lv.".($jbt->level_jabatan-1)." - ".$jbt->nama_jabatan;
        }
		$data = array(
			'page' => 'add',
			'row' => $jabatan,
			'judul' => 'Tambah',
			'jabatan2' => $jabatan2, 'selectedjabatan2' => null
		);
		$this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Master/Jabatan/jabatan_form', $data);   
    }

	public function edit($id)
	{
		if($id != "") {
			$sql = $this->jabatan->get($id);
			if($sql->num_rows() > 0) {
				$jabatan = $sql->row();

				$sql = $this->jabatan->get_atasan();
		        $jabatan2[0] = '- empty -';
		        foreach($sql->result() as $jbt) {
		            $jabatan2[$jbt->id_jabatan] = "Lv.".$jbt->level_jabatan." - ".$jbt->nama_jabatan;
		        }
				$data = array(
					'page' => 'edit',
					'row' => $jabatan,
					'judul' => 'Edit',
					'jabatan2' => $jabatan2, 'selectedjabatan2' => $jabatan->parent_jabatan
				);
				$this->template->set('title', $this->title);
		        $this->template->load('inc/template', 'Master/Jabatan/jabatan_form', $data);  
			} else {
				redirect('jabatan');	
			}
		} else {
			echo "<script>window.location='".site_url('jabatan')."';</script>";
		}
	}

    public function proses()
	{
		if(@$_POST['add']) {
			if($this->jabatan->cek_kode($this->input->post('kode'))->num_rows() > 0) {
                echo "<script>alert('Kode surat sudah diinput sebelumnya'); window.location='add';</script>";
            } else {
            	if($this->input->post('level') <= $this->jabatan->get2($this->input->post('parent_jabatan'))->row()->level_jabatan) {
            		echo "<script>alert('Level induk tidak bisa sama / dibawah level user'); window.location='add';</script>";
            	} else {
					$data = $this->input->post(null, TRUE);
					$this->jabatan->add($data);
            	}
			}
		} else if(@$_POST['edit']) {
			if($this->jabatan->cek_kode($this->input->post('kode'), $this->input->post('id'))->num_rows() > 0) {
                echo "<script>alert('Kode surat sudah diinput sebelumnya'); window.location='edit/".$this->input->post('id')."';</script>";
            } else {
            	if($this->input->post('level') <= $this->jabatan->get2($this->input->post('parent_jabatan'))->row()->level_jabatan) {
            		echo "<script>alert('Level induk tidak bisa sama / dibawah level user'); window.location='edit/".$this->input->post('id')."';</script>";
            	} else {
					$data = $this->input->post(null, TRUE);
					$this->jabatan->edit($data);
				}
			}
		}
		redirect('jabatan');
	}

    public function del($id)
	{
		if($id != '') {
			$this->jabatan->del($id);
		}
		redirect('jabatan');
	}

}
