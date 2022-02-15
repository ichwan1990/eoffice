<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan_m extends CI_Model
{

	var $table = "tb_jabatan";

	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_jabatan !=', '0');
		$this->db->where('id_jabatan !=', '1');
		if ($id != null) {
			$this->db->where('id_jabatan', $id);
		}
		$this->db->order_by('level_jabatan', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function get2($id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		if ($id != null) {
			$this->db->where('id_jabatan', $id);
		}
		$this->db->order_by('level_jabatan', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function get_atasan()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('level_jabatan !=', '0');
		$this->db->where('level_jabatan !=', '1');
		$this->db->where('level_jabatan !=', '5');
		$this->db->order_by('level_jabatan', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function getfor_suratout()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id_jabatan !=', '0');
		$this->db->where('id_jabatan !=', '1');
		$this->db->where('level_jabatan', '3');
		$query = $this->db->get();
		return $query;
	}

	function cek_kode($kode, $id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('kode_surat', $kode);
		if ($id != null) {
			$this->db->where('id_jabatan !=', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$param = array(
			'nama_jabatan' => $data['nama'],
			'uraian' => $data['uraian'],
			'kode_surat' => $data['kode'],
			'level_jabatan' => $data['level'],
			'parent_jabatan' => $data['parent_jabatan']
		);
		$this->db->insert($this->table, $param);
	}

	public function edit($data)
	{
		$param = array(
			'nama_jabatan' => $data['nama'],
			'uraian' => $data['uraian'],
			'kode_surat' => $data['kode'],
			'level_jabatan' => $data['level'],
			'parent_jabatan' => $data['parent_jabatan']
		);
		$this->db->where('id_jabatan', $data['id']);
		$this->db->update($this->table, $param);
	}

	public function del($id)
	{
		$this->db->where('id_jabatan', $id);
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}

	function getfor_tujuandisposisi()
	{
		$this->db->select('*');
		$this->db->from('tb_pegawai');
		$this->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
		$this->db->where('tb_jabatan.id_jabatan !=', '0');
		$this->db->where('tb_jabatan.tampil_jabatan !=', '0');
		$this->db->order_by('tb_pegawai.jabatan', 'asc ');
		$query = $this->db->get();
		return $query;
	}
}
