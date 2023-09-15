<?php
function cek_session() {
	$ci =& get_instance();
	$session = $ci->session->userdata('iduser');
	if($session == '') {
		redirect('auth/login');
	}
}
function cek_session_login() {
	$ci =& get_instance();
	$session = $ci->session->userdata('iduser');
	if($session != '') {
		redirect('dashboard');
	}
}

function cek_admin() { // cek session admin
	$ci =& get_instance();
	$session = $ci->session->userdata('level_user');
	if($session != '0') {
		redirect('dashboard');
	}
}
function cek_level_1() { // cek session pengagenda
	$ci =& get_instance();
	$session = $ci->session->userdata('level_user');
	if($session != '1') {
		redirect('dashboard');
	}
}
function cek_level_2() { // cek session kepala dinas
	$ci =& get_instance();
	$session = $ci->session->userdata('level_user');
	if($session != '2') {
		redirect('dashboard');
	}
}

/* Developed by yukcoding.co.id */

function tgl_indo($tgl) {
	$tanggal = substr($tgl,8,2);
	$bulan = substr($tgl,5,2);
	$tahun = substr($tgl,0,4);
	return $tanggal.'/'.$bulan.'/'.$tahun;		 
}

function tgl_bln_indo($tanggal) {
	$bulan = array(1 => 'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2].' ' .$bulan[(int)$split[1]].' '.$split[0];
}


/* nested jabatan & pegawai */
function nested_pgw($items = "", $parentId = "0", $wrapperTag = 'ul', $itemTag = 'li')
{
	$ci =& get_instance();
	$ci->db->select('*');
	$ci->db->from('tb_pegawai');
	$ci->db->join('tb_jabatan', 'tb_pegawai.jabatan = tb_jabatan.id_jabatan', 'left');
	$ci->db->where('level_jabatan !=', '0');
	$ci->db->where('level_jabatan !=', '1');
	$query = $ci->db->get();
	$items = $query->result();
    // Parent items control
    $isParentItem = false;
    foreach ($items as $key => $item) {
        if ($item->parent_jabatan === $parentId) {
            $isParentItem = true;
            break;
        }
    }
    // Prepare items
    $html = "";
    if ($isParentItem) {
        $html .= "<$wrapperTag>";
        foreach ($items as $key => $item) {
            if ($item->parent_jabatan === $parentId) {
                $html .= "<$itemTag> <b>".$item->nama_jabatan."</b><br> ".$item->nama_lengkap."</$itemTag>";
                $html .= nested_pgw($items, $item->id_jabatan);
            }
        }
        $html .= "</$wrapperTag>";
    }
    return $html;
}
