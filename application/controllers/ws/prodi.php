<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use RestServer\Libraries\REST_Controller;

class prodi extends REST_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('ws/prodi_model');
    }

    //=================== Ambil Data ============================

    public function index_get(){
        $KodeFakultas = $this->get('KodeFakultas');
        $Nama_Indonesia = $this->get('Nama_Indonesia');
        // $NotActive = $this->get('NotActive');
        // var_dump($Name);die;

        $data = $this->prodi_model->get_data($KodeFakultas,$Nama_Indonesia);
        if($data){
            $respon = array(
                'status' => true,
                'pesan' => 'Sukses',
                'data' => $data
            );
            $this->response($respon, REST_Controller::HTTP_OK);
        }else{
            $respon = array(
                'status' => false,
                'pesan' => 'data tidak ditemukan',
            );
            $this->response($respon, REST_Controller::HTTP_OK);
        }
    }
    
}


?>