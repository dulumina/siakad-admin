<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Krs_pmmdn extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
    $this->load->library('encryption');
    $this->load->helper('security');
    $this->load->model('additional_model');
    $this->app->cek_login();
	}
  
	public function index() {
    
		$data=[];

		$this->load->view('dashbord',$data);

	}
  

}