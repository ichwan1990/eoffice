<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sppd_lap_m extends CI_Model {

	/* This project is developed by yukcoding.co.id */
	// TTD
	var $table2 = "tb_sppd_lap_ttd";
	public function get_ttd($field, $id)
	{
		$this->db->select('*');
		$this->db->from($this->table2);
		$this->db->join('tb_pegawai', 'tb_pegawai.id_user = tb_sppd_lap_ttd.pgw_mengetahui', 'left');
		$this->db->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_pegawai.jabatan', 'left');
		$this->db->join('tb_sppd', 'tb_sppd.id_sppd = tb_sppd_lap_ttd.id_kegiatan', 'left');
		$this->db->where($field, $id);
		$query = $this->db->get();
		return $query;
	}
	public function add_ttd($data)
	{
		$param = array(
			'pgw_mengetahui' => $data['pegawai'],
			'tgl_surat' => $data['tgl_surat'],
			'id_kegiatan' => $data['id_sppd'],
		);
        $this->db->insert($this->table2, $param);
	}
	public function edit_ttd($data)
	{
		$param = array(
			'pgw_mengetahui' => $data['pegawai'],
			'tgl_surat' => $data['tgl_surat'],
			'id_kegiatan' => $data['id_sppd'],
		);
		$this->db->where('id_lap_ttd', $data['id']);
        $this->db->update($this->table2, $param);
	}
	public function del_ttd($id)
	{
		$this->db->where('id_lap_ttd', $id);
        $this->db->delete($this->table2);
        return $this->db->affected_rows();
    }
	
	/* This project is developed by yukcoding.co.id */
    // HAL2
    var $table3 = "tb_sppd_lap_hal";
	public function get_hal($field, $id)
	{
		$this->db->select('*');
		$this->db->from($this->table3);
		$this->db->where($field, $id);
		$query = $this->db->get();
		return $query;
	}
	public function add_hal($data)
	{
		$param = array(
			'uraian' => $data['uraian'],
            'id_kegiatan' => $data['id_kegiatan']
		);
        $this->db->insert($this->table3, $param);
	}
	public function edit_hal($data)
	{
		$param = array(
			'uraian' => $data['uraian']
		);
		$this->db->where('id_lap_hal', $data['id']);
        $this->db->update($this->table3, $param);
	}
	public function del_hal($id)
	{
		$this->db->where('id_lap_hal', $id);
        $this->db->delete($this->table3);
    }

}

/* This project is developed by yukcoding.co.id */