<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Krs_pmmdn extends CI_Controller {

	public $TahunPeriode;
	function __construct() {
		parent::__construct();
		// $this->load->library('form_validation');
    // $this->load->library('encryption');
    // $this->load->helper('security');
    // $this->load->model('additional_model');
	  $this->load->library('m_pdf');
		$this->load->model('KrsPmmdn','pmmdn');

    $this->app->cek_login();
	}
  
	public function index() {
		$totalSKS ='';
		$nim = $this->session->userdata('unip');
		if (isset($_SESSION['periode'])) {
			$this->TahunPeriode = $_SESSION['periode'];
			$totalSKS = $this->pmmdn->countSKS($nim,$this->TahunPeriode);
		};
		$data['totalSKS'] = $totalSKS;
		$profile = $this->pmmdn->getProfile($nim);
		$data['profile'] = $profile;
		$this->db->select('_v2_tahun.kode,_v2_tahun.nama');
		$this->db->group_by('_v2_tahun.kode');
		$this->db->where('_v2_jurusan.jenjang',$this->session->userdata('jenjang'));
		$data['tahun_semester'] = $this->app->getPeriodeKrsProdi();
		
		$this->db->select('_v2_jurusan.kode,_v2_jurusan.nama_indonesia nama');
		$this->db->group_by('_v2_jurusan.kode');
		$this->db->where('_v2_jurusan.jenjang',$this->session->userdata('jenjang'));
		$data['daftar_prodi'] = $this->app->getProdi();

		// echo json_encode($data['daftar_prodi']);exit;
		$this->load->view('dashbord',$data);
		$this->load->view('fikri.js/krs_pmmdn');

	}
  
	public function Tahun_semester($periode='')
	{
		if ($periode!='') {
			$this->db->select('_v2_bataskrs.*');
			if ($this->app->getPeriodeKrsProdi($periode,'',true)) {
				$_SESSION['periode']=$periode;
				$this->TahunPeriode=$periode;
			}else {
				unset($_SESSION['periode']);
			}
		}
		$this->index();
	}

	public function getKelasKuliah()
	{
		$prodi = $this->input->post('prodi');
		$periode = $this->input->post('periode');
		if ($prodi and $periode) {
			echo json_encode($this->app->getKelasPerkuliahan($prodi,$periode));
		}else {
			echo json_encode(null);
		}
	}

	public function addMkKrs()
	{
		$input = $this->input->post();
		if ($this->cekMaxSks($input['IDJADWAL'])) {
			$this->pmmdn->addMkKrs($input);
			$status="1";
			$msg="success";
		}else {
			$status="0";
			$msg="Gagal menambahkan MK, Total SKS melebihi batas yang ditentukan.";
		}

		$data = $this->getKrs(true);
		$data['status'] = $status;
		$data['msg'] = $msg;
		echo json_encode($data);
	}

	private function cekMaxSks($id_jadwal)
	{
		$nim = $this->session->userdata('unip');
		$totalSKS = $this->pmmdn->countSKS($nim,$_SESSION['periode']);

		$sksMK = $this->db->select("SKS")->get_where("_v2_jadwal",["IDJADWAL"=>$id_jadwal])->row()->SKS;
		
		return (((int)$totalSKS + (int)$sksMK) <= 21) ? true : false ;
	}

	public function getKrs($return=false)
	{ 
		$nim = $this->session->userdata('unip');
		$input = $this->input->post();
		$this->db->select("_v2_jadwal.NamaMK,_v2_jadwal.KodeRuang,_v2_jadwal.SKS,concat(_v2_hari.Nama,', ',_v2_jadwal.JamMulai,' s/d ',_v2_jadwal.JamSelesai) as waktu,_v2_jurusan.Nama_Indonesia prodi");
		$this->db->select("_v2_krsmbkm.id");
		$krs = $this->pmmdn->getKrs($input['nim'],$input['periode']);

		$data['krs'] = $krs;
		$data['totalSKS'] = (int)$this->pmmdn->countSKS($nim,$_SESSION['periode']);
		// $data['query'] = $this->db->last_query();
		if ($return) {
			return $data;
		}else {
			echo json_encode($data);
		}
	}

	public function tes()
	{
		$nim = $this->session->userdata('unip');
		// echo json_encode((int)$this->pmmdn->countSKS($nim,'20211'));
		echo json_encode($this->cekMaxSks('C20120211C21201008REGDM4'));
		// $prodi = $this->input->post('prodi');
		// echo json_encode($_SESSION);

		// $this->db->select('_v2_jurusan.kode,_v2_jurusan.nama_indonesia nama');
		// $this->db->group_by('_v2_jurusan.kode');
		// echo json_encode($this->app->getPeriodeKrsProdi());
		
		// $this->app->getPeriodeKrsProdi();
		// echo $this->db->last_query();

		
		// echo json_encode($this->app->getKelasPerkuliahan($prodi,$_SESSION['periode']));
	}

}