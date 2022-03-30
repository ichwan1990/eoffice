<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

	var $table = "tb_pegawai";

	public function login($data)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('username', $data['username']);
		$this->db->where('password', sha1($data['password']));
		$query = $this->db->get(); 
		return $query;
	}

	public function get_user($id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
		if($id != null) {
			$this->db->where('id_user', $id);
		} 
		$query = $this->db->get();
		return $query;
	}

	public function edit_profile($data)
	{
		if($data['password'] != '') {
			if($this->session->userdata('level_user') == '0') {
				$param = array(
					'nama_lengkap' => $data['nama'],
					'alamat' => $data['alamat'],
					'no_telp' => $data['telp'],
					'email' => $data['email'],
					'username' => $data['username'],
					'password' => sha1($data['password'])
				);
			} else {
				$param = array(
					'nip' => $data['nip'],
					'nama_lengkap' => $data['nama'],
					'alamat' => $data['alamat'],
					'no_telp' => $data['telp'],
					'email' => $data['email'],
					'username' => $data['username'],
					'password' => sha1($data['password'])
				);
			}
		} else {
			if($this->session->userdata('level_user') == '0') {
				$param = array(
					'nama_lengkap' => $data['nama'],
					'alamat' => $data['alamat'],
					'no_telp' => $data['telp'],
					'email' => $data['email'],
					'username' => $data['username']
				);
			} else {
				$param = array(
					'nip' => $data['nip'],
					'nama_lengkap' => $data['nama'],
					'alamat' => $data['alamat'],
					'no_telp' => $data['telp'],
					'email' => $data['email'],
					'username' => $data['username']
				);
			}
		}
		$this->db->where('id_user', $data['id']);
        $this->db->update($this->table, $param);
	}

}