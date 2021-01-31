<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prckhs_feeder extends CI_Controller {


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

	public function spp_default($kdj) {

		switch ($kdj) {
			case $kdj == 'A111':
					$ukt = '3000000';
				break;
			case $kdj == 'A121':
					$ukt = '3000000';
				break;
			case $kdj == 'A231':
					$ukt = '3000000';
				break;
			case $kdj == 'A221':
					$ukt = '3000000';
				break;
			case $kdj == 'A251':
					$ukt = '3000000';
				break;
			case $kdj == 'A241':
					$ukt = '3000000';
				break;
			case $kdj == 'A311':
					$ukt = '3000000';
				break;
			case $kdj == 'A321':
					$ukt = '3000000';
				break;
			case $kdj == 'A351':
					$ukt = '3000000';
				break;
			case $kdj == 'A401':
					$ukt = '3000000';
				break;
			case $kdj == 'A421':
					$ukt = '3000000';
				break;
			case $kdj == 'A411':
					$ukt = '3000000';
				break;
			case $kdj == 'A501':
					$ukt = '3000000';
				break;
			case $kdj == 'B201':
					$ukt = '1600000';
				break;
			case $kdj == 'B301':
					$ukt = '1600000';
				break;
			case $kdj == 'B101':
					$ukt = '2500000';
				break;
			case $kdj == 'B401':
					$ukt = '2500000';
				break;
			case $kdj == 'B501':
					$ukt = '2500000';
				break;
			case $kdj == 'C301':
					$ukt = '2500000';
				break;
			case $kdj == 'C201':
					$ukt = '2500000';
				break;
			case $kdj == 'C101':
					$ukt = '2500000';
				break;
			case $kdj == 'C300':
					$ukt = '2500000';
				break;
			case $kdj == 'C200':
					$ukt = '2500000';
				break;
			case $kdj == 'D101':
					$ukt = '2500000';
				break;
			case $kdj == 'E321':
					$ukt = '1750000';
				break;
			case $kdj == 'E281':
					$ukt = '1750000';
				break;
			case $kdj == 'K2MC201':
					$ukt = '1600000';
				break;
			case $kdj == 'K2ME281':
					$ukt = '1750000';
				break;
			case $kdj == 'K2MF111':
					$ukt = '1750000';
				break;
			case $kdj == 'K2TF111':
					$ukt = '1750000';
				break;
			case $kdj == 'K2TE281':
					$ukt = '1750000';
				break;
			case $kdj == 'K2TC201':
					$ukt = '1600000';
				break;
			case $kdj == 'F441':
					$ukt = '3000000';
				break;
			case $kdj == 'F331':
					$ukt = '3000000';
				break;
			case $kdj == 'F240':
					$ukt = '1750000';
				break;
			case $kdj == 'F111':
					$ukt = '4000000';
				break;
			case $kdj == 'F210':
					$ukt = '1750000';
				break;
			case $kdj == 'F551':
					$ukt = '4000000';
				break;
			case $kdj == 'F221':
					$ukt = '4000000';
				break;
			case $kdj == 'F121':
					$ukt = '3000000';
				break;
			case $kdj == 'F131':
					$ukt = '3000000';
				break;
			case $kdj == 'F230':
					$ukt = '1750000';
				break;
			case $kdj == 'F231':
					$ukt = '3000000';
				break;
			case $kdj == 'A112':
					$ukt = '7000000';
				break;
			case $kdj == 'A122':
					$ukt = '7000000';
				break;
			case $kdj == 'A202':
					$ukt = '7000000';
				break;
			case $kdj == 'A232':
					$ukt = '7000000';
				break;
			case $kdj == 'A312':
					$ukt = '7000000';
				break;
			case $kdj == 'A322':
					$ukt = '7000000';
				break;
			case $kdj == 'B102':
					$ukt = '7000000';
				break;
			case $kdj == 'C102':
					$ukt = '7000000';
				break;
			case $kdj == 'C202':
					$ukt = '7000000';
				break;
			case $kdj == 'C302':
					$ukt = '7000000';
				break;
			case $kdj == 'D102':
					$ukt = '7000000';
				break;
			case $kdj == 'E202':
					$ukt = '7000000';
				break;
			case $kdj == 'E322':
					$ukt = '7000000';
				break;
			case $kdj == 'F112':
					$ukt = '7000000';
				break;
			case $kdj == 'A203':
					$ukt = '12000000';
				break;
			case $kdj == 'B103':
					$ukt = '12000000';
				break;
			case $kdj == 'C203':
					$ukt = '12000000';
				break;
			case $kdj == 'E203':
					$ukt = '12000000';
				break;
			case $kdj == 'L131':
					$ukt = '1750000';
				break;
			case $kdj == 'L140':
					$ukt = '1750000';
				break;
			case $kdj == 'N':
					$ukt = '';
				break;
			case $kdj == 'O271':
					$ukt = '1750000';
				break;
			case $kdj == 'O121':
					$ukt = '1750000';
				break;
			case $kdj == 'P101':
					$ukt = '5000000';
				break;
			case $kdj == 'P211':
					$ukt = '7000000';
				break;
			case $kdj == 'N201':
					$ukt = '5000000';
				break;
			
			default:
					$ukt = '';
				break;
		}

		return $ukt;
	}
	
	public function import_khs_feeder_all(){
		$dataKHS = $this->Prc->getAllKHS($this->input->post('tahun'), $this->input->post('fakultas'));

		$dataKhsBaru = array();
		foreach ($dataKHS as $show) {
			$data1 = array(
				'ID' => $show->ID,
				'NIM' => $show->NIM,
				'Tahun' => $show->Tahun,
				'st_feeder' => $show->st_feeder,
				'stprc' => $show->stprc,
		    );

		    array_push($dataKhsBaru, $data1);
		}

		foreach ($dataKhsBaru as $khs) {
			//echo $khs->NIM.' - '.$khs->Tahun.' - '.$khs->st_feeder.' - '.$khs->stprc.'<br>';
			$nim = $khs['NIM'];
			$tahun = $khs['Tahun'];
	
			$tahun_akademik = $this->krs_model->tahun_akademik($nim);
			$spp_db = $this->krs_model->pembayaran($nim, $tahun);
			$data = $this->krs_model->getDataKhsFeeder($nim, $tahun);
	
			//print_r($tahun_akademik);
			if ($data->Status == 'C' ) {
				$spp = 0;
			} else {
	
				if ( empty($spp_db[0]->KodeFakultas) ) {
					$kdf = substr($nim, 0,1);
					$kdj = substr($nim, 0,4);
				} else {
					$kdf = $spp_db[0]->KodeFakultas;
					$kdj = $spp_db[0]->KodeJurusan;
				}
	
				if ( $spp_db[0]->TotalBayar == NULL OR $spp_db[0]->TotalBayar == 0 ) {
					$spp = $this->spp_default($kdj);
				} elseif ( $tahun == $tahun_akademik->Semester ) {
					$spp = $this->spp_default($tahun_akademik->KodeJurusan);
				} else {
					$spp = $spp_db[0]->TotalBayar;
				}
	
			}
	
			$feeder = $this->feeder->getToken_feeder();
			$temp_token = $feeder['temp_token'];
			$temp_proxy = $feeder['temp_proxy'];
	
			if($data->IPK != -1){
				$NIM = ucfirst($data->NIM);
	
				$record = new stdClass();
				$record->id_smt = $data->Tahun;
				$record->id_reg_pd = $data->id_reg_pd;
				$record->id_stat_mhs = $data->Status;
				$record->ips = $data->IPS;
				$record->sks_smt = $data->SKS;
				$record->ipk = $data->IPK;
				$record->sks_total = $data->TotalSKS;
				$record->biaya_smt = $spp;
	
				$ID = $data->ID;
	
				$table = 'kuliah_mahasiswa';
	
				// action insert ke feeder
				$action = 'InsertRecord';
	
				// insert tabel mahasiswa ke feeder
				$rdikti = $this->feeder->action_feeder($temp_token,$temp_proxy,$action,$table,$record);
	
				$error_code = $rdikti['error_code'];
				if($error_code==730){
	
					$recordup = array(
						'key' => array('id_smt' => $data->Tahun,'id_reg_pd' => $data->id_reg_pd,'id_stat_mhs' => $data->Status),
						'data' => array('ips' => $data->IPS,'sks_smt' => $data->SKS,'ipk' => $data->IPK,'sks_total' => $data->TotalSKS, 'biaya_smt' => $spp)
					);
	
					$table = 'kelas_kuliah';
	
					// action insert ke feeder
					$action = 'UpdateRecord';
	
					// insert tabel mahasiswa ke feeder
					$rdiktiup = $this->feeder->action_feeder($temp_token,$temp_proxy,$action,$table,$recordup);
	
					$sql = $this->krs_model->updateKhsFeeder($ID);
					if($sql){
						echo "Status : Success, Msg : Data Berhasil DI Import dengan IPS : ".$data->IPS." dan IPK : ".$data->IPK.", NIM : ".$nim.", Periode: ".$tahun."<br><br>";
					}else{
						$dataError = array(
							'error_code' => 'TIK',
							'error_desc' => 'Data Berhasil di import tapi st_feeder gagal diupdate di khs'
						);
						$this->Prc->setError($khs['ID'], $dataError);
						echo "Status : Success, Msg : Data Berhasil di import tapi st_feeder gagal diupdate di khs, NIM : ".$nim.", Periode: ".$tahun."<br><br>";
					}
				} elseif ($error_code!=0){
					$error_desc = $rdikti['error_desc'];
	
					$dataError = array(
						'error_code' => $error_code,
						'error_desc' => $error_desc
					);
					$this->Prc->setError($khs['ID'], $dataError);
					echo "Status : error_feeder, Msg : ".$error_code."-".$error_desc." - ".json_encode($record).", NIM : ".$nim.", Periode: ".$tahun."<br><br>";
					
				}else{
					$sql = $this->krs_model->updateKhsFeeder($ID);
					if($sql){
						echo "Status : Success, Msg : Data Berhasil DI Import dengan IPS : ".$data->IPS." dan IPK : ".$data->IPK.", NIM : ".$nim.", Periode: ".$tahun."<br><br>";
					}else{
						$dataError = array(
							'error_code' => 'TIK',
							'error_desc' => 'Data Berhasil di import tapi st_feeder gagal diupdate di khs'
						);
						$this->Prc->setError($khs['ID'], $dataError);
		
						echo "Status : Success, Msg : Data Berhasil di import tapi st_feeder gagal diupdate di khs, NIM : ".$nim.", Periode: ".$tahun."<br><br>";
					}
				}
			}else{
				$dataError = array(
					'error_code' => 'TIK',
					'error_desc' => 'IPK bernilai 0 tidak dapat di import ke feeder'
				);
				$this->Prc->setError($khs['ID'], $dataError);

				echo "Status : error_feeder, Msg : IPK bernilai 0 tidak dapat di import ke feeder, NIM : ".$nim.", Periode: ".$tahun."<br><br>";
			}
		}

	}

	public function prc_khs()
	{
		$dataLama = $this->Prc->khsLama($this->input->post('fakultas'));
		$dataKhsLama = array();
		foreach ($dataLama as $show) {
			$data1 = array(
				 'NIM' => $show->NIM,
				 'Tahun' => $show->Tahun,
				 'Sesi' => $show->Sesi,
				 'Status' => $show->Status,
				 'Registrasi' => $show->Registrasi,
				 'TglRegistrasi' => $show->TglRegistrasi,
				 'Nilai' => $show->Nilai,
				 'GradeNilai' => $show->GradeNilai,
				 'Bobot' => $show->Bobot,
				 'SKS' => $show->SKS,
				 'MaxSKS' => $show->MaxSKS,
				 'MaxSKS2' => $show->MaxSKS2,
				 'IPS' => $show->IPS,
				 'SKSLulus' => $show->SKSLulus,
				 'IPK' => $show->IPK,
				 'TotalSKS' => $show->TotalSKS,
				 'TotalSKSLulus' => $show->TotalSKSLulus,
				 'TglUbah' => $show->TglUbah,
				 'CekUbah' => $show->CekUbah,
				 'NotActive' => $show->NotActive,
				 'st_feeder' => $show->st_feeder,
				 'st_val' => $show->st_val,
				 'tgl_val' => $show->tgl_val,
				 'stprc' => $show->stprc,
				 'st_abaikan' => $show->st_abaikan
		    );

		    array_push($dataKhsLama, $data1);			   
			   
		}
		//print_r($dataKhsLama);
		//echo $i;
		$i=1;
		foreach ($dataKhsLama as $show) {
			echo $i." ";
			print_r($show)." ";

			$data = array(
				'NIM' => $show['NIM'],
				 'Tahun' => $show['Tahun'],
				 'Sesi' => $show['Sesi'],
				 'Status' => $show['Status'],
				 'Registrasi' => $show['Registrasi'],
				 'TglRegistrasi' => $show['TglRegistrasi'],
				 'Nilai' => $show['Nilai'],
				 'GradeNilai' => $show['GradeNilai'],
				 'Bobot' => $show['Bobot'],
				 'SKS' => $show['SKS'],
				 'MaxSKS' => $show['MaxSKS'],
				 'MaxSKS2' => $show['MaxSKS2'],
				 'IPS' => $show['IPS'],
				 'SKSLulus' => $show['SKSLulus'],
				 'IPK' => $show['IPK'],
				 'TotalSKS' => $show['TotalSKS'],
				 'TotalSKSLulus' => $show['TotalSKSLulus'],
				 'TglUbah' => $show['TglUbah'],
				 'CekUbah' => $show['CekUbah'],
				 'NotActive' => $show['NotActive'],
				 'st_feeder' => $show['st_feeder'],
				 'st_val_ganti' => $show['st_val'],
				 'tgl_val' => $show['tgl_val'],
				 'stprc' => $show['stprc'],
				 'st_abaikan' => $show['st_abaikan'],
				 'cluster_siakad' => 'Cluster 1'
			);

			$cek_simpan=$this->Prc->addData1($data,'_v2_khs');
	        if($cek_simpan=='0'){
	        	echo "Tabel KHS Tidak ada";
	        	echo "<br>";
	        }elseif($cek_simpan){
	        	echo "Berhasil tersimpan di tabel KHS";
				$stPindah = $this->Prc->khsStPindah($show);
				if ($stPindah) {
					echo " update St_pindah <b>SUKSES</b>";
				}else {
					echo " update St_pindah <b style='color:red;'>GAGAL</b>";
				}
	        	echo "<br>";
	        }

	        
			echo "<br><br><br>";
			$i++;
		}
	}
}
