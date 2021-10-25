<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class nilai_inbound extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
		$this->load->model(array('inbound'));
		$this->load->helper('url');

	}

	function index()
	{
		
		$res['dsn']=$this->inbound->dosen();				
		// $GetField = $this->daftar_dosen();
		// $res['dsn'] = $GetField;
		// $res['typedosen'] = "default";
		// var_dump($res);

		$this->load->view('dashbord',$res);

	}


	function mata_kuliah(){
		$nip = $this->input->post('id');
		// echo json_encode($nip);    
		$data=$this->inbound->mk($nip);
        echo json_encode($data);

	}

	function t_krs(){

		// $this->load->view('dashbord',$res); 


		$tahunakademik = $this->input->post('tahunakademik');
		$dosen = $this->input->post('dosen');
		$mk = $this->input->post('mk');
		// echo $tahunakademik;
		// echo $dosen;
		// echo $mk;
		$res['data']=$this->inbound->krs($tahunakademik,$dosen,$mk);

		echo json_encode($res);
		// $this->load->view('dashbord',$res);


	}


	function in_nilai(){
		$id_krs = $this->input->post('id');
		$data_krs=$this->inbound->in_nilai($id_krs);
		

		echo json_encode($data_krs);

	}

	function simpan_nilai(){
		$id = $this->input->post('id');
		$hadir = $this->input->post('hadir');
		$praktek = $this->input->post('praktek');
		$mid = $this->input->post('mid');
		$uas = $this->input->post('uas');
		$nilai = $this->input->post('nilai');
		$grade = $this->input->post('grade');

		$data_krs=$this->inbound->simpan_nilai($id, $hadir, $praktek, $mid, $uas, $nilai, $grade);
		echo json_encode($data_krs);
	}







	

}

?>