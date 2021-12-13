<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Prasyaratmk extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->helper('security');
		$this->load->model('prasyartmk_model');
	}

	public function index()
	{
		$a['uri'] = $this->uri->segment(3);
		$a['data'] = $this->getDataTabelMK();
		$a['syarat'] = [];
		$this->load->view('dashbord', $a);
	}

	// public function daftar($id = '')
	// {
	// 	$a['uri'] = $this->uri->segment(3);
	// 	$a['data'] = $this->getDataTabelMK();
	// 	$a['syarat'] = $this->getsyarat($id);

	// 	$this->load->view('dashbord', $a);
	// }

	// Get Matakuliah berdasarkan hak akses
	private function getDataTabelMK()
	{

		// $userLogin = $this->session->userdata('uname');
		$level = $this->session->userdata('ulevel');
		$kdf = $this->session->userdata('kdf');
		$kdj = $this->session->userdata('kdj');
		// $user = $this->getUserKode();

		// Jika Super Admin
		if ($level == 1) {
			// Get Mk Semua Syarat 
			$listmks = $this->prasyartmk_model->getmkssup();
			return $listmks;
		} elseif ($level == 5) {
			// Jika dia admin Fakultas
			// Get MK Berdasarkan Kdf
			$listmks = $this->prasyartmk_model->getmksfak($kdf);
			return $listmks;
		} elseif ($level == 7) {
			// Jika dia admin Jurusan
			// Get MK Berdasarkan Kdj
			$listmks = $this->prasyartmk_model->getmksjur($kdj);
			return $listmks;
		} else {
			// Jika Bukan Super Admin, Admin Jurusan dan Admin Fakultas
			// Tampilkan Error
			echo "Jangan Akses Sembarang Nyettt..";
		}
	}

	// Get Nama Matakuliah untuk modal Tambah Syarat MK
	public function getmk()
	{
		$level = $this->session->userdata('ulevel');
		$kdf = $this->session->userdata('kdf');
		$kdj = $this->session->userdata('kdj');

		$data = $this->input->post('data');
		$respon = $this->prasyartmk_model->getmk($data);
		$namamk = array();
		foreach ($respon as $mk) {
			$namamk[] = array(
				'id' => $mk->Kode,
				// 'text' => $mk->IDMK,
				'text' => $mk->Nama,
			);
		}
		echo json_encode($namamk);
	}

	// Tambah Syarat Matakuliah
	public function add()
	{
		$kode = $this->input->post('snmk');
		$getkode = $this->prasyartmk_model->kode($kode);
		$praid = $getkode['IDMK'];
		$data = array(
			'IDMK' => $this->input->post('kodemakul'),
			'KodeMk' => $this->input->post('idmakul'),
			'PraID' => $this->input->post('snmk'),
			'PraKodeMK' => $praid,
			'NotActive' => $this->input->post('status')
		);
		$this->prasyartmk_model->add($data);
	}

	// Update status
	public function update()
	{
		// $data = array(
		// 	'IDMK' => $this->input->post('IDMK'),
		// 	'PraID' => $this->input->post('PraID'),
		// 	'NotActive' => $this->input->post('NotActive')
		// );
		// print_r($data);
		// die;
		$IDMK = $this->input->post('IDMK');
		$PraID = $this->input->post('PraID');
		$NotActive = $this->input->post('NotActive');
		if ($NotActive == 'N') {
			$NotActive = 'Y';
		} else {
			$NotActive = 'N';
		}
		$this->prasyartmk_model->update($IDMK, $PraID, $NotActive);
	}

	// Get data syarat Matakuliah yang di pilih
	public function getdetail()
	{
		$id = $this->input->post('id');
		$data = $this->prasyartmk_model->getsyarat($id);
		// print_r($data);
		// die;
		$string['mk'] = "";
		$no = 1;
		$status = "";
		foreach ($data as $mks) {
			if ($mks->NotActive == 'N') {
				$status = 'Aktif';
				$string['mk'] .= "<tr>
							<td>" . $no++ . "</td>
							<td>" . $mks->PraID . "</td>
							<td>" . $mks->Nama_Indonesia . "</td>							
							<td>" . $status . "</td>						
							<td>
							" . "
								<a type='button' class='btn btn-xs btn-danger' onClick='update(`$mks->PraID`, `$mks->NotActive`)' ><i class='fa fa-pencil'> NonAktif</i></a>
							" . "
							</td>
						</tr>";
			} else {
				$status = 'Tidak Aktif';
				$string['mk'] .= "<tr>
							<td>" . $no++ . "</td>
							<td>" . $mks->PraID . "</td>
							<td>" . $mks->Nama_Indonesia . "</td>							
							<td>" . $status . "</td>						
							<td>
							" . "
								<a type='button' class='btn btn-xs btn-primary' onClick='update(`$mks->PraID`, `$mks->NotActive`)' ><i class='fa fa-pencil'> Aktifkan</i></a>
							" . "
							</td>
						</tr>";
			}


			$string['id'] = $mks->ID;
			$string['kode'] = $mks->KodeMK;
		}
		echo json_encode($string);
	}
}
