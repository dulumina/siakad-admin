<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prckrs_siakadNIM extends CI_Controller {


	function __construct() {
	    parent::__construct();
		$this->load->library('encryption');
		$this->load->model('Prc');
		$this->load->model('krs_model');

		date_default_timezone_set("Asia/Makassar");

	}

	public function tes()
	{

		/*$dataEncrypt = $this->encryption->encrypt("E28112177|DUM014|20182|B");
		
		echo $dataEncrypt;*/
		
		$dataDecrypt = $this->encryption->decrypt('429243e0bdf23fba84af48abc4cf4428fdf6f129be44c5d42f273f987a1d78105d9ad9643891b92e71f0666b63c38d31cab1e7c6b87957e197752f0fd6140c58JxJhT8lVLMn533AMVFvGz98E0JHSeohMnMpBFqlSphTVfQ9BRq39f+D+Xm4ZXCuv');
		echo $dataDecrypt;
	}

	public function index()
	{
		$content = $this->session->userdata('sess_tamplate');
		$this->load->view('temp/head');
		$this->load->view($content);
		$this->load->view('temp/footers');
	}

	public function prc_krs_lama()
	{
		$check = $this->Prc->getKrsLama($this->input->post('nim'),$this->input->post('tahun'));
		if($check->num_rows()>0) {
			$data = $check->result();
			foreach($data as $row) {
				$check_siakad_baru = $this->Prc->checkKrsBaru($this->input->post('nim'),$this->input->post('tahun'), $row->IDMK);
				if($check_siakad_baru>0) {
					echo "Siakad Baru : Data MK sudah ada di krs, IDMK = ".$row->IDMK.", KodeMK = ".$row->KodeMK." dan NamaMK = ".$row->NamaMK."<br />";
				} else {
					$dataKrsLama= array(
						'ID' => $row->ID,
						'st_feeder' => $row->st_feeder,
						'NIM' => $row->NIM,
						'Tahun' => $row->Tahun,
						'SMT' => $row->SMT,
						'Sesi' => $row->Sesi,
						'IDJadwal' => $row->IDJadwal,
						'IDPAKET' => $row->IDPAKET,
						'IDMK00' => $row->IDMK00,
						'IDMK' => $row->IDMK,
						'KodeMK' => $row->KodeMK,
						'NamaMK' => $row->NamaMK,
						'SKS' => $row->SKS,
						'Status' => $row->Status,
						'Program' => $row->Program,
						'IDDosen' => $row->IDDosen,
						'unip' => $row->unip,
						'Tanggal' => $row->Tanggal,
						'hr_1' => $row->hr_1,
						'hr_2' => $row->hr_2,
						'hr_3' => $row->hr_3,
						'hr_4' => $row->hr_4,
						'hr_5' => $row->hr_5,
						'hr_6' => $row->hr_6,
						'hr_7' => $row->hr_7,
						'hr_8' => $row->hr_8,
						'hr_9' => $row->hr_9,
						'hr_10' => $row->hr_10,
						'hr_11' => $row->hr_11,
						'hr_12' => $row->hr_12,
						'hr_13' => $row->hr_13,
						'hr_14' => $row->hr_14,
						'hr_15' => $row->hr_15,
						'hr_16' => $row->hr_16,
						'hr_17' => $row->hr_17,
						'hr_18' => $row->hr_18,
						'hr_19' => $row->hr_19,
						'hr_20' => $row->hr_20,
						'hr_21' => $row->hr_21,
						'hr_22' => $row->hr_22,
						'hr_23' => $row->hr_23,
						'hr_24' => $row->hr_24,
						'hr_25' => $row->hr_25,
						'hr_26' => $row->hr_26,
						'hr_27' => $row->hr_27,
						'hr_28' => $row->hr_28,
						'hr_29' => $row->hr_29,
						'hr_30' => $row->hr_30,
						'hr_31' => $row->hr_31,
						'hr_32' => $row->hr_32,
						'hr_33' => $row->hr_33,
						'hr_34' => $row->hr_34,
						'hr_35' => $row->hr_35,
						'hr_36' => $row->hr_36,
						'jmlHadir' => $row->jmlHadir,
						'Hadir' => $row->Hadir,
						'Tugas1' => $row->Tugas1,
						'Tugas2' => $row->Tugas2,
						'Tugas3' => $row->Tugas3,
						'Tugas4' => $row->Tugas4,
						'Tugas5' => $row->Tugas5,
						'NilaiPraktek' => $row->NilaiPraktek,
						'NilaiMID' => $row->NilaiMID,
						'NilaiUjian' => $row->NilaiUjian,
						'Nilai' => $row->Nilai,
						'GradeNilai' => $row->GradeNilai,
						'Bobot' => $row->Bobot,
						'useredt' => $row->useredt,
						'tgledt' => $row->tgledt,
						'rowedt' => $row->rowedt,
						'Tunda' => $row->Tunda,
						'AlasanTunda' => $row->AlasanTunda,
						'Setara' => $row->Setara,
						'MKSetara' => $row->MKSetara,
						'KodeSetara' => $row->KodeSetara,
						'SKSSetara' => $row->SKSSetara,
						'GradeSetara' => $row->GradeSetara,
						'NotActive' => $row->NotActive,
						'unipupd' => $row->unipupd,
						'angkatan' => $row->angkatan,
						'prckkn' => $row->prckkn,
					);
					
					if ($this->Prc->save_krs_siakad_baru($dataKrsLama, $this->input->post('tahun'))) {
						echo "berhasil tersimpan : Nama mk = ".$row->NamaMK.", Kode Mk = ".$row->KodeMK."<br />";
					} else {
						echo "gagal tersimpan<br />";
					}
				}
			}
		} else {
			echo "Siakad Lama : ".$this->input->post('nim')." tidak ada di krs".$this->input->post('tahun')."<br />";
		}
	}
	
}
