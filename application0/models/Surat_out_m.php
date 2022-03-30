<?php
defined('BASEPATH') or exit('No direct script access allowed');

class surat_out_m extends CI_Model
{

	var $table = "tb_surat_keluar";

	public function get($id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_kategori_surat', 'tb_surat_keluar.kategori = tb_kategori_surat.id_kategori');
		$this->db->join('tb_tujuan_surat', 'tb_surat_keluar.tujuan = tb_tujuan_surat.id_tujuan');
		$this->db->join('tb_jabatan', 'tb_surat_keluar.pengolah = tb_jabatan.kode_surat', 'left');
		if ($id != null) {
			$this->db->where('id_surat_out', $id);
		}
		$this->db->order_by('no_agenda', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function get2($id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_kategori_surat', 'tb_surat_keluar.kategori = tb_kategori_surat.id_kategori');
		$this->db->join('tb_tujuan_surat', 'tb_surat_keluar.tujuan = tb_tujuan_surat.id_tujuan');
		$this->db->join('tb_jabatan', 'tb_surat_keluar.pengolah = tb_jabatan.kode_surat', 'left');
		$this->db->where('user_input', $this->session->userdata('iduser'));
		$this->db->order_by('no_agenda', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function get_period($tgl1, $tgl2)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_kategori_surat', 'tb_surat_keluar.kategori = tb_kategori_surat.id_kategori');
		$this->db->join('tb_tujuan_surat', 'tb_surat_keluar.tujuan = tb_tujuan_surat.id_tujuan');
		$this->db->join('tb_jabatan', 'tb_surat_keluar.pengolah = tb_jabatan.kode_surat', 'left');
		$this->db->where('tgl_surat BETWEEN "' . $tgl1 . '" and "' . $tgl2 . '"');
		$this->db->order_by('tgl_surat', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function no_agenda0($id_pengolah)
	{
		$query = $this->db->query('SELECT MAX(no_agenda) AS no FROM ' . $this->table . ' WHERE pengolah=' . $id_pengolah);
		return $query;
	}

	function no_agenda1($id_pengolah)
	{
		$tahun = date('Y');
		$this->db->select('MAX(no_agenda) AS no', false);
		$this->db->where('pengolah', $id_pengolah);
		$this->db->where('LEFT(tgl_surat,4)', $tahun);
		$query = $this->db->get($this->table);
		return $query;
	}

	function no_agenda()
	{
		$tahun = date('Y');
		$this->db->select('RIGHT(tb_surat_keluar.no_agenda,3) as no_agenda', false);
		$this->db->order_by('no_agenda', 'DESC');
		$this->db->where('LEFT(tgl_surat,4)', $tahun);
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->no_agenda) + 1;
		} else {
			$kode = 1;
		}
		$kodetampil = str_pad($kode, 3, "0", STR_PAD_LEFT);
		return $kodetampil;
	}

	function cek_no_agenda($no, $id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('no_agenda', $no);
		if ($id != null) {
			$this->db->where('id_surat_out !=', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function add($data)
	{
		$param = array(
			'no_agenda' => $data['no_agenda'],
			'kategori' => $data['kategori'],
			'no_surat' => $data['no_surat'],
			'tgl_surat' => $data['tgl_surat'],
			'perihal' => $data['hal'],
			'isi_ringkas' => $data['isi'],
			'tujuan' => $data['tujuan'],
			'pengolah' => $data['pengolah'],
			'file_surat' => $data['file'],
			'keterangan' => $data['ket'],
			'tgl_catat' => date('Y-m-d'),
			'user_input' => $this->session->userdata('iduser')
		);
		$this->db->insert($this->table, $param);
	}

	public function edit($data)
	{
		if ($data['file'] == '') {
			$param = array(
				'no_agenda' => $data['no_agenda'],
				'kategori' => $data['kategori'],
				'no_surat' => $data['no_surat'],
				'tgl_surat' => $data['tgl_surat'],
				'perihal' => $data['hal'],
				'isi_ringkas' => $data['isi'],
				'tujuan' => $data['tujuan'],
				'pengolah' => $data['pengolah'],
				'keterangan' => $data['ket'],
				'tgl_catat' => date('Y-m-d'),
				'user_input' => $this->session->userdata('iduser')
			);
		} else {
			$param = array(
				'no_agenda' => $data['no_agenda'],
				'kategori' => $data['kategori'],
				'no_surat' => $data['no_surat'],
				'tgl_surat' => $data['tgl_surat'],
				'perihal' => $data['hal'],
				'isi_ringkas' => $data['isi'],
				'tujuan' => $data['tujuan'],
				'pengolah' => $data['pengolah'],
				'file_surat' => $data['file'],
				'keterangan' => $data['ket'],
				'tgl_catat' => date('Y-m-d'),
				'user_input' => $this->session->userdata('iduser')
			);
		}
		$this->db->where('id_surat_out', $data['id']);
		$this->db->update($this->table, $param);
	}

	public function del($id)
	{
		$this->db->where('id_surat_out', $id);
		$this->db->delete($this->table);
	}
}
