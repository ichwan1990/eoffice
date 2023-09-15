<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sppd_pengikut_m extends CI_Model {

	var $table = "tb_sppd_pengikut";

	function get($field, $id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_pegawai', 'tb_sppd_pengikut.pegawai = tb_pegawai.id_user');
		$this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
		$this->db->where($field, $id);
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$param = array(
			'pegawai' => $data['pegawai'],
			'uraian' => $data['uraian'],
			'id_pelaksana' => $data['id_pelaksana'],
			'id_sppd' => $data['id_sppd']
		);
        $this->db->insert($this->table, $param);
	}

	public function del($id)
	{
		$this->db->where('id_pengikut', $id);
        $this->db->delete($this->table);
	}

}