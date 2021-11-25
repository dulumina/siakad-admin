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
		// $filter = "id_semester = '20211'";
		$result=$this->FeederRunWS->get('GetSemester');
		// echo "<pre>";
		// print_r($result);die;

		$positive = array_filter($result, function($result) {
			return $result > 0;
		});
		echo "<pre>";
		print_r($positive);die;

		// $array = compact("result");
		// echo "<pre>";
		// print_r($array);die;
		
		// $ids = array_column($filter, 'id_semester');
		// echo "<pre>";
		// print_r($ids);die;

		// array_walk($result, function(&$value, $key) {
		// 	$value = "$key is $value";
		// });
		// $tes = array_key_first($data);
		// echo "<pre>";
		// print_r($result);die;
		
	}

	public function get_status_mhs(){
		$filter ="id_status_mahasiswa = 'A'";
		$result['data']=$this->FeederRunWS->get('GetStatusMahasiswa',$filter);
		echo "<pre>";
		print_r($result);die;
	}
    
    public function insert_kelaskuliah(){
/*
        $id_registrasi_mahasiswa=$this->input->post('id_registrsi_mahasiswa');
        $id_semester=$this->input->post('id_semester');
		$id_status_mahasiswa=$this->input->post('id_status_mahasiswa');
		$ips=$this->input->post('ips');
		$ipk = $this->input->post('ipk');
        $sks_semester = $this->input->post('sks_semester');
        $total_sks = $this->input->post('total_sks');
		$biaya_kuliah_smt = $this->input->post('biaya_kuliah_smt');*/
		
		// ======================================================
		// $filter = "id_registrasi_mahasiswa = 'f44a01dd-13de-47fb-9754-ba483e5612ac'";
		// $result['tes'] =$this->FeederRunWS->get('GetListRiwayatPendidikanMahasiswa',$filter);

		$filter = "id_semester = '20211'";
		// $filter = "id_semester";
		$result =$this->FeederRunWS->get('GetSemester', $filter);
		$a=json_encode($result);
		// echo json_encode($result);
		
		// echo $a; 
		echo $result['id_semester'];
		
		// $filter2 ="id_status_mahasiswa = 'A'";
		// $result2=$this->FeederRunWS->get('GetStatusMahasiswa',$filter2);
		
		// ========================================

		// $positive = array_filter($result, function($result) {
		// 		return $result > 0;
		// 	});
		// $id = array_column($result, 'array');
			// echo "<pre>";
			// print_r($result);die;

		// $data['books'] = $this->books_model->get_books($cat['id']);

		// foreach($result as $book) {
		// 	echo "<pre>";
		// 	print_r($book);die;
		// // echo $book;
		// }
		// echo "<pre>";
		// print_r($result);die;
		/*
		$record = array(
			'id_registrsi_mahasiswa' => $result,
			'id_semester' => $result1,
			'id_status_mahasiswa' => $result2,
			'ips' => '0',
			'ipk' => '0',
			'sks_semester' => '1',
			'total_sks' => '2',
			'biaya_kuliah_smt' => '3'
        );
		
		echo "<pre>";
		print_r($record);die;*/
		// $where = array('id_semester' => $id_semester);
		
		// // $record->id_registrasi_mahasiswa = "bgq21"
		// // $record->id_semester = "tes";
		// // $record->id_status_mahasiswa = "A";
		// // $record->ips = "0";
		// // $record->ipk = "0";
		// // $record->sks_semester = "3";
		// // $record->total_sks = "2";
        // // $record->biaya_kuliah_smt = "14";

		// $table = 'kelas_kuliah';

		// $act = 'InsertPerkuliahanMahasiswa';

        // $this->FeederRunWS->insert($act,$record);
        
    }
}