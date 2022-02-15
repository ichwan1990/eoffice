<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile extends CI_Controller {

	var $title = "Profile";

	function __construct()
	{
		parent::__construct();
		cek_session();
		$this->load->model('user_m', 'profile');
	}

	public function index()
	{
		$data['row'] = $this->profile->get_user($this->session->userdata('iduser'))->row();
		$data['judul'] = "Detail";
		$this->template->set('title', $this->title);
		$this->template->load('inc/template', 'Profile/profile_data', $data);
    }

	public function edit()
	{
		$sql = $this->profile->get_user($this->session->userdata('iduser'));
		if($sql->num_rows() > 0) {
			$profile = $sql->row();
			$data = array(
				'row' => $profile,
				'judul' => 'Edit',
			);
			$this->template->set('title', $this->title);
	        $this->template->load('inc/template', 'Profile/profile_form', $data);  
		} else {
			redirect('profile');	
		}
	}

    public function proses()
	{
		$this->load->model('pegawai_m', 'pegawai');
		if(isset($_POST['edit'])) {
			if($this->session->userdata('level_user') == '0') {
				$data = $this->input->post(null, TRUE);
                $this->profile->edit_profile($data);
			} else {
				if($this->pegawai->cek_nip($this->input->post('nip'), $this->input->post('id'))->num_rows() > 0) {
	                echo "<script>alert('NIP sudah digunakan akun lain'); window.location='edit/".$this->input->post('id')."';</script>";
	            } else {
	            	$data = $this->input->post(null, TRUE);
	                $this->profile->edit_profile($data);
				}
			}
		}
		redirect('profile');
	}

}
