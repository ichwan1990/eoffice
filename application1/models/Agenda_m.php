<?php
/* This project is developed by yukcoding.co.id */
defined('BASEPATH') OR exit('No direct script access allowed');

class agenda_m extends CI_Model {

	var $table = "tb_agenda";

	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		if($id != null) {
			$this->db->where('id_agenda', $id);
		} 
		$this->db->order_by('no_agenda', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function no_agenda()
	{
		$query = $this->db->query('SELECT MAX(no_agenda) AS no FROM '.$this->table);
		return $query;
	}

	function cek_no_agenda($no, $id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('no_agenda', $no);
		if($id != null) {
			$this->db->where('id_agenda !=', $id);
		} 
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$param = array(
			'no_agenda' => $data['no'],
			'tgl_start' => $data['tgl_start'],
			'jam_start' => $data['jam_start'],
			'tgl_end' => $data['tgl_end'],
			'jam_end' => $data['jam_end'],
			'perihal_acara' => $data['hal'],
			'tempat_acara' => $data['tempat'],
			'keterangan' => $data['ket'],
			'user_input' => $this->session->userdata('iduser')
		);
        $this->db->insert($this->table, $param);
	}

	public function edit($data)
	{
		$param = array(
			'no_agenda' => $data['no'],
			'tgl_start' => $data['tgl_start'],
			'jam_start' => $data['jam_start'],
			'tgl_end' => $data['tgl_end'],
			'jam_end' => $data['jam_end'],
			'perihal_acara' => $data['hal'],
			'tempat_acara' => $data['tempat'],
			'keterangan' => $data['ket'],
			'user_input' => $this->session->userdata('iduser')
		);
		$this->db->where('id_agenda', $data['id']);
        $this->db->update($this->table, $param);
	}

	public function del($id)
	{
		$this->db->where('id_agenda', $id);
        $this->db->delete($this->table);
	}

}