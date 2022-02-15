<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sppd_lap extends CI_Controller {

	var $title = "SPPD";
	function __construct()
	{
		parent::__construct();
		cek_session();
		$this->load->model('sppd_lap_m', 'lap');
		$this->load->model('pegawai_m', 'pegawai');
    }
    
    // LAPORAN HASIL

    // TTD
    public function data_ttd()
	{
		$data['row'] = $this->lap->get_ttd('id_kegiatan', $this->uri->segment(2));
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/laphasil_ttd_data', $data);
	}
    public function add_ttd()
	{
		$lap = new stdClass();
		$lap->id_lap_ttd = null;
		$lap->tgl_surat = date('Y-m-d');
        $sql = $this->pegawai->get();
        $pegawai[null] = '';
        foreach($sql->result() as $pgw) {
            $pegawai[$pgw->id_user] = $pgw->nama_lengkap." - ".$pgw->nama_jabatan;
        }
		$data = array(
			'page' => 'add',
			'judul' => 'Tambah',
            'row' => $lap,
            'pegawai' => $pegawai, 'selectedpegawai' => null
        );
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/laphasil_ttd_form', $data);
	}
	public function edit_ttd()
	{
        $id = $this->uri->segment(5);
		if($id != "") {
			$sql = $this->lap->get_ttd('id_lap_ttd', $id);
            if($sql->num_rows() > 0) {
                $lap = $sql->row();
		        $sqlpgw = $this->pegawai->get();
		        $pegawai[null] = '';
		        foreach($sqlpgw->result() as $pgw) {
		            $pegawai[$pgw->id_user] = $pgw->nama_lengkap." - ".$pgw->nama_jabatan;
		        }
				$data = array(
					'page' => 'edit',
					'judul' => 'Edit',
		            'row' => $lap,
		            'pegawai' => $pegawai, 'selectedpegawai' => $lap->pgw_mengetahui
		        );
				$this->template->set('title', $this->title);
				$this->template->load('inc/template', 'SPPD/laphasil_ttd_form', $data);
			} else {
                echo "<script>window.location='".site_url('sppd/'.$this->input->post('id_sppd').'/ttd')."';</script>";
            }
        } else {
            echo "<script>window.location='".site_url('sppd/'.$this->input->post('id_sppd').'/ttd')."';</script>";
        }
	}
    public function proses_ttd()
	{
        $data = $this->input->post(null, TRUE);
		$id_sppd = $this->input->post('id_sppd');
		if(isset($_POST['add'])) {
			$this->lap->add_ttd($data);
        } else if(isset($_POST['edit'])) {
			$this->lap->edit_ttd($data);
        }
        echo "<script>window.location='".site_url('sppd/'.$id_sppd.'/ttd?b='.$_GET['b']."&t=".$_GET['t'])."';</script>";
	}
	public function del_ttd()
	{
		$id = $this->uri->segment(5);
		if($id != '') {
			$this->lap->del_ttd($id);
		}
		redirect('sppd/'.$this->uri->segment(2).'/ttd?b='.$_GET['b']."&t=".$_GET['t']);
    }
    
    // HAL DILAPORKAN
    public function data_hal()
    {
        $data['row'] = $this->lap->get_hal('id_kegiatan', $this->uri->segment(2));
        $this->template->set('title', $this->title);
        $this->template->load('inc/template', 'SPPD/laphasil_hal_data', $data);
    }
    public function add_hal()
    {
        $hal = new stdClass();
        $hal->id_lap_hal = null;
        $hal->uraian = null;
        $hal->id_kegiatan = null;
        $data = array(
            'page' => 'add',
            'judul' => 'Tambah',
            'row' => $hal
        );
        $this->template->set('title', $this->title);
        $this->template->load('inc/template', 'SPPD/laphasil_hal_form', $data);
    }
    public function edit_hal()
    {
        $id = $this->uri->segment(5);
        $sql = $this->lap->get_hal('id_lap_hal', $id);
        if($sql->num_rows() > 0) {
            $hal = $sql->row();
            $data = array(
                'page' => 'edit',
                'judul' => 'Edit',
                'row' => $hal,
            );
            $this->template->set('title', $this->title);
            $this->template->load('inc/template', 'SPPD/laphasil_hal_form', $data);
        } else {
            echo "<script>window.location='".site_url('sppd/'.$this->uri->segment(2).'/hal?b='.$_GET['b']."&t=".$_GET['t'])."';</script>";
        }
    }
    public function proses_hal()
    {
        $data = $this->input->post(null, TRUE);
        if(isset($_POST['add'])) {
            $this->lap->add_hal($data);
        } else if(isset($_POST['edit'])) {
            $this->lap->edit_hal($data);
        }
        echo "<script>window.location='".site_url('sppd/'.$this->input->post('id_kegiatan').'/hal?b='.$_GET['b']."&t=".$_GET['t'])."';</script>";
    }
    public function del_hal()
    {
        $id = $this->uri->segment(5);
        $this->lap->del_hal($id);
        redirect('sppd/'.$this->uri->segment(2).'/hal?b='.$_GET['b']."&t=".$_GET['t']);
    }

    // LAP HASIL - PELAKSANA PENGIKUT
    public function data_pelpen()
    {
        $data['row'] = $this->lap->get_pelpen('id_kegiatan', $this->uri->segment(2));
        $this->template->set('title', $this->title);
        $this->template->load('inc/template', 'SPPD/laphasil_pelpen_data', $data);
    }
    public function add_pelpen()
    {
        $pelpen = new stdClass();
        $pelpen->id_lap_pelpen = null;
        $pelpen->pegawai = null;
        $pelpen->id_kegiatan = null;
        
        $pegawai[null] = '';
        $sql = $this->pegawai->get_pelpen('tb_sppd_pelaksana', 'id_sppd', $this->uri->segment(2));
        foreach($sql->result() as $pgw) {
            $pegawai[$pgw->id_user] = $pgw->nama_lengkap." - ".$pgw->nama_jabatan;
        }
        $sql2 = $this->pegawai->get_pelpen('tb_sppd_pengikut', 'id_sppd', $this->uri->segment(2));
        foreach($sql2->result() as $pgw) {
            $pegawai[$pgw->id_user] = $pgw->nama_lengkap." - ".$pgw->nama_jabatan;
        }
        
        $data = array(
            'page' => 'add',
            'judul' => 'Tambah',
            'row' => $pelpen,
            'pegawai' => $pegawai, 'selectedpegawai' => null
        );
        $this->template->set('title', $this->title);
        $this->template->load('inc/template', 'SPPD/laphasil_pelpen_form', $data);
    }
    public function edit_pelpen()
    {
        $id = $this->uri->segment(5);
        $sql_pelpen = $this->lap->get_pelpen('id_lap_pelpen', $id);
        if($sql_pelpen->num_rows() > 0) {
            $pelpen = $sql_pelpen->row();
            
            $pegawai[null] = '';
            $sql = $this->pegawai->get_pelpen('tb_sppd_pelaksana', 'id_sppd', $this->uri->segment(2));
            foreach($sql->result() as $pgw) {
                $pegawai[$pgw->id_user] = $pgw->nama_lengkap." - ".$pgw->nama_jabatan;
            }
            $sql2 = $this->pegawai->get_pelpen('tb_sppd_pengikut', 'id_sppd', $this->uri->segment(2));
            foreach($sql2->result() as $pgw) {
                $pegawai[$pgw->id_user] = $pgw->nama_lengkap." - ".$pgw->nama_jabatan;
            }

            $data = array(
                'page' => 'edit',
                'judul' => 'Edit',
                'row' => $pelpen,
                'pegawai' => $pegawai, 'selectedpegawai' => $pelpen->pegawai
            );
            $this->template->set('title', $this->title);
            $this->template->load('inc/template', 'SPPD/laphasil_pelpen_form', $data);
        } else {
            redirect('sppd/'.$this->uri->segment(2).'/pelpen');
        }
    }
    public function proses_pelpen()
    {
        $data = $this->input->post(null, TRUE);
        $pegawai = $this->input->post('pegawai');
        $id_kegiatan = $this->input->post('id_kegiatan');
        $id = $this->input->post('id');
        if(isset($_POST['add'])) {
            $query = $this->db->query("SELECT * FROM tb_sppd_lap_pelpen WHERE pegawai = '$pegawai' AND id_kegiatan = '$id_kegiatan'");
            if($query->num_rows() > 0) {
                echo "<script>alert('Pegawai sudah diinput'); window.location='".site_url('sppd/'.$id_kegiatan.'/pelpen')."';</script>";
            } else {
                $this->lap->add_pelpen($data);
                echo "<script>window.location='".site_url('sppd/'.$id_kegiatan.'/pelpen')."';</script>";
            }
        } else if(isset($_POST['edit'])) {
            $query = $this->db->query("SELECT * FROM tb_sppd_lap_pelpen WHERE (pegawai = '$pegawai' AND id_kegiatan = '$id_kegiatan') AND id_lap_pelpen != '$id'");
            if($query->num_rows() > 0) {
                echo "<script>alert('Pegawai sudah diinput'); window.location='".site_url('sppd/'.$id_kegiatan.'/pelpen/edit/'.$id)."';</script>";
            } else {
                $this->lap->edit_pelpen($data);
                echo "<script>window.location='".site_url('sppd/'.$id_kegiatan.'/pelpen')."';</script>";
            }
        }
    }
    public function del_pelpen()
    {
        $id = $this->uri->segment(5);
        $this->lap->del_pelpen($id);
        redirect('sppd/'.$this->uri->segment(2).'/pelpen');
    }
	
}
