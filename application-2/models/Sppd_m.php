<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sppd_m extends CI_Model {

	/* This project is developed by yukcoding.co.id */
	// KEGIATAN
	var $table = "tb_sppd";

	public function get($id = null)
	{
		$this->db->select('*, tb_sppd.keterangan as ket2');
		$this->db->from($this->table);
		$this->db->join('tb_pegawai', 'tb_pegawai.id_user = tb_sppd.pejabat');
		$this->db->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_pegawai.jabatan', 'left');
		$this->db->join('tb_sppd_kegiatan', 'tb_sppd.kegiatan = tb_sppd_kegiatan.id_keg');
		if($id != null) {
			$this->db->where('id_sppd', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_print($id)
	{
		$this->db->select('id_sppd, no_sppd, tgl_sppd, maksud, kendaraan, tempat_berangkat,
		tempat_tujuan, tgl_berangkat, tgl_kembali, kode_rek, tb_sppd.keterangan,
		jb1.nama_jabatan, jb1.nama_jabatan as jabatan_ttd, pg1.nama_lengkap as nama_ttd, pg1.nip, jb1.level_jabatan');
		$this->db->from($this->table);
		$this->db->join('tb_pegawai AS pg1', 'pg1.id_user = tb_sppd.pejabat');
		$this->db->join('tb_jabatan AS jb1', 'pg1.jabatan = jb1.id_jabatan');
		$this->db->join('tb_sppd_kegiatan', 'tb_sppd.kegiatan = tb_sppd_kegiatan.id_keg');
		$this->db->where('id_sppd', $id);
		$query = $this->db->get();
		return $query;
	}

	function cek_no_sppd($no_sppd, $id = null) {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('no_sppd', $no_sppd);
		if($id != null) {
			$this->db->where('id_sppd !=', $id);
		} 
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$param = array(
			'no_sppd' => $data['no_sppd'],
			'tgl_sppd' => $data['tgl_sppd'],
			'pejabat' => $data['pejabat'],
			'maksud' => $data['maksud'],
			'kendaraan' => $data['kendaraan'],
			'tempat_berangkat' => $data['t_berangkat'],
			'tempat_tujuan' => $data['t_tujuan'],
			'tgl_berangkat' => $data['tgl_berangkat'],
			'tgl_kembali' => $data['tgl_kembali'],
			'kegiatan' => $data['kegiatan'],
			'ttd' => $data['pejabat'],
			'keterangan' => $data['ket'],
			'tgl_catat' => date('Y-m-d'),
			'user_input' => $this->session->userdata('iduser')
		);
        $this->db->insert($this->table, $param);
	}

	public function edit($data)
	{
		$param = array(
			'no_sppd' => $data['no_sppd'],
			'tgl_sppd' => $data['tgl_sppd'],
			'pejabat' => $data['pejabat'],
			'maksud' => $data['maksud'],
			'kendaraan' => $data['kendaraan'],
			'tempat_berangkat' => $data['t_berangkat'],
			'tempat_tujuan' => $data['t_tujuan'],
			'tgl_berangkat' => $data['tgl_berangkat'],
			'tgl_kembali' => $data['tgl_kembali'],
			'kegiatan' => $data['kegiatan'],
			'ttd' => $data['pejabat'],
			'keterangan' => $data['ket'],
			'tgl_catat' => date('Y-m-d'),
			'user_input' => $this->session->userdata('iduser')
		);
		$this->db->where('id_sppd', $data['id']);
        $this->db->update($this->table, $param);
	}

	public function del($id)
	{
		$this->db->where('id_sppd', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
	}


	function get_period($bulan, $tahun) {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_pegawai', 'tb_pegawai.id_user = tb_sppd.pejabat');
		$this->db->join('tb_sppd_kegiatan', 'tb_sppd.kegiatan = tb_sppd_kegiatan.id_keg');
		$this->db->where('MONTH(tgl_berangkat)', $bulan);
		$this->db->where('YEAR(tgl_berangkat)', $tahun);
		$query = $this->db->get();
		// $sql = $this->db->last_query();
		return $query;
	}

}