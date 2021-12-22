<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Khs_inbound extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('m_pdf');
		$this->load->helper('security');
		$this->load->model(array('Inbound'));
		$this->load->helper('url');
	}

	function index()
	{

		// $res['dsn']=$this->inbound->dosen();				
		// $GetField = $this->daftar_dosen();
		// $res['dsn'] = $GetField;
		// $res['typedosen'] = "default";
		// var_dump($res);
		$this->load->view('dashbord');
	}

	function mhs()
	{
		$nim = $this->input->post('nim');
		$data_mhs = $this->Inbound->mhs($nim);
		echo json_encode($data_mhs);
	}

	function periode()
	{
		$nim = $this->input->post('nim');
		$data_periode = $this->Inbound->periode($nim);
		echo json_encode($data_periode);
	}

	function tkhs()
	{
		$nim = $this->input->post('nim');
		$periode = $this->input->post('periode');
		$isi_khs['dataa'] = $this->Inbound->khs($nim, $periode);
		// echo $data_khs;
		echo json_encode($isi_khs);
	}

	function cetak_khs()
	{
		$data['page_title'] = '';
		$nim = $this->input->get('ambil-nim');
		$periode = $this->input->get('ambil-periode');
		$cetak_khs['mhs'] = $this->Inbound->mhs($nim);
		$cetak_khs['per'] = $this->Inbound->tperiode($periode);
		$cetak_khs['data_khs'] = $this->Inbound->cetak($nim, $periode);
		$html = $this->load->view('ademik/report/Cetak_khs_inbound', $cetak_khs, TRUE);
		$pdf = $this->m_pdf->exp_pdf();
		$pdf->AddPage('P');
		$pdf->pagenumPrefix = 'Halaman ';
		$pdf->nbpgPrefix = ' dari ';
		$pdf->setFooter('{PAGENO}{nbpg}');
		$pdf->WriteHTML($html);

		$pdf->Output('Cetak KHS.pdf', "D");

		exit();




		// $data['mhsw'] = $this->cetak_khs_prodi_model->($semester,$program,$jurusan,$angkatan);
		// $data['controller']=$this;
		// $data['semester']=$semester;
		// $data['jurusan']=$jurusan;
		// $data['fakultas']=$fak;
		// $html = $this->load->view('ademik/report/cetak_khs_prodi', $data,TRUE);

		//       $pdf = $this->m_pdf->exp_pdf();

		//       $pdf->AddPage('P');
		//       $pdf->pagenumPrefix = 'Halaman ';
		// $pdf->nbpgPrefix = ' dari ';
		//       $pdf->setFooter('{PAGENO}{nbpg}');
		//       $pdf->WriteHTML($html);

		//       $pdf->Output('Cetak KHS.pdf', "D");

		//       exit();
	}
}
