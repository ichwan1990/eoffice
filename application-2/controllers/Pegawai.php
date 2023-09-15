<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

    var $title = "Pegawai";

    function __construct()
    {
        parent::__construct();
        cek_session();
        cek_admin();
        $this->load->model('pegawai_m', 'pegawai');
    }

    public function index()
    {
        $this->load->model('jabatan_m', 'jabatan');
        $data['row'] = $this->pegawai->get()->result();
        $this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Master/Pegawai/pegawai_data', $data);
    }

    public function struktur()
    {
        $this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Master/Pegawai/pegawai_struktur');
    }

    public function add()
    {
        $pegawai = new stdClass();
        $pegawai->id_user = null;
        $pegawai->nip = null;
        $pegawai->nama_lengkap = null;
        $pegawai->alamat = null;
        $pegawai->no_telp = null;
        $pegawai->email = null;
        $pegawai->username = null;
        $pegawai->password = null;
        $pegawai->level_user = null;
        $this->load->model('golongan_m', 'golongan');
        $sql = $this->golongan->get();
        $golongan[0] = '';
        foreach($sql->result() as $glg) {
            $golongan[$glg->id_gol] = $glg->kode_gol." - ".$glg->nama_gol;
        }
        $this->load->model('jabatan_m', 'jabatan');
        $sql = $this->jabatan->get();
        $jabatan[null] = '';
        foreach($sql->result() as $jbt) {
            $jabatan[$jbt->id_jabatan] = $jbt->nama_jabatan;
        }
        $data = array(
            'page' => 'add',
            'row' => $pegawai,
            'judul' => 'Tambah',
            'golongan' => $golongan, 'selectedgolongan' => null,
            'jabatan' => $jabatan, 'selectedjabatan' => null
        );
        $this->template->set('title', $this->title);
        $this->template->load('inc/template', 'Master/Pegawai/pegawai_form', $data);   
    }

    public function edit($id)
    {
        if($id != "") {
            $sql = $this->pegawai->get($id);
            if($sql->num_rows() > 0) {
                $pegawai = $sql->row();
                $this->load->model('golongan_m', 'golongan');
                $sql = $this->golongan->get();
                $golongan[0] = '';
                foreach($sql->result() as $glg) {
                    $golongan[$glg->id_gol] = $glg->kode_gol." - ".$glg->nama_gol;
                }
                $this->load->model('jabatan_m', 'jabatan');
                $sql = $this->jabatan->get();
                $jabatan[null] = '';
                foreach($sql->result() as $jbt) {
                    $jabatan[$jbt->id_jabatan] = $jbt->nama_jabatan;
                }
                $data = array(
                    'page' => 'edit',
                    'row' => $pegawai,
                    'judul' => 'Edit',
                    'golongan' => $golongan, 'selectedgolongan' => $pegawai->golongan,
                    'jabatan' => $jabatan, 'selectedjabatan' => $pegawai->jabatan
                );
                $this->template->set('title', $this->title);
                $this->template->load('inc/template', 'Master/Pegawai/pegawai_form', $data);  
            } else {
                redirect('pegawai');    
            }
        } else {
            echo "<script>window.location='".site_url('pegawai')."';</script>";
        }
    }

    public function proses()
    {
        if(@$_POST['add']) {
            if($this->pegawai->cek_nip($this->input->post('nip'))->num_rows() > 0) {
                echo "<script>alert('NIP sudah digunakan akun lain'); window.location='add';</script>";
            } else {
                $data = $this->input->post(null, TRUE);
                $this->pegawai->add($data);
            }
        } else if(@$_POST['edit']) {
            if($this->pegawai->cek_nip($this->input->post('nip'), $this->input->post('id'))->num_rows() > 0) {
                echo "<script>alert('NIP sudah digunakan akun lain'); window.location='edit/".$this->input->post('id')."';</script>";
            } else {
                $data = $this->input->post(null, TRUE);
                $this->pegawai->edit($data);
            }
        }
        redirect('pegawai');
    }

    public function del($id)
    {
        if($id != '') {
            $this->pegawai->del($id);
        }
        redirect('pegawai');
    }

}
