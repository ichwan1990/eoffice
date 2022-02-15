<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sppd extends CI_Controller {

	var $title = "SPPD";
	function __construct()
	{
		parent::__construct();
		cek_session();
		$this->load->model('sppd_keg_m', 'keg');
		$this->load->model('sppd_m', 'sppd');
		$this->load->model('sppd_dasar_m', 'dasar');
		$this->load->model('sppd_pelaksana_m', 'pelaksana');
		$this->load->model('sppd_pengikut_m', 'pengikut');
		$this->load->model('sppd_lap_m', 'lap');
		$this->load->model('pegawai_m', 'pegawai');
	}
	
	// MASTER KEGIATAN DPA
    public function data_kegiatan()
	{
		$data['row'] = $this->keg->get_keg();
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/kegiatan_data', $data);
	}
    public function add_kegiatan()
	{
		$keg = new stdClass();
		$keg->id_keg = null;
		$keg->kode_rek = null;
		$keg->nama_keg = null;
		$keg->pptk = null;
		$keg->bendahara = null;
		$keg->jumlah_anggaran = 0;
		$keg->keterangan = null;

        $sql = $this->pegawai->get_pelaksanaSPPD();
        $pegawai[null] = '';
		foreach($sql->result() as $pgw) {
            $pegawai[$pgw->id_user] = $pgw->nama_lengkap." (".$pgw->nama_jabatan.")";
		}
		
		$data = array(
			'page' => 'add',
			'judul' => 'Tambah',
            'row' => $keg,
			'pejabat' => $pegawai, 'selectedpejabat' => null,
			'pejabat2' => $pegawai, 'selectedpejabat2' => null
        );
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/kegiatan_form', $data);
	}
	public function edit_kegiatan()
	{
		$id = $this->uri->segment(4);
		if($id != "") {
			$sql = $this->keg->get_keg($id);
            if($sql->num_rows() > 0) {
				$keg = $sql->row();

				$sqlpgw = $this->pegawai->get_pelaksanaSPPD();
				$pegawai[null] = '';
				foreach($sqlpgw->result() as $pgw) {
					$pegawai[$pgw->id_user] = $pgw->nama_lengkap." (".$pgw->nama_jabatan.")";
				}

				$data = array(
					'page' => 'edit',
					'judul' => 'Edit',
					'row' => $keg,
					'pejabat' => $pegawai, 'selectedpejabat' => $keg->pptk,
					'pejabat2' => $pegawai, 'selectedpejabat2' => $keg->bendahara,
		        );
				$this->template->set('title', $this->title);
				$this->template->load('inc/template', 'SPPD/kegiatan_form', $data);
			} else {
                echo "<script>window.location='".site_url('sppd/kegiatan/'.$this->input->post('id_keg'))."';</script>";
            }
        } else {
            echo "<script>window.location='".site_url('sppd/kegiatan/'.$this->input->post('id_keg'))."';</script>";
        }
	}
    public function proses_kegiatan()
	{
		if(@$_POST['add']) {
            if($this->keg->cek_kode_rek($this->input->post('kode_rek'))->num_rows() > 0) {
                echo "<script>alert('Kode rekening sudah digunakan'); window.location='kegiatan/add';</script>";
            } else {
				$data = $this->input->post(null, TRUE);
				$this->keg->add_keg($data);
            }
        } else if(@$_POST['edit']) {
            if($this->keg->cek_kode_rek($this->input->post('kode_rek'), $this->input->post('id'))->num_rows() > 0) {
                echo "<script>alert('Kode rekening sudah digunakan'); window.location='kegiatan/edit/".$this->input->post('id')."';</script>";
            } else {
				$data = $this->input->post(null, TRUE);
				$this->keg->edit_keg($data);
            }
        }
        redirect('sppd/kegiatan');
	}
	public function del_kegiatan()
	{
		$id = $this->uri->segment(4);
		if($id != '') {
			$this->keg->del_keg($id);
		}
		redirect('sppd/kegiatan');
	}

    // SPPD
    public function index()
	{
		$data['row'] = $this->sppd->get()->result();
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/sppd_data', $data);
	}
    public function add()
	{
		$sppd = new stdClass();
		$sppd->no_sppd = null;
		
		$sql = $this->pegawai->get_pejabatMakeSPPD();
        $pegawai[null] = '';
        foreach($sql->result() as $pgw) {
            $pegawai[$pgw->id_user] = $pgw->nama_lengkap." (".$pgw->nama_jabatan.")";
		}
		
		$sql2 = $this->keg->get_keg();
        $keg[null] = '';
		foreach($sql2->result() as $m) {
            $keg[$m->id_keg] = $m->nama_keg;
		}

		$sql3 = $this->pegawai->get_ttdSPPD();
        $pegawai2[null] = '';
        foreach($sql3->result() as $pgw) {
            $pegawai2[$pgw->id_user] = $pgw->nama_lengkap." (".$pgw->nama_jabatan.")";
		}

		$data = array(
            'row' => $sppd,
			'pejabat' => $pegawai, 'selectedpejabat' => null,
			'ttd' => $pegawai2, 'selectedttd' => null,
			'kegiatan' => $keg, 'selectedkeg' => null
        );
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/sppd_add', $data);
	}
	public function edit($id)
	{
		if($id != "") {
			$sql = $this->sppd->get($id);
            if($sql->num_rows() > 0) {
				$sppd = $sql->row();
				
		        $sql = $this->pegawai->get_pejabatMakeSPPD();
		        $pegawai[null] = '';
		        foreach($sql->result() as $pgw) {
		            $pegawai[$pgw->id_user] = $pgw->nama_lengkap." (".$pgw->nama_jabatan.")";
				}
				
				$sql2 = $this->keg->get_keg();
				$keg[null] = '';
				foreach($sql2->result() as $m) {
					$keg[$m->id_keg] = $m->nama_keg;
				}

				$sql3 = $this->pegawai->get_ttdSPPD();
				$pegawai2[null] = '';
				foreach($sql3->result() as $pgw) {
					$pegawai2[$pgw->id_user] = $pgw->nama_lengkap." (".$pgw->nama_jabatan.")";
				}
				
				$data = array(
		            'row' => $sppd,
					'pejabat' => $pegawai, 'selectedpejabat' => $sppd->pejabat,
					'ttd' => $pegawai2, 'selectedttd' => $sppd->ttd,
					'kegiatan' => $keg, 'selectedkeg' => $sppd->kegiatan
		        );
				$this->template->set('title', $this->title);
				$this->template->load('inc/template', 'SPPD/sppd_edit', $data);
			} else {
                redirect('sppd/kegiatan');    
            }
        } else {
            echo "<script>window.location='".site_url('sppd')."';</script>";
        }
	}
    public function proses()
	{
		if(@$_POST['add']) {
            if($this->sppd->cek_no_sppd($this->input->post('no_sppd'))->num_rows() > 0) {
                echo "<script>alert('No. SPPD sudah digunakan'); window.location='kegiatan/add';</script>";
            } else {
            	if($this->input->post('tgl_kembali') < $this->input->post('tgl_berangkat')) {
            		echo "<script>alert('Tanggal kembali tidak bisa sebelum tanggal berangkat'); window.location='kegiatan/add';</script>";
            	} else {
            		$data = $this->input->post(null, TRUE);
	                $this->sppd->add($data);
            	}
            }
        } else if(@$_POST['edit']) {
            if($this->sppd->cek_no_sppd($this->input->post('no_sppd'), $this->input->post('id'))->num_rows() > 0) {
                echo "<script>alert('No. SPPD sudah digunakan'); window.location='kegiatan/edit/".$this->input->post('id')."';</script>";
            } else {
            	if($this->input->post('tgl_kembali') < $this->input->post('tgl_berangkat')) {
            		echo "<script>alert('Tanggal kembali tidak bisa sebelum tanggal berangkat'); window.location='kegiatan/edit/".$this->input->post('id')."';</script>";
            	} else {
	                $data = $this->input->post(null, TRUE);
	                $this->sppd->edit($data);
	            }
            }
        }
        redirect('sppd');
	}
	public function del($id)
	{
		if($id != '') {
			$this->sppd->del($id);
		}
		redirect('sppd');
	}

	// DASAR
    public function data_dasar()
	{
		$data['row'] = $this->dasar->get('id_sppd', $this->uri->segment(3));
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/dasar_data', $data);
	}
    public function add_dasar()
	{
		$dasar = new stdClass();
		$dasar->id_dasar = null;
		$dasar->uraian = null;
		$dasar->id_sppd = null;
		$data = array(
			'page' => 'add',
			'judul' => 'Tambah',
            'row' => $dasar
        );
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/dasar_form', $data);
	}
	public function edit_dasar()
	{
		$id = $this->uri->segment(5);
		if($id != "") {
			$sql = $this->dasar->get('id_dasar', $id);
            if($sql->num_rows() > 0) {
                $dasar = $sql->row();
				$data = array(
					'page' => 'edit',
					'judul' => 'Edit',
		            'row' => $dasar,
		        );
				$this->template->set('title', $this->title);
				$this->template->load('inc/template', 'SPPD/dasar_form', $data);
			} else {
                echo "<script>window.location='".site_url('sppd/dasar/'.$this->input->post('id_sppd'))."';</script>";
            }
        } else {
            echo "<script>window.location='".site_url('sppd/dasar/'.$this->input->post('id_sppd'))."';</script>";
        }
	}
    public function proses_dasar()
	{
        $data = $this->input->post(null, TRUE);
		if(@$_POST['add']) {
            $this->dasar->add($data);
        } else if(@$_POST['edit']) {
            $this->dasar->edit($data);
        }
        echo "<script>window.location='".site_url('sppd/dasar/'.$this->input->post('id_sppd'))."';</script>";
	}
	public function del_dasar()
	{
		$id = $this->uri->segment(5);
		if($id != '') {
			$this->dasar->del($id);
		}
		redirect('sppd/dasar/'.$this->uri->segment(3));
	}

	// PELAKSANA
    public function data_pelaksana()
	{
		$data['row'] = $this->pelaksana->get('id_sppd', $this->uri->segment(3));
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/pelaksana_data', $data);
	}
    public function add_pelaksana()
	{
		$pelaksana = new stdClass();
		$pelaksana->id_pelaksana = null;
		$pelaksana->uraian2 = null;
		$pelaksana->id_sppd = null;
        $sql = $this->pegawai->get_pelaksanaSPPD();
        $pegawai[null] = '';
        foreach($sql->result() as $pgw) {
            $pegawai[$pgw->id_user] = $pgw->nama_lengkap." (".$pgw->nama_jabatan.")";
        }
		$data = array(
			'page' => 'add',
			'judul' => 'Tambah',
            'row' => $pelaksana,
            'pegawai' => $pegawai, 'selectedpegawai' => null
        );
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/pelaksana_form', $data);
	}
	public function edit_pelaksana()
	{
		$id = $this->uri->segment(5);
		if($id != "") {
			$sql = $this->pelaksana->get('id_pelaksana', $id);
            if($sql->num_rows() > 0) {
                $pelaksana = $sql->row();
		        $sql = $this->pegawai->get_pelaksanaSPPD();
		        $pegawai[null] = '';
		        foreach($sql->result() as $pgw) {
		            $pegawai[$pgw->id_user] = $pgw->nama_lengkap." (".$pgw->nama_jabatan.")";
		        }
				$data = array(
					'page' => 'edit',
					'judul' => 'Edit',
		            'row' => $pelaksana,
		            'pegawai' => $pegawai, 'selectedpegawai' => $pelaksana->pegawai
		        );
				$this->template->set('title', $this->title);
				$this->template->load('inc/template', 'SPPD/pelaksana_form', $data);
			} else {
                echo "<script>window.location='".site_url('sppd/pelaksana/'.$this->input->post('id_sppd'))."';</script>";
            }
        } else {
            echo "<script>window.location='".site_url('sppd/pelaksana/'.$this->input->post('id_sppd'))."';</script>";
        }
	}
    public function proses_pelaksana()
	{
        $data = $this->input->post(null, TRUE);
        $pegawai = $this->input->post('pegawai');
		$id_sppd = $this->input->post('id_sppd');
		$id = $this->input->post('id');
		if(@$_POST['add']) {
			$query = $this->db->query("SELECT * FROM tb_sppd_pelaksana WHERE pegawai = '$pegawai' AND id_sppd = '$id_sppd'");
			if($query->num_rows() > 0) {
				echo "<script>alert('Pelaksana ini sudah diinput'); window.location='".$id_sppd."/add';</script>";
			} else {
	            $this->pelaksana->add($data);
	            echo "<script>window.location='".site_url('sppd/pelaksana/'.$id_sppd)."';</script>";
			}
        } else if(@$_POST['edit']) {
			$query = $this->db->query("SELECT * FROM tb_sppd_pelaksana WHERE (pegawai = '$pegawai' AND id_sppd = '$id_sppd') AND id_pelaksana != '$id'");
			if($query->num_rows() > 0) {
				echo "<script>alert('Pelaksana ini sudah diinput'); window.location='".$id_sppd."/edit/".$id."';</script>";
			} else {
	            $this->pelaksana->edit($data);
	            echo "<script>window.location='".site_url('sppd/pelaksana/'.$id_sppd)."';</script>";
	        }
        }
	}
	public function del_pelaksana()
	{
		$id = $this->uri->segment(5);
		if($id != '') {
			$this->pelaksana->del($id);
		}
		redirect('sppd/pelaksana/'.$this->uri->segment(3));
	}

	// PENGIKUT PELAKSANA
    public function data_pengikut()
	{
		$data['row'] = $this->pelaksana->get('id_sppd', $this->uri->segment(3));
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/pengikut_data', $data);
	}
    public function add_pengikut()
	{
		$pengikut = new stdClass();
		$pengikut->id_pengikut = null;
		$pengikut->nama = null;
		$pengikut->uraian = null;
		$pengikut->id_pelaksana = null;
		$pengikut->id_sppd = null;
        $sql = $this->pegawai->get_pelaksanaSPPD();
        $pegawai[null] = '';
        foreach($sql->result() as $pgw) {
            $pegawai[$pgw->id_user] = $pgw->nama_lengkap." - ".$pgw->nama_jabatan;
        }
		$data = array(
			'page' => 'add',
            'row' => $pengikut,
            'pegawai' => $pegawai, 'selectedpegawai' => null
        );
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/pengikut_form', $data);
	}
    public function proses_pengikut()
	{
        $data = $this->input->post(null, TRUE);
        $pegawai = $this->input->post('pegawai');
		$id_sppd = $this->input->post('id_sppd');
		$id_pelaksana = $this->input->post('id_pelaksana');
		if(@$_POST['add']) {
			$query = $this->db->query("SELECT * FROM tb_sppd_pengikut WHERE pegawai = '$pegawai' AND id_sppd = '$id_sppd'");
			if($query->num_rows() > 0) {
				echo "<script>alert('Pelaksana ini sudah diinput'); window.location='".$id_sppd."/".$id_pelaksana."/add';</script>";
			} else {
	            $this->pengikut->add($data);
		        echo "<script>window.location='".site_url('sppd/pengikut/'.$this->input->post('id_sppd'))."';</script>";
	        }
        }
	}
	public function del_pengikut()
	{
		$id = $this->uri->segment(5);
		if($id != '') {
			$this->pengikut->del($id);
		}
		redirect('sppd/pengikut/'.$this->uri->segment(3));
	}

	// CETAK SURAT PERINTAH TUGAS
    public function surat_sppd()
	{
		$data['row'] = $this->sppd->get()->result();
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/surat_perintah_tugas', $data);
	}
	
	// LAPORAN SPPD
	public function report()
	{
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'SPPD/laphasil_report'); 
	}

}
