<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_m extends CI_Model {

	var $table = "tb_pegawai";

	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
		$this->db->join('tb_golongan', 'tb_pegawai.golongan = tb_golongan.id_gol', 'left');
		$this->db->where('level_jabatan !=', '0');
		if($id != null) {
			$this->db->where('id_user', $id);
		}
		$this->db->order_by('level_jabatan', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function cek_nip($nip, $id = null) {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('nip', $nip);
		if($id != null) {
			$this->db->where('id_user !=', $id);
		} 
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$param = array(
			'nip' => $data['nip'],
			'nama_lengkap' => $data['nama'],
			'golongan' => $data['golongan'],
			'jabatan' => $data['jabatan'],
			'alamat' => $data['alamat'],
			'no_telp' => $data['telp'],
			'email' => $data['email'],
			'username' => $data['username'],
			'password' => sha1($data['password'])
		);
        $this->db->insert($this->table, $param);
	}

	public function edit($data)
	{
		if($data['password'] != '') {
			$param = array(
				'nip' => $data['nip'],
				'nama_lengkap' => $data['nama'],
				'golongan' => $data['golongan'],
				'jabatan' => $data['jabatan'],
				'alamat' => $data['alamat'],
				'no_telp' => $data['telp'],
				'email' => $data['email'],
				'username' => $data['username'],
				'password' => sha1($data['password']),
				'level_user' => $data['level_user'],
			);
		} else {
			$param = array(
				'nip' => $data['nip'],
				'nama_lengkap' => $data['nama'],
				'golongan' => $data['golongan'],
				'jabatan' => $data['jabatan'],
				'alamat' => $data['alamat'],
				'no_telp' => $data['telp'],
				'email' => $data['email'],
				'username' => $data['username'],
				'level_user' => $data['level_user'],
			);
		}
		$this->db->where('id_user', $data['id']);
        $this->db->update($this->table, $param);
	}

	public function del($id)
	{
		$this->db->where('id_user', $id);
        $this->db->delete($this->table);
	}


	function get_pejabatMakeSPPD() {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
		$this->db->where('level_jabatan !=', '0');
		$this->db->where('level_jabatan !=', '1');
		$this->db->where('level_jabatan !=', '4');
		$this->db->where('level_jabatan !=', '5');
		$query = $this->db->get();
		return $query;
	}
	function get_pelaksanaSPPD() {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
		$this->db->where('level_jabatan !=', '0');
		$this->db->where('level_jabatan !=', '2');
		$this->db->order_by('level_jabatan', 'asc');
		$query = $this->db->get();
		return $query;
	}
	function get_ttdSPPD() {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
		$this->db->like('nama_jabatan', 'sekretaris');
		$this->db->or_like('nama_jabatan', 'kepala dinas', 'after');
		$query = $this->db->get();
		return $query;
	}

	function get_pelpen($table, $field, $id) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('tb_pegawai', $table.".pegawai = tb_pegawai.id_user");
		$this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
		$this->db->where($field, $id);
		$query = $this->db->get();
		return $query;
	}

}