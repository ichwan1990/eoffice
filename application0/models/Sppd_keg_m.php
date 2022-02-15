<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sppd_keg_m extends CI_Model {

	var $table = "tb_sppd_kegiatan";

	public function get_keg($id = null)
	{
		$this->db->select('id_keg, kode_rek, nama_keg, pptk, bendahara,
		pg1.nama_lengkap as nama1, jb1.nama_jabatan as jabatan1,
		pg2.nama_lengkap as nama2, jb2.nama_jabatan as jabatan2,
		jumlah_anggaran, keterangan');
		$this->db->from($this->table);
		$this->db->join('tb_pegawai AS pg1', 'pg1.id_user = tb_sppd_kegiatan.pptk');
		$this->db->join('tb_jabatan AS jb1', 'pg1.jabatan = jb1.id_jabatan');
		$this->db->join('tb_pegawai AS pg2', 'pg2.id_user = tb_sppd_kegiatan.bendahara');
		$this->db->join('tb_jabatan AS jb2', 'pg2.jabatan = jb2.id_jabatan');
		if($id != null) {
			$this->db->where('id_keg', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	function cek_kode_rek($no_sppd, $id = null) {
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('kode_rek', $no_sppd);
		if($id != null) {
			$this->db->where('id_keg !=', $id);
		} 
		$query = $this->db->get();
		return $query;
	}

	public function add_keg($data)
	{
		$param = array(
			'kode_rek' => $data['kode_rek'],
			'nama_keg' => $data['nama_keg'],
			'pptk' => $data['pejabat'],
			'bendahara' => $data['pejabat2'],
			'jumlah_anggaran' => $data['jumlah_anggaran'],
			'keterangan' => $data['keterangan'],
			'user_input' => $this->session->userdata('iduser')
		);
        $this->db->insert($this->table, $param);
	}

	public function edit_keg($data)
	{
		$param = array(
            'kode_rek' => $data['kode_rek'],
			'nama_keg' => $data['nama_keg'],
			'pptk' => $data['pejabat'],
			'bendahara' => $data['pejabat2'],
			'jumlah_anggaran' => $data['jumlah_anggaran'],
			'keterangan' => $data['keterangan'],
			'user_input' => $this->session->userdata('iduser')
		);
		$this->db->where('id_keg', $data['id']);
        $this->db->update($this->table, $param);
	}

	public function del_keg($id)
	{
		$this->db->where('id_keg', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
	}

}