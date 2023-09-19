<?php
function hitung_disposisi_2()
{
    $ci = &get_instance();
    $ci->load->model('surat_in_m', 'surat_in');
    $ci->load->model('disposisi_m', 'disposisi');

    if ($ci->session->userdata('level_user') == '2') {
        $in = $ci->surat_in->get_disp();
    } else if ($ci->session->userdata('level_user') == '1') {
        $in = $ci->surat_in->get_tatausaha();
    } else {
        $in = $ci->surat_in->get2();
    }
    
    $data['row'] = $in->result();
    $jml = 0;

    //Hitung Jumlah Surat yang belum di Disposisi
    foreach ($in->result() as $r => $d) {
        if ($ci->disposisi->cek_ada_disposisi($d->id_surat_in)->num_rows() == 0) {
            $jml = $jml + 1;
        }
    }

    // if ($ci->session->userdata('level_user') == '1') {
    //     $data['row'] = $ci->surat_in->get_tatausaha()->result();
    // } else if ($ci->session->userdata('level_user') == '2') {
    //     $data['row'] = $ci->surat_in->get_disp()->result();
    // } else {
    //     $data['row'] = $ci->surat_in->get2()->result();
    // }

    $data = array(
        'jml' => $jml,
        'row' => $data['row'],
    );

    return $data;
}
