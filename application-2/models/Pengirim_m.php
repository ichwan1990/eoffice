<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengirim_m extends CI_Model {

	var $table = "tb_pengirim_surat";

	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		if($id != null) {
			$this->db->where('id_pengirim', $id);
		} 
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$param = array(
			'nama_pengirim' => $data['nama'],
			'uraian' => $data['uraian']
		);
        $this->db->insert($this->table, $param);
	}

	public function edit($data)
	{
		$param = array(
			'nama_pengirim' => $data['nama'],
			'uraian' => $data['uraian']
		);
		$this->db->where('id_pengirim', $data['id']);
        $this->db->update($this->table, $param);
	}

	public function del($id)
	{
		$this->db->where('id_pengirim', $id);
        $this->db->delete($this->table);
	}

}