<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class khs_inbound extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
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
		$data_mhs=$this->Inbound->mhs($nim);
		echo json_encode($data_mhs);
	}

	function periode()
	{
		$nim = $this->input->post('nim');
		$data_periode=$this->Inbound->periode($nim);
		echo json_encode($data_periode);
	}

	function tkhs()
	{
		$nim = $this->input->post('nim');
		$periode = $this->input->post('periode');
		$isi_khs['dataa']=$this->Inbound->khs($nim,$periode);
		// echo $data_khs;
		echo json_encode($isi_khs);
	}

	

}

?>