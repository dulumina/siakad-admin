<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Mhs_inbound extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('security');
		$this->load->model('KrsPmmdn');
		$this->load->helper('url');

	}

	function index($periode='20211')
	{
		$data['mhs'] = $this->KrsPmmdn->inbound($periode='20211');
		$this->load->view('dashbord',$data);

	}

}

?>
