<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use RestServer\Libraries\REST_Controller;

class Krs extends REST_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('ws/krs_model');
  }

  public function index_get()
  {
    $data = $this->krs_model->get_data();
    if ($data) {
      $respon = array(
        'status' => true,
        'pesan' => 'Sukses',
        'data' => $data
      );
      $this->response($respon, REST_Controller::HTTP_OK);
    } else {
      $respon = array(
        'status' => false,
        'pesan' => 'data tidak ditemukan',
      );
      $this->response($respon, REST_Controller::HTTP_OK);
    }
  }

  public function fak_get()
  {
    $fakultas = $this->get('fakultas');
    $data = $this->krs_model->get_fak($fakultas);
    if ($data) {
      $respon = array(
        'status' => true,
        'pesan' => 'Sukses',
        'data' => $data
      );
      $this->response($respon, REST_Controller::HTTP_OK);
    } else {
      $respon = array(
        'status' => false,
        'pesan' => 'data tidak ditemukan',
      );
      $this->response($respon, REST_Controller::HTTP_OK);
    }
  }

  public function prodi_get()
  {
    $fakultas = $this->get('fakultas');
    $prodi = $this->get('prodi');
    $data = $this->krs_model->get_prodi($fakultas, $prodi);
    if ($data) {
      $respon = array(
        'status' => true,
        'pesan' => 'Sukses',
        'data' => $data
      );
      $this->response($respon, REST_Controller::HTTP_OK);
    } else {
      $respon = array(
        'status' => false,
        'pesan' => 'data tidak ditemukan',
      );
      $this->response($respon, REST_Controller::HTTP_OK);
    }
  }
}
