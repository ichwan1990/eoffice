<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_m extends CI_Model {

	public function get($table, $id = null)
	{
		$this->db->select('*');
		$this->db->from($table);
		if($id != null) {
			$this->db->where('id_kategori', $id);
		} 
		$query = $this->db->get();
		return $query;
	}

	function cek_kode($table, $kode, $id = null)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('kode_kategori', $kode);
		if($id != null) {
			$this->db->where('id_kategori !=', $id);
		} 
		$query = $this->db->get();
		return $query;
	}

	public function add($table, $data)
	{
		$param = array(
			'kode_kategori' => $data['kode'],
			'nama_kategori' => $data['nama'],
			'uraian' => $data['uraian']
		);
        $this->db->insert($table, $param);
	}

	public function edit($table, $data)
	{
		$param = array(
			'kode_kategori' => $data['kode'],
			'nama_kategori' => $data['nama'],
			'uraian' => $data['uraian']
		);
		$this->db->where('id_kategori', $data['id']);
        $this->db->update($table, $param);
	}

	public function del($table, $id)
	{
		$this->db->where('id_kategori', $id);
        $this->db->delete($table);
	}

}