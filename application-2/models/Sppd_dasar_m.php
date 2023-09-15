<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sppd_dasar_m extends CI_Model {

	var $table = "tb_sppd_dasar";

	public function get($field, $id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where($field, $id);
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$param = array(
			'uraian' => $data['uraian'],
			'id_sppd' => $data['id_sppd']
		);
        $this->db->insert($this->table, $param);
	}

	public function edit($data)
	{
		$param = array(
			'uraian' => $data['uraian']
		);
		$this->db->where('id_dasar', $data['id']);
        $this->db->update($this->table, $param);
	}

	public function del($id)
	{
		$this->db->where('id_dasar', $id);
        $this->db->delete($this->table);
	}

}