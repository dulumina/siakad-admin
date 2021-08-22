<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Krs_pmmdn extends CI_Controller {

	public $TahunPeriode;
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
    $this->load->library('encryption');
    $this->load->helper('security');
    $this->load->model('additional_model');
    $this->app->cek_login();
	}
  
	public function index() {
		
		if (isset($_SESSION['periode'])) {
			$this->TahunPeriode = $_SESSION['periode'];
		};

		
		$this->db->select('_v2_tahun.kode,_v2_tahun.nama');
		$this->db->group_by('_v2_tahun.kode');
		$this->db->where('_v2_jurusan.jenjang',$this->session->userdata('jenjang'));
		$data['tahun_semester'] = $this->app->getPeriodeKrsProdi();
		
		$this->db->select('_v2_jurusan.kode,_v2_jurusan.nama_indonesia nama');
		$this->db->group_by('_v2_jurusan.kode');
		$this->db->where('_v2_jurusan.jenjang',$this->session->userdata('jenjang'));
		$data['daftar_prodi'] = $this->app->getPeriodeKrsProdi();

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

	public function tes()
	{
		echo json_encode($_SESSION);

		// $this->db->select('_v2_jurusan.kode,_v2_jurusan.nama_indonesia nama');
		// $this->db->group_by('_v2_jurusan.kode');
		// echo json_encode($this->app->getPeriodeKrsProdi());
	}

}