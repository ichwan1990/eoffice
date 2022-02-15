<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposisi_m extends CI_Model {

	var $table = "tb_disposisi_surat";

	public function get_disposisi($id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_pegawai', 'tb_pegawai.id_user = tb_disposisi_surat.user_input');
		$this->db->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_pegawai.jabatan');
		if($id != null) {
			$this->db->where('tb_disposisi_surat.id_disposisi', $id);
		}
		$this->db->where('tb_disposisi_surat.id_surat_in', $this->uri->segment('2'));
		$query = $this->db->get();
		return $query;
	}

	public function add_disposisi($data)
	{
		$param = array(
			'input_teruskan' => $data['input_teruskan'],
			'catatan' => $data['catatan'],
			'id_surat_in' => $data['id_surat_in'],
			'user_input' => $this->session->userdata('iduser')
		);
        $this->db->insert($this->table, $param);
	}

	public function add_detail($table, $data)
	{
		$this->db->insert($table, $data);	
	}

	public function del_disposisi($id)
	{
		$this->db->where('id_disposisi', $id);
        $this->db->delete($this->table);
	}
	public function del_disp_detail_tujuan($id)
	{
		$this->db->where('id_disposisi', $id);
        $this->db->delete('tb_disp_detail_tujuan');
	}
	public function del_disp_detail_perintah($id)
	{
		$this->db->where('id_disposisi', $id);
        $this->db->delete('tb_disp_detail_perintah');
	}

	function cek_ada_disposisi($id_surat_in) {
		$this->db->select('*');
		$this->db->from('tb_disposisi_surat');
		$this->db->where('id_surat_in', $id_surat_in);
		if($this->session->userdata('level_user') != 1) {
			$this->db->where('user_input', $this->session->userdata('iduser'));
		}
		$this->db->group_by('id_surat_in');
		$query = $this->db->get();
		return $query;
	}

	function cek_ada_disposisi_down($id_surat_in) {
		$this->db->select('*');
		$this->db->from('tb_disposisi_surat');
		$this->db->where('id_surat_in', $id_surat_in);
		$this->db->join('tb_pegawai', 'tb_pegawai.id_user = tb_disposisi_surat.user_input');
		$this->db->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_pegawai.jabatan');
		$this->db->where('tb_jabatan.level_jabatan >', $this->session->userdata('level_user'));
		$this->db->where('tb_jabatan.parent_jabatan', $this->session->userdata('idjabatan'));
		$query = $this->db->get();
		return $query;
	}

	function disp_perintah() {
		$query = $this->db->get('tb_disp_perintah');
		return $query;
	}

	function disp_detail_tujuan($id) {
		$this->db->select('*');
		$this->db->from('tb_disp_detail_tujuan');
		$this->db->join('tb_pegawai', 'tb_pegawai.id_user = tb_disp_detail_tujuan.id_user');
		$this->db->join('tb_jabatan', 'tb_jabatan.id_jabatan = tb_disp_detail_tujuan.id_jabatan'); 	
		$this->db->where('tb_disp_detail_tujuan.id_disposisi', $id);
		$query = $this->db->get();
		return $query;
	}

	function disp_detail_perintah($id) {
		$this->db->select('*');
		$this->db->from('tb_disp_detail_perintah');
		$this->db->join('tb_disp_perintah', 'tb_disp_perintah.id_disp_perintah = tb_disp_detail_perintah.id_perintah');
		$this->db->where('tb_disp_detail_perintah.id_disposisi', $id);
		$query = $this->db->get();
		return $query;
	}

	public function get_disposisi_atasan($id, $id_surat_in) {
		$sql = "Select * from (
			Select * from tb_disposisi_surat INNER JOIN tb_pegawai ON tb_disposisi_surat.user_input = tb_pegawai.id_user
			INNER JOIN tb_jabatan ON tb_pegawai.jabatan = tb_jabatan.id_jabatan
			where tb_jabatan.id_jabatan in (
			Select parent_jabatan from tb_jabatan where id_jabatan in (
			Select parent_jabatan from tb_jabatan where id_jabatan in (
			Select parent_jabatan from tb_jabatan where id_jabatan = '$id' AND id_surat_in = '$id_surat_in' )))
			union
			Select * from tb_disposisi_surat INNER JOIN tb_pegawai ON tb_disposisi_surat.user_input = tb_pegawai.id_user
			INNER JOIN tb_jabatan ON tb_pegawai.jabatan = tb_jabatan.id_jabatan
			where tb_jabatan.id_jabatan in (
			Select parent_jabatan from tb_jabatan where id_jabatan in (
			Select parent_jabatan from tb_jabatan where id_jabatan = '$id' AND id_surat_in = '$id_surat_in' ))
			union 
			Select * from tb_disposisi_surat INNER JOIN tb_pegawai ON tb_disposisi_surat.user_input = tb_pegawai.id_user
			INNER JOIN tb_jabatan ON tb_pegawai.jabatan = tb_jabatan.id_jabatan
			where tb_jabatan.id_jabatan in (
			Select parent_jabatan from tb_jabatan where id_jabatan = '$id' AND id_surat_in = '$id_surat_in' ) 
			) as All_in order by level_jabatan";
		$query = $this->db->query($sql);
		return $query;
	}

	public function get_disposisi_bawahan($id, $id_surat_in) {
		$sql = "Select * from tb_disposisi_surat INNER JOIN tb_pegawai ON tb_disposisi_surat.user_input = tb_pegawai.id_user
			INNER JOIN tb_jabatan ON tb_pegawai.jabatan = tb_jabatan.id_jabatan
			where tb_jabatan.id_jabatan = '$id' AND tb_disposisi_surat.id_surat_in = '$id_surat_in'
			union
			Select * from tb_disposisi_surat INNER JOIN tb_pegawai ON tb_disposisi_surat.user_input = tb_pegawai.id_user
			INNER JOIN tb_jabatan ON tb_pegawai.jabatan = tb_jabatan.id_jabatan
			where tb_jabatan.parent_jabatan = '$id' AND tb_disposisi_surat.id_surat_in = '$id_surat_in'
			union 
			Select * from tb_disposisi_surat INNER JOIN tb_pegawai ON tb_disposisi_surat.user_input = tb_pegawai.id_user
			INNER JOIN tb_jabatan ON tb_pegawai.jabatan = tb_jabatan.id_jabatan
			where tb_jabatan.parent_jabatan in (Select id_jabatan from tb_jabatan where parent_jabatan = '$id') AND tb_disposisi_surat.id_surat_in = '$id_surat_in'";
		$query = $this->db->query($sql);
		return $query;
	}

	function get_disposisi_all($id_surat_in) {
		$sql = "Select * from tb_disposisi_surat INNER JOIN tb_pegawai ON tb_disposisi_surat.user_input = tb_pegawai.id_user
			INNER JOIN tb_jabatan ON tb_pegawai.jabatan = tb_jabatan.id_jabatan
			where tb_disposisi_surat.id_surat_in = '$id_surat_in'
			union
			Select * from tb_disposisi_surat INNER JOIN tb_pegawai ON tb_disposisi_surat.user_input = tb_pegawai.id_user
			INNER JOIN tb_jabatan ON tb_pegawai.jabatan = tb_jabatan.id_jabatan
			where tb_disposisi_surat.id_surat_in = '$id_surat_in'
			union 
			Select * from tb_disposisi_surat INNER JOIN tb_pegawai ON tb_disposisi_surat.user_input = tb_pegawai.id_user
			INNER JOIN tb_jabatan ON tb_pegawai.jabatan = tb_jabatan.id_jabatan
			where tb_disposisi_surat.id_surat_in = '$id_surat_in'";
		$query = $this->db->query($sql);
		return $query;
	}

}