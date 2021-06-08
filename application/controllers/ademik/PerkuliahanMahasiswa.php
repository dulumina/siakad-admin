<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PerkuliahanMahasiswa extends CI_Controller 
{
  
	function __construct(){
		parent::__construct();
  }

  public function index()
  {
		$data['tab'] = $this->app->all_val('groupmodul')->result();
		$this->load->view('dashbord',$data);
  }
}
