<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prckrs_feeder extends CI_Controller {


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
	
	public function import_krs_feeder_all(){
		$dataKRS = $this->Prc->getAllKRS($this->input->post('tahun'), $this->input->post('fakultas'));

		$dataKrsBaru = array();
		foreach ($dataKRS as $show) {
			$data1 = array(
				'ID' => $show->ID,
				'NIM' => $show->NIM,
				'Tahun' => $show->Tahun,
				'st_feeder' => $show->st_feeder,
				'enkripsi' => $show->enkripsi,
		    );

		    array_push($dataKrsBaru, $data1);
		}

		foreach ($dataKrsBaru as $krs) {
			$thn = $this->input->post('tahun');
	
			$feeder = $this->feeder->getToken_feeder();
			$temp_token = $feeder['temp_token'];
			$temp_proxy = $feeder['temp_proxy'];
	
			$ID_KRS=$krs['ID'];
			$tbl = "_v2_krs$thn";
			
			$qKrsFeeder=$this->krs_model->get_krs_feeder($tbl, $ID_KRS);
	
			foreach ($qKrsFeeder as $show) {
				if($krs['enkripsi'] != "") {
					$nil_ang = $show->nilai_angka;
					$nil_huruf = $show->nilai_huruf;
					$nil_indeks = $show->nilai_indeks;
				} else {
					$nil_ang = 0;
					$nil_huruf = '';
					$nil_indeks = 0.00;
				}

				$IDKRS = $show->IDKRS;
				$id_kls = $show->id_kls;
				$id_reg_pd = $show->id_reg_pd;
				$NIM = $show->NIM;
				$nil_ang = $nil_ang;
				$nil_huruf = $nil_huruf;
				$nil_indeks = $nil_indeks;
				$kode_mk = $show->KodeMK;
				$idjadwal = $show->IDJADWAL;
				$tahun = $show->Tahun;
				$nilai_huruf = $show->nilai_huruf;
				$kodefakultas = $show->KodeFakultas;
	
				/*$dataEncrypt = $this->encryption->encrypt($NIM."|".$kode_mk."|".$tahun."|".$nilai_huruf);
				$encrypt=$this->krs_model->create_encrypt($dataEncrypt,$IDKRS,$tbl);
	
				if($encrypt==true){
					echo $dataEncrypt;
				}*/
	
				if($tahun >= 20182 AND ($kodefakultas == "A" OR $kodefakultas == "F" OR $kodefakultas == "H")){
				$record = new stdClass();
					$record->id_kls= $id_kls;
					$record->id_reg_pd= $id_reg_pd;
					$record->asal_data="9";
					$record->nilai_angka=$nil_ang;
					$record->nilai_huruf=$nil_huruf;
					$record->nilai_indeks=$nil_indeks;
	
					$table = 'nilai';
	
					// action insert ke feeder
					$action = 'InsertRecord';
	
					// insert tabel mahasiswa ke feeder
					$datb = $this->feeder->action_feeder($temp_token,$temp_proxy,$action,$table,$record);
	
					//$datb = $resultb['result'];
	
					$error_code = $datb['error_code'];
					$error_desc = $datb['error_desc'];
	
					if($error_code == 0){
						$sql = $this->krs_model->updateKrsFeeder($IDKRS, $tbl, "3");
						if($sql){
							echo "Data Berhasil di insert feeder <br />".$krs['NIM']." ".$ID_KRS;
						}else{
							echo "Data Gagal di input <br />".$krs['NIM']." ".$ID_KRS;
						}
					}else if($error_code == 800 or $error_code == 103){
						$recordup = array(
							'key' => array('id_kls' => $id_kls,'id_reg_pd' => $id_reg_pd),
							'data' => array('asal_data' => "9",'nilai_angka' => $nil_ang,'nilai_huruf' => $nil_huruf,'nilai_indeks' => $nil_indeks)
						);
	
						$table = 'nilai';
	
						// action insert ke feeder
						$action = 'UpdateRecord';
	
						// insert tabel mahasiswa ke feeder
						$datarec = $this->feeder->action_feeder($temp_token,$temp_proxy,$action,$table,$recordup);
	
	
						//$datarec = $resultup['result'];
	
						$error_code1 = $datarec['error_code'];
						$error_desc1 = $datarec['error_desc'];
	
						if($error_code1 == 0){
							$sql = $this->krs_model->updateKrsFeeder($IDKRS, $tbl, "4");
							if($sql){
								echo "Data Berhasil di update feeder <br />".$krs['NIM']." ".$ID_KRS;
							}else{
								echo "Data Gagal di input <br />".$krs['NIM']." ".$ID_KRS;
							}
						}else{
							echo "Data Gagal Update ".$error_code1." ".$error_desc1."<br />".$krs['NIM']." ".$ID_KRS;
						}
	
	
					}else{
						$sql = $this->krs_model->updateKrsFeeder($IDKRS, $tbl, "-3");
						if($sql){
							
							echo "Proses Gagal ".$error_code." ".$error_desc."<br />".$krs['NIM']." ".$ID_KRS;
						}else{
							echo "Data Gagal di input <br />".$krs['NIM']." ".$ID_KRS;
						}
					}
				}else{
					$getEncrypt = $this->krs_model->get_encrypt($IDKRS,$tbl);
					$krsEncrypt = $getEncrypt->enkripsi;
					$dataDecrypt = $this->encryption->decrypt($krsEncrypt);
	
					//echo $krsEncrypt."<br>";
					//echo $dataDecrypt."<br>";
					$decrypt=explode('|', $dataDecrypt);
					//echo $decrypt[0].$decrypt[1].$decrypt[2].$decrypt[3]."<br>";
	
					if($decrypt[0]==$NIM AND $decrypt[1]==$idjadwal AND $decrypt[2]==$tahun AND $decrypt[3]==$nilai_huruf AND $decrypt[4]==$nil_indeks){
						if($tahun >= 20182){
							$msgDecrypt = "Data Benar"."<br>";
							$encrypt = $this->encryption->encrypt($decrypt[0]."|".$decrypt[1]."|".$decrypt[2]."|".$decrypt[3]."|".$decrypt[4]);
	
							$this->krs_model->save_encrypt($NIM,$thn,$kode_mk,$encrypt,$tbl);
						}
						
						$record = new stdClass();
						$record->id_kls= $id_kls;
						$record->id_reg_pd= $id_reg_pd;
						$record->asal_data="9";
						$record->nilai_angka=$nil_ang;
						$record->nilai_huruf=$nil_huruf;
						$record->nilai_indeks=$nil_indeks;
	
						$table = 'nilai';
	
						// action insert ke feeder
						$action = 'InsertRecord';
	
						// insert tabel mahasiswa ke feeder
						$datb = $this->feeder->action_feeder($temp_token,$temp_proxy,$action,$table,$record);
	
						//$datb = $resultb['result'];
	
						$error_code = $datb['error_code'];
						$error_desc = $datb['error_desc'];
	
						if($error_code == 0){
							$sql = $this->krs_model->updateKrsFeeder($IDKRS, $tbl, "3");
							if($sql){
								echo "Data Berhasil di insert feeder <br />".$krs['NIM']." ".$ID_KRS;
							}else{
								echo "Data Gagal di input <br />".$krs['NIM']." ".$ID_KRS;
							}
						}else if($error_code == 800 or $error_code == 103){
							$recordup = array(
								'key' => array('id_kls' => $id_kls,'id_reg_pd' => $id_reg_pd),
								'data' => array('asal_data' => "9",'nilai_angka' => $nil_ang,'nilai_huruf' => $nil_huruf,'nilai_indeks' => $nil_indeks)
							);
	
							$table = 'nilai';
	
							// action insert ke feeder
							$action = 'UpdateRecord';
	
							// insert tabel mahasiswa ke feeder
							$datarec = $this->feeder->action_feeder($temp_token,$temp_proxy,$action,$table,$recordup);
	
	
							//$datarec = $resultup['result'];
	
							$error_code1 = $datarec['error_code'];
							$error_desc1 = $datarec['error_desc'];
	
							if($error_code1 == 0){
								$sql = $this->krs_model->updateKrsFeeder($IDKRS, $tbl, "4");
								if($sql){
									echo "Data Berhasil di update feeder <br />".$krs['NIM']." ".$ID_KRS;
								}else{
									echo "Data Gagal di input <br />".$krs['NIM']." ".$ID_KRS;
								}
							}else{
								echo "Data Gagal Update ".$error_code1." ".$error_desc1."<br />".$krs['NIM']." ".$ID_KRS;
							}
						}else{
							$sql = $this->krs_model->updateKrsFeeder($IDKRS, $tbl, "-3");
							if($sql){
							
								echo "Proses Gagal ".$error_code." ".$error_desc."<br />".$krs['NIM']." ".$ID_KRS;
							}else{
								echo "Data Gagal di input <br />".$krs['NIM']." ".$ID_KRS;
							}
						}
					}else{
						//$data['msgDecrypt'] = "Data bermasalah hubungi UPT TIK";
						//$encrypt = "Data bermasalah";
						echo "Data bermasalah hubungi UPT TIK <br />".$krs['NIM']." ".$ID_KRS;
					}
				}
	
				
	
				//echo $msgDecrypt.$encrypt;
	
				/**/
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
