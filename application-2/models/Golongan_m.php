<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Golongan_m extends CI_Model {

	var $table = "tb_golongan";

	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_gol !=', 0);
		if($id != null) {
			$this->db->where('id_gol', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	function cek_kode_gol($kode_gol, $id = null) {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('kode_gol', $kode_gol);
		if($id != null) {
			$this->db->where('id_gol !=', $id);
		} 
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$param = array(
			'kode_gol' => $data['gol'],
			'nama_gol' => $data['nama_gol'],
			'uraian' => $data['uraian']
		);
        $this->db->insert($this->table, $param);
	}

	public function edit($data)
	{
		$param = array(
			'kode_gol' => $data['gol'],
			'nama_gol' => $data['nama_gol'],
			'uraian' => $data['uraian']
		);
		$this->db->where('id_gol', $data['id']);
        $this->db->update($this->table, $param);
	}

	public function del($id)
	{
		$this->db->where('id_gol', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
	}

}