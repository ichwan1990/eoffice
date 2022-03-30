<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

	var $title = "Agenda";

	function __construct()
	{
		parent::__construct();
		cek_session();
		if($this->session->userdata('level_user') != '1' && $this->session->userdata('level_user') != '2') {
			redirect('dashboard');
		}
		$this->load->model('agenda_m', 'agenda');
	}

	public function index()
	{
		$data['row'] = $this->agenda->get()->result();
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'Agenda/agenda_data', $data);
    }

    public function add()
    {
    	$agenda = new stdClass();
		$agenda->id_agenda = null;
		$agenda->no_agenda = $this->agenda->no_agenda()->row()->no + 1;
		$agenda->tgl_start = null;
		$agenda->jam_start = null;
		$agenda->tgl_end = null;
		$agenda->jam_end = null;
		$agenda->perihal_acara = null;
		$agenda->tempat_acara = null;
		$agenda->keterangan = null;
		$data = array(
			'page' => 'add',
			'row' => $agenda,
			'judul' => 'Tambah'
		);
		$this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Agenda/agenda_form', $data);   
    }

	public function edit($id)
	{
		if($id != "") {
			$sql = $this->agenda->get($id);
			if($sql->num_rows() > 0) {
				$agenda = $sql->row();
				$data = array(
					'page' => 'edit',
					'row' => $agenda,
					'judul' => 'Edit'
				);
				$this->template->set('title', $this->title);
		        $this->template->load('inc/template', 'Agenda/agenda_form', $data);  
			} else {
				redirect('agenda');	
			}
		} else {
			echo "<script>window.location='".site_url('agenda')."';</script>";
		}
	}

    public function proses()
	{
		if(@$_POST['add']) {
			if($this->agenda->cek_no_agenda($this->input->post('no'))->num_rows() > 0) {
                echo "<script>alert('No. Agenda sudah diinput sebelumnya'); window.location='add';</script>";
            } else {
				$data = $this->input->post(null, TRUE);
				$this->agenda->add($data);
			}
		} else if(@$_POST['edit']) {
			if($this->agenda->cek_no_agenda($this->input->post('no'), $this->input->post('id'))->num_rows() > 0) {
                echo "<script>alert('No. Agenda sudah diinput sebelumnya'); window.location='edit/".$this->input->post('id')."';</script>";
            } else {
				$data = $this->input->post(null, TRUE);
				$this->agenda->edit($data);
			}
		}
		redirect('agenda');
	}

    public function del($id)
	{
		if($id != '') {
			$this->agenda->del($id);
		}
		redirect('agenda');
	}

	public function calendar()
	{
		$data['row'] = $this->agenda->get()->result();
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'Agenda/calendar', $data);
	}

}
