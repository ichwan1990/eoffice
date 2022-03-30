<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi extends CI_Controller {

	var $title = "Disposisi Surat";

	function __construct()
	{
		parent::__construct();
		cek_session();
		if($this->session->userdata('level_user') == '0') { redirect('dashboard'); }
		$this->load->model('disposisi_m', 'disposisi');
		$this->load->model('surat_in_m', 'surat_in');
		if($this->session->userdata('level_user') != '1' && $this->session->userdata('level_user') != '2') {
			if($this->surat_in->get2()->num_rows() == 0) {
	    		redirect('surat_masuk');
	    	}
		}
	}

	public function index()
	{
		redirect('surat_masuk');
	}

	public function data()
	{
		$data = array(
			'surat' => $this->surat_in->get($this->uri->segment('2'))->row()
		);
		$this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Disposisi/disposisi_data', $data);
	}

    public function add()
    {
    	$disposisi = new stdClass();
		$disposisi->id_disposisi = null;
		$disposisi->input_teruskan = null;
		$disposisi->catatan = null;
		$disposisi->id_surat_in = null;
		$this->load->model('jabatan_m', 'jabatan');
		$data = array(
			'page' => 'add', 
			'row' => $disposisi, 
			'judul' => 'Tambah',
			'surat' => $this->surat_in->get($this->uri->segment('2'))->row(),
			'disp_perintah' => $this->disposisi->disp_perintah()->result(),
			'tujuan' => $this->jabatan->getfor_tujuandisposisi()->result()
		);
		$this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Disposisi/disposisi_form', $data);   
    }

    public function proses()
	{
		if(@$_POST['add']) {
			if($this->input->post('input_teruskan') == '1') {
				$tujuan = $this->input->post('tujuan');
				if(count($tujuan) > 0) {
					$data = $this->input->post(null, TRUE);
					$this->disposisi->add_disposisi($data);
					$insert_id = $this->db->insert_id();
					$this->load->model('pegawai_m');
					foreach($tujuan as $id) {
						$id_jabatan = $this->pegawai_m->get($id)->row()->jabatan;
						$params = array(
							'id_jabatan' => $id_jabatan,
							'id_user' => $id, 
							'id_disposisi' => $insert_id
						);
						$this->disposisi->add_detail('tb_disp_detail_tujuan', $params);				
					}
					$perintah = $this->input->post('perintah');
					if(isset($_POST['perintah']) && count($perintah) > 0) {
						foreach($perintah as $pth) { 
							$params = array(
								'id_perintah' => $pth, 
								'id_disposisi' => $insert_id
							);
							$this->disposisi->add_detail('tb_disp_detail_perintah', $params);				
						}
					}
					echo "<script>window.location='".site_url('disposisi/'.$this->input->post('id_surat_in').'?h=2')."';</script>";
				} else { ?>
					<script>alert('Tujuan (diteruskan) disposisi belum dipilih'); window.location='<?=site_url('disposisi/'.$this->input->post('id_surat_in').'/add')?>';</script>
				<?php
				}
			} else if($this->input->post('input_teruskan') == '2') {
				$data = $this->input->post(null, TRUE);
				$this->disposisi->add_disposisi($data);
				$insert_id = $this->db->insert_id();
				$perintah = $this->input->post('perintah');
				if(isset($_POST['perintah']) && count($perintah) > 0) {
					foreach($perintah as $pth) { 
						$params = array(
							'id_perintah' => $pth, 
							'id_disposisi' => $insert_id
						);
						$this->disposisi->add_detail('tb_disp_detail_perintah', $params);				
					}
				}
				echo "<script>window.location='".site_url('disposisi/'.$this->input->post('id_surat_in').'?h=2')."';</script>";
			}
		}
	}

    public function del()
	{
		$id = $this->uri->segment(4);
		if($id != '') {
			if($this->disposisi->cek_ada_disposisi_down($this->uri->segment(2))->num_rows() != 0) {
				echo "<script>alert('Gagal hapus data! Data telah di disposisi level bawah Anda'); window.location='".site_url('disposisi/'.$this->uri->segment(2))."';</script>";
			} else {
				$this->disposisi->del_disp_detail_tujuan($id);
				$this->disposisi->del_disp_detail_perintah($id);
				$this->disposisi->del_disposisi($id);
				redirect('disposisi/'.$this->uri->segment(2));			}
		} else {
			redirect('disposisi/'.$this->uri->segment(2));
		}
	}

}
