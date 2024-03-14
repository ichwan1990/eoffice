<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat_in_m extends CI_Model
{

	var $table = "tb_surat_masuk";

	public function get($id = null)
	{
	    $tahun = date('Y');
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_kategori_surat', 'tb_surat_masuk.kategori = tb_kategori_surat.id_kategori');
		if ($id != null) {
			$this->db->where('id_surat_in', $id);
		}
		//$this->db->where('YEAR(tgl_catat)', $tahun);
		$this->db->order_by('no_agenda', 'asc');
		$query = $this->db->get();
		return $query;
	}
	
		public function get_tatausaha($id = null)
	{
	    $tahun = date('Y');
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_kategori_surat', 'tb_surat_masuk.kategori = tb_kategori_surat.id_kategori');
		if ($id != null) {
			$this->db->where('id_surat_in', $id);
		}
		//$this->db->where('YEAR(tgl_catat)', $tahun);
		$this->db->order_by('no_agenda', 'desc');
		$query = $this->db->get();
		return $query;
	}
	
		public function get_disp($id = null)
	{
	    $tahun = date('Y');
	    $bulan = (int) date('n');
	    $tiga_bulan = (int) date("n", strtotime("-3 Months")) ;
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_kategori_surat', 'tb_surat_masuk.kategori = tb_kategori_surat.id_kategori');
		if ($id != null) {
			$this->db->where('id_surat_in', $id);
			$this->db->where('status_selesai' == 0);
		}
		$this->db->where('YEAR(tgl_catat)', $tahun);
		//$this->db->where('MONTH(tgl_catat)  between '. $tiga_bulan .' and ' .$bulan);
		$this->db->order_by('no_agenda', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function get2() //untuk melihat disposisi yang belum di isi 3 bulan kebelakang
	{
	    $tahun = date('Y');
	    $bulan = (int) date('n');
	    $tiga_bulan = (int) date("n", strtotime("-3 Months")) ;
	    
	    if ($bulan < 4){
	        $tahun_awal = date('Y')-1;
	    } else {
	        $tahun_awal = date('Y');
	    }
	    $akhir = date("Y-m", strtotime(  $tahun .'-'.$bulan));
	    $awal = $tahun_awal.'-'.$tiga_bulan;
	    
		$this->db->select('*');
		$this->db->from('tb_disposisi_surat');
		$this->db->join('tb_surat_masuk', 'tb_disposisi_surat.id_surat_in = tb_surat_masuk.id_surat_in');
		$this->db->join('tb_kategori_surat', 'tb_surat_masuk.kategori = tb_kategori_surat.id_kategori');
		$this->db->join('tb_disp_detail_tujuan', 'tb_disposisi_surat.id_disposisi = tb_disp_detail_tujuan.id_disposisi');
		//$this->db->where('tb_surat_masuk.status_selesai' == 0);
		$this->db->where('tb_disp_detail_tujuan.id_user', $this->session->userdata('iduser'));
		//$this->db->where('YEAR(tgl_catat)', $tahun);
		//$this->db->where('LEFT(tb_surat_masuk.tgl_catat, 7)  BETWEEN '. $tahun_awal .'-'.$tiga_bulan .' AND '. $akhir);
		$this->db->where('LEFT(tgl_catat,7) >=',$awal);
		$this->db->where('LEFT(tgl_catat,7) <=',$akhir);
		$this->db->group_by('no_agenda');
		$this->db->order_by('no_agenda', 'desc');
		$query = $this->db->get();
		return $query;
	}
	
		public function get_surat_all_pegawai()
	{
	    $tahun = date('Y');
		$this->db->select('*');
		$this->db->from('tb_disposisi_surat');
		$this->db->join('tb_surat_masuk', 'tb_disposisi_surat.id_surat_in = tb_surat_masuk.id_surat_in');
		$this->db->join('tb_kategori_surat', 'tb_surat_masuk.kategori = tb_kategori_surat.id_kategori');
		$this->db->join('tb_disp_detail_tujuan', 'tb_disposisi_surat.id_disposisi = tb_disp_detail_tujuan.id_disposisi');
		//$this->db->where('tb_surat_masuk.status_selesai' == 0);
		$this->db->where('tb_disp_detail_tujuan.id_user', $this->session->userdata('iduser'));
		$this->db->where('YEAR(tgl_catat)', $tahun);
		$this->db->group_by('no_agenda');
		$this->db->order_by('no_agenda', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function get3() //Untuk menghitung jumlah surat masuk selama 1 tahun diluar direktur dan tata usaha
	{
	    $tahun = date('Y');
		$this->db->select('*');
		$this->db->from('tb_disposisi_surat');
		$this->db->join('tb_surat_masuk', 'tb_disposisi_surat.id_surat_in = tb_surat_masuk.id_surat_in');
		$this->db->join('tb_kategori_surat', 'tb_surat_masuk.kategori = tb_kategori_surat.id_kategori');
		$this->db->join('tb_disp_detail_tujuan', 'tb_disposisi_surat.id_disposisi = tb_disp_detail_tujuan.id_disposisi');
		$this->db->where('tb_disp_detail_tujuan.id_user', $this->session->userdata('iduser'));
		$this->db->where('YEAR(tgl_catat)', $tahun);
		$this->db->group_by('no_agenda');
		$this->db->order_by('no_agenda', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function get4()
	{
		$bulan = date('m');
		$this->db->select('*');
		$this->db->from('tb_disposisi_surat');
		$this->db->join('tb_surat_masuk', 'tb_disposisi_surat.id_surat_in = tb_surat_masuk.id_surat_in');
		$this->db->join('tb_kategori_surat', 'tb_surat_masuk.kategori = tb_kategori_surat.id_kategori');
		$this->db->join('tb_disp_detail_tujuan', 'tb_disposisi_surat.id_disposisi = tb_disp_detail_tujuan.id_disposisi');
		if ($this->session->userdata('level_user') != '2') {
			$this->db->where('tb_disp_detail_tujuan.id_user', $this->session->userdata('iduser'));
		}
		$this->db->where("(SUBSTRING(tb_surat_masuk.tgl_catat, 6, 2) = '$bulan')");
		$this->db->group_by('no_agenda');
		$this->db->order_by('no_agenda', 'desc');
		$query = $this->db->get();
		return $query;
	}

	public function get_period_tahun($tahun)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_kategori_surat', 'tb_surat_masuk.kategori = tb_kategori_surat.id_kategori');
		$this->db->where('YEAR(tgl_catat)', $tahun);
		$this->db->order_by('no_agenda', 'asc');
		$query = $this->db->get();
		return $query;
	}

	public function get_period($tgl1, $tgl2)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('tb_kategori_surat', 'tb_surat_masuk.kategori = tb_kategori_surat.id_kategori');
		$this->db->where('tgl_surat BETWEEN "' . $tgl1 . '" and "' . $tgl2 . '"');
		$this->db->order_by('no_agenda', 'asc');
		$query = $this->db->get();
		return $query;
	}

	function no_agenda0()
	{
		$query = $this->db->query('SELECT MAX(no_agenda) AS no FROM ' . $this->table);
		return $query;
	}

	function no_agenda()
	{
		$tahun = date('Y');
		$this->db->select('RIGHT(tb_surat_masuk.no_agenda,4) as no_agenda', false);
		$this->db->order_by('no_agenda', 'DESC');
		$this->db->where('LEFT(tgl_catat,4)', $tahun);
		$this->db->limit(1);
		$query = $this->db->get($this->table);
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->no_agenda) + 1;
		} else {
			$kode = 1;
		}
		$batas = str_pad($kode, 4, "0", STR_PAD_LEFT);
		$kodetampil = $tahun . "." . $batas;
		return $kodetampil;
	}

	function cek_no_agenda($no, $id = null)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('no_agenda', $no);
		if ($id != null) {
			$this->db->where('id_surat_in !=', $id);
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
			'tgl_selesai' => $data['tgl_selesai'],
			'input_pengirim' => $data['input_pengirim'],
			'pengirim' => $data['pengirim'],
			'perihal' => $data['hal'],
			'isi_ringkas' => $data['isi'],
			'sifat_surat' => $data['sifat'],
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
				'tgl_selesai' => $data['tgl_selesai'],
				'input_pengirim' => $data['input_pengirim'],
				'pengirim' => $data['pengirim'],
				'perihal' => $data['hal'],
				'isi_ringkas' => $data['isi'],
				'sifat_surat' => $data['sifat'],
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
				'tgl_selesai' => $data['tgl_selesai'],
				'input_pengirim' => $data['input_pengirim'],
				'pengirim' => $data['pengirim'],
				'perihal' => $data['hal'],
				'isi_ringkas' => $data['isi'],
				'sifat_surat' => $data['sifat'],
				'file_surat' => $data['file'],
				'keterangan' => $data['ket'],
				'tgl_catat' => date('Y-m-d'),
				'user_input' => $this->session->userdata('iduser')
			);
		}
		$this->db->where('id_surat_in', $data['id']);
		$this->db->update($this->table, $param);
	}

	public function del($id)
	{
		// $this->db->db_debug = FALSE;
		$this->db->where('id_surat_in', $id);
		$this->db->delete($this->table);
		if ($this->db->affected_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}
}
