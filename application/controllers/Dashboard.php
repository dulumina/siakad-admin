<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Dashboard extends CI_Controller {
  
	function __construct() {
    parent::__construct();
    $this->load->library('encryption');
    $this->load->library('Counter');
    $this->load->model('App');
    // $this->load->helper('fikri');
  }

  function card($periode='20201'){
    if (isset($_SESSION['card'][$periode])) {
      $data = $_SESSION['card'][$periode];
    }else {
      $data['countMhs'] = $this->counter->mhsw();
      $data['countMhsAktif'] = $this->counter->mhsw(['A']);
      $data['countMhsCuti'] = $this->counter->mhsw(['C']);
      $data['countMhsUnregist'] = $this->counter->mhsw(['U']);
      $data['countMhsKrs'] = $this->counter->mhswKrs($periode);
      $data['countMhsBayar'] = $this->counter->mhswBayar($periode);
      $data['periode'] = $periode;
      $_SESSION['card'][$periode] = $data;
      // $this->session->set_userdata('card',$data);
    }

    $this->load->view('temp/dashboard/card',$data);

  }
  
  function mhsInbound($periode=''){
    $this->load->model('KrsPmmdn','mbkm');
    echo json_encode($this->mbkm->inbound($periode));
    // echo $this->db->last_query();
  }
}
