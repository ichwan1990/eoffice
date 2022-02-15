<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		redirect('auth/login');
	}

	public function login()
	{
		cek_session_login();
		$this->load->library('form_validation');
		$config = array(
	        array(
                'field' => 'username',
                'label' => 'Username',
				'rules' => 'trim|xss_clean|required',
	        ),
	        array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|xss_clean|required',
	        )
		);
		$this->form_validation->set_rules($config);
		$this->form_validation->set_error_delimiters('<i>', '</i>');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('inc/login');
		} else {
			$this->load->model('user_m', 'user');
			if(isset($_POST['login'])) {
				$sql_login = $this->user->login($this->input->post(null, TRUE));
				if($sql_login->num_rows() > 0) {
					$row = $sql_login->row();
					$row2 = $this->user->get_user($row->id_user)->row();
					$options = array(
						'iduser' => $row->id_user,
						'level_jabatan' => $row2->level_jabatan,
						'level_user' => $row->level_user,
						'idjabatan' => $row->jabatan,
					);
					$this->session->set_userdata($options);
					$this->session->set_flashdata('alert','Login berhasil');
					redirect('dashboard');
				} else {
					$this->session->set_flashdata('alert','<i>Login gagal! Username atau password salah</i>');
					$this->load->view('inc/login');	 
				}
			}
		}
	}

	public function logout()
	{
		$options = array('iduser', 'level_jabatan', 'level_user', 'idjabatan');
		$this->session->unset_userdata($options);
		redirect('auth/login');
	}

}