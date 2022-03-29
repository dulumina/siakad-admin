<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use RestServer\Libraries\REST_Controller;

class Prodi extends REST_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('ws/Prodi_model');
    }

    //=================== Ambil Data ============================

    public function Index_Get(){
        $KodeFakultas = $this->get('KodeFakultas');
        $Nama_Indonesia = $this->get('Nama_Indonesia');
        // print_r($KodeFakultas); die;
        // $NotActive = $this->get('NotActive');
        // var_dump($Name);die;

        $data = $this->Prodi_model->Get_data($KodeFakultas,$Nama_Indonesia);
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