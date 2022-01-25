<?php

class KelasKuliah extends CI_Controller{

    function __construct() {
	    parent::__construct();
		$this->load->model('FeederRunWS');
	}
	
	public function get_list_riwayat_mhs(){
		// echo"tes";
		$filter = "id_registrasi_mahasiswa = 'f44a01dd-13de-47fb-9754-ba483e5612ac'";
		$result['data']=$this->FeederRunWS->get('GetListRiwayatPendidikanMahasiswa',$filter);
		echo "<pre>";
		print_r($result);die;
	}

	public function get_smt(){
		$filter = "id_semester = '20211'";
		$result=$this->FeederRunWS->get('GetSemester', $filter);
		echo "<pre>";
		print_r($result);die;		
	}

	public function get_status_mhs(){
		$filter ="id_status_mahasiswa = 'A'";
		$result['data']=$this->FeederRunWS->get('GetStatusMahasiswa',$filter);
		echo "<pre>";
		print_r($result);die;
	}
    
    public function insert_kelaskuliah(){

		$filter = "id_semester = '20211'";
		$result =$this->FeederRunWS->get('GetSemester', $filter);
		echo $result['id_semester'];
		
    }
}