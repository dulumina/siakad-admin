<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Nilai_inbound extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
		$this->load->library('m_pdf');
		$this->load->model(array('Inbound'));
		$this->load->helper('url');
	}

	function index()
	{

		$res['dsn'] = $this->Inbound->dosen();
		// $GetField = $this->daftar_dosen();
		// $res['dsn'] = $GetField;
		// $res['typedosen'] = "default";
		// var_dump($res);

		$this->load->view('dashbord', $res);
	}


	function mata_kuliah()
	{
		$nip = $this->input->post('id');
		// echo json_encode($nip);    
		$data = $this->Inbound->mk($nip);
		echo json_encode($data);
	}

	function t_krs()
	{

		$tahunakademik = $this->input->post('tahunakademik');
		$dosen = $this->input->post('dosen');
		$mk = $this->input->post('mk');
		$res['data'] = $this->Inbound->krs($tahunakademik, $dosen, $mk);
		$res['query']=$this->db->last_query();
		echo json_encode($res);
	}


	function in_nilai()
	{
		$id_krs = $this->input->post('id');
		$data_krs = $this->Inbound->in_nilai($id_krs);


		echo json_encode($data_krs);
	}

	function simpan_nilai()
	{
		$id = $this->input->post('id');
		$hadir = $this->input->post('hadir');
		$praktek = $this->input->post('praktek');
		$mid = $this->input->post('mid');
		$uas = $this->input->post('uas');
		$nilai = $this->input->post('nilai');
		$grade = $this->input->post('grade');
		$tugas = $this->input->post('tugas');

		$data_krs = $this->Inbound->simpan_nilai($id, $hadir, $praktek, $tugas, $mid, $uas, $nilai, $grade);
		echo json_encode($data_krs);
	}

	public function cetak_dpna()
	{
		$data['page_title'] = '';
		$periode = $this->input->get('m_periode');
		$dosen = $this->input->get('m_dosen');
		$mk = $this->input->get('m_mk');

		$cetak_dpna['per'] = $this->Inbound->tperiode($periode);
		$cetak_dpna['data_dpna'] = $this->Inbound->krs($periode, $dosen, $mk);
		// var_dump($cetak_dpna);
		$html = $this->load->view('ademik/report/Cetak_dpna_inbound', $cetak_dpna, TRUE);
		$pdf = $this->m_pdf->exp_pdf();
		$pdf->AddPage('L');
		$pdf->pagenumPrefix = 'Halaman ';
		$pdf->nbpgPrefix = ' dari ';
		$pdf->setFooter('{PAGENO}{nbpg}');
		$pdf->WriteHTML($html);

		$pdf->Output('Cetak DPNA.pdf', "D");

		exit();
	}


	public function grade()
	{
		$tahun = $this->input->post('tahun');
		$total = $this->input->post('total');
		$data_grade = $this->Inbound->grade_nilai($tahun, $total);

		// --------------- ambil patokan nilai didalam data base -----------------
		// foreach ($data_grade as $row) {
		// 	$bawah = $row->BatasBawah;
		// 	$atas = $row->BatasAtas;
		// echo $bawah . "--" . $atas . "<br>";
		// if ($total >= $bawah && $total <= $atas) {
		// 	$ambil = $row->Nilai;
		// echo "nilainya  = " . $ambil . "<br>";
		// }
		// }
		// ------------------------------------------------------------------------------

		if ($total >= 85.00 && $total <= 100.00) {
			$ambil = 'A';
		} elseif ($total >= 80.00 && $total <= 90.99) {
			$ambil = 'A-';
		} elseif ($total >= 80.00 && $total <= 84.99) {
			$ambil = 'B+';
		} elseif ($total >= 72.00 && $total <= 79.99) {
			$ambil = 'B';
		} elseif ($total >= 65.00 && $total <= 71.99) {
			$ambil = 'B-';
		} elseif ($total >= 58.00 && $total <= 64.99) {
			$ambil = 'C';
		} elseif ($total >= 45.00 && $total <= 57.99) {
			$ambil = 'D';
		} elseif ($total >= 0 && $total <= 44.99) {
			$ambil = 'E';
		}

		echo json_encode($ambil);
	}
}
