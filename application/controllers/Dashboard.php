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
      $data['countMhsinbon'] = $this->counter->mhswinbon();
      $data['countMhs'] = $this->counter->mhsw();
      $data['countMhsAktif'] = $this->counter->mhsw(['A']);
      $data['countMhsCuti'] = $this->counter->mhsw(['C']);
      $data['countMhsUnregist'] = $this->counter->mhsw(['U']);
      $data['countMhsKrs'] = $this->counter->mhswKrs($periode);
      $data['countMhsBayar'] = $this->counter->mhswBayar($periode);
      $data['countDosen'] = $this->counter->dosen();
      $data['countMK'] = $this->counter->matakuliah($periode);
      $data['periode'] = $periode;
      $_SESSION['card'][$periode] = $data;
      // $this->session->set_userdata('card',$data);
    }

    $this->load->view('temp/dashboard/card',$data);

  }
  
  function mhsInbound($periode=''){
    $data=[];
    if ($periode){
      $this->load->model('KrsPmmdn','mbkm');
      $data = $this->mbkm->inbound($periode);
    }
    echo json_encode($data);
    // echo $this->db->last_query();
  }

  function periodeFeeder(){
      
    if (isset($_SESSION['periodeLampau'])) {
      $data = $_SESSION['periodeLampau'];
    }else {
      $ulevel=$this->session->userdata('ulevel');
      if ( $ulevel == '4' || $ulevel == '10') {
        echo json_encode([]);
        exit(200);
      }
      $kf=$this->session->userdata('kdf');
      $kp=$this->session->userdata('kdj');
      
      if (isset($kp) && $kp!='') {
          $this->db->where('_v2_jurusan.kode',$kp);
      }elseif (isset($kf) && $kf!='') {
          $this->db->where('_v2_jurusan.KodeFakultas',$kf);
      }
      $this->db->where('_v2_jurusan.id_sms !=','');
      $id_prodi='';
      $id_ps = $this->db->select('id_sms')->get('_v2_jurusan')->result_array();
      for ($i=0; $i < count($id_ps); $i++) { 
        $val = $id_ps[$i]['id_sms'];
        if ($i == count($id_ps)-1) {
          $id_prodi .=" '$val' ";
        }else {
          $id_prodi .=" '$val', ";
        }
      }
      $filter = "id_program_studi in ($id_prodi)";
      $feeder = $this->load->model('FeederRunWS');
      $fdr = $this->FeederRunWS->get('GetPeriodeLampau',$filter);
      $data = $fdr->data;
      $_SESSION['periodeLampau'] = $data;
    }
    echo json_encode($data);
  }

}
