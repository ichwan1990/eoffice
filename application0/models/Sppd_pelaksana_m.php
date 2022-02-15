<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sppd_pelaksana_m extends CI_Model {

	var $table = "tb_sppd_pelaksana";

	public function get($field, $id)
	{
		$this->db->select('*, tb_sppd_pelaksana.uraian as uraian2');
		$this->db->from($this->table);
		$this->db->join('tb_pegawai', 'tb_sppd_pelaksana.pegawai = tb_pegawai.id_user');
		$this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
		$this->db->join('tb_golongan', 'tb_pegawai.golongan = tb_golongan.id_gol', 'left');
		$this->db->where($field, $id);
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$param = array(
			'pegawai' => $data['pegawai'],
			'uraian' => $data['uraian'],
			'id_sppd' => $data['id_sppd']
		);
        $this->db->insert($this->table, $param);
	}

	public function edit($data)
	{
		$param = array(
			'pegawai' => $data['pegawai'],
			'uraian' => $data['uraian']
		);
		$this->db->where('id_pelaksana', $data['id']);
        $this->db->update($this->table, $param);
	}

	public function del($id)
	{
		$this->db->where('id_pelaksana', $id);
        $this->db->delete($this->table);
	}

}