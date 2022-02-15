<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'libs/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Cetak extends CI_Controller {

    var $title = "SPPD";
	function __construct()
	{
		parent::__construct();
		cek_session();
		$this->load->model('sppd_m', 'sppd');
		$this->load->model('sppd_dasar_m', 'dasar');
		$this->load->model('sppd_pelaksana_m', 'pelaksana');
		$this->load->model('sppd_pengikut_m', 'pengikut');
		$this->load->model('sppd_lap_m', 'lap');
		$this->load->model('pegawai_m', 'pegawai');
	}

    // CETAK SPT
	public function surat_pt_print($id)
	{
        $data['row'] = $this->sppd->get_print($id)->row();
        $data['dasar'] = $this->dasar->get('id_sppd', $id);				
        $data['pelaksana'] = $this->pelaksana->get('id_sppd', $id);
        ob_start();
		$content = $this->load->view('SPPD/CetakSurat/perintahtugas', $data);
        $content = ob_get_clean();
		try {
			$html2pdf = new Html2Pdf('P', 'A4', 'en');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->pdf->setTitle('Cetak Surat Perintah Tugas');
			$html2pdf->writeHTML($content);
			$html2pdf->output('SuratPerintahTugas-'.$this->uri->segment(4).'.pdf');
		} catch (Html2PdfException $e) {
			$html2pdf->clean();
			$formatter = new ExceptionFormatter($e);
			echo $formatter->getHtmlMessage();
		}
	}

	public function surat_pt_print_word($id)
	{
        $sppd = $this->sppd->get_print($id)->row();
        $dasar = $this->dasar->get('id_sppd', $id);				
        $pelaksana = $this->pelaksana->get('id_sppd', $id);
        $pengikut = $this->pengikut->get('id_sppd', $id);
		$data = array(
            'row' => $sppd,
            'dasar' => $dasar,
            'pelaksana' => $pelaksana,
            'pengikut' => $pengikut
        );
		$this->load->view('SPPD/CetakSurat/perintahtugas_word', $data);
	}

    // CETAK SURAT SPPD (Lampiran SPT)
	public function surat_sppd_print($id)
	{
		$sppd = $this->sppd->get_print($id)->row();
        $dasar = $this->dasar->get('id_sppd', $id);				
        $pelaksana = $this->pelaksana->get('id_sppd', $id);
        $pengikut = $this->pengikut->get('id_sppd', $id);
		$data = array(
            'row' => $sppd,
            'dasar' => $dasar,
            'pelaksana' => $pelaksana,
            'pengikut' => $pengikut
        );
        ob_start();
		$content = $this->load->view('SPPD/CetakSurat/sppd', $data);
        $content = ob_get_clean();
		try {
			$html2pdf = new Html2Pdf('P', 'A4', 'en');
			$html2pdf->setDefaultFont('Arial');
			$html2pdf->pdf->setTitle('Cetak Lampiran SPT');
			$html2pdf->writeHTML($content);
			$html2pdf->output('SPPD-'.$this->uri->segment(4).'.pdf');
		} catch (Html2PdfException $e) {
			$html2pdf->clean();
			$formatter = new ExceptionFormatter($e);
			echo $formatter->getHtmlMessage();
		}
	}

	public function surat_sppd_print_word($id)
	{
		$sppd = $this->sppd->get_print($id)->row();
        $dasar = $this->dasar->get('id_sppd', $id);				
        $pelaksana = $this->pelaksana->get('id_sppd', $id);
        $pengikut = $this->pengikut->get('id_sppd', $id);
		$data = array(
            'row' => $sppd,
            'dasar' => $dasar,
            'pelaksana' => $pelaksana,
            'pengikut' => $pengikut
        );
		$this->load->view('SPPD/CetakSurat/sppd_word', $data);
	}

	// CETAK LAPORAN HASIL
	public function lap_hasil_print($id)
	{
		$sppd = $this->sppd->get($id)->row();
		$dasar = $this->dasar->get('id_sppd', $id);
		$hal = $this->lap->get_hal('id_kegiatan', $id);
		$ttd = $this->lap->get_ttd('id_kegiatan', $id)->row();
		$data = array(
			'row' => $sppd,
			'dasar' => $dasar,
            'hal' => $hal,
			'ttd' => $ttd,
        );
        ob_start();
		$content = $this->load->view('SPPD/CetakSurat/laporanhasil', $data);
        $content = ob_get_clean();
		try {
			$html2pdf = new Html2Pdf('P', 'A4', 'en');
			$html2pdf->setDefaultFont('Arial');
			$html2pdf->pdf->setTitle('Cetak Laporan Hasil');
			$html2pdf->writeHTML($content);
			$html2pdf->output('LaporanHasil-'.$this->uri->segment(4).'.pdf');
		} catch (Html2PdfException $e) {
			$html2pdf->clean();
			$formatter = new ExceptionFormatter($e);
			echo $formatter->getHtmlMessage();
		}
	}
	
	public function lap_hasil_print_word($id)
	{
		$sppd = $this->sppd->get($id)->row();				
		$dasar = $this->dasar->get('id_sppd', $id);
		$hal = $this->lap->get_hal('id_kegiatan', $id);
		$ttd = $this->lap->get_ttd('id_kegiatan', $id)->row();
		$pelaksana = $this->pelaksana->get('id_sppd', $id);
        $pengikut = $this->pengikut->get('id_sppd', $id);
		$data = array(
			'row' => $sppd,
            'dasar' => $dasar,
            'hal' => $hal,
			'ttd' => $ttd,
			'pelaksana' => $pelaksana,
            'pengikut' => $pengikut
        );
		$this->load->view('SPPD/CetakSurat/laporanhasil_word', $data);
	}
    
}