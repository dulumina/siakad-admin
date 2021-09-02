<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'libraries\Requests.php';

class GetJadwalMipa extends CI_Controller
{
  
  public $http;
  public $periode;
  public $url;
	function __construct() {
    parent::__construct();
    date_default_timezone_set("Asia/Makassar");
    $this->http = Requests::register_autoloader();
    $this->url = "https://silamipa.untad.ac.id:8443/semuy/api/jadwaldgasvYUFYWvshxytscdvywe.jsp?smt=";
    $this->periode = "20211";
    // $this->load->library('requests');
  }

  public function index()
  {
    $headers = [];
    $options = [];
    $request = Requests::get($this->url.$this->periode, $headers, $options);
    $data = json_decode($request->body);
    $this->db->insert_batch('jadwal_mipa',$data);
    echo $request->body;

  }


}
