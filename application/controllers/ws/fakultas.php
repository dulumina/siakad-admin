<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use RestServer\Libraries\REST_Controller;

class Fakultas extends REST_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('ws/Fakultas_model');
    }

    //=================== Ambil Data ============================

    public function index_get(){
        // $Kode = $this->get('Kode');
        // $Nama_Indonesia = $this->get('Nama_Indonesia');
        // var_dump($Name);die;

        // $data = $this->fakultas_model->get_data($Kode,$Nama_Indonesia);
        $data = $this->fakultas_model->get_data();
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

     // ======================= Input Data ================================
        
     public function Index_Post(){
        $Kode = $this->post('Kode');
        $Nama_Indonesia = $this->post('Nama_Indonesia');
        $Nama_English = $this->post('Nama_English');
        $Singkatan = $this->post('Singkatan');        
        $dekan = $this->post('dekan');
        $nipdekan = $this->post('nipdekan');


        $data = array(
            'Kode' => $Kode,
            'Nama_Indonesia' => $Nama_Indonesia,
            'Nama_English' => $Nama_English,
            'Singkatan' => $Singkatan,
            'dekan' => $dekan,
            'nipdekan' => $nipdekan
        );

        $affected_rows = $this->fakultas_model->input_data($data);
        if($affected_rows > 0 ){
            $respons = array(
                'status' => true,
                'pesan' => 'Sukses',
                'data' => $data
            );
            $this->response($respons, REST_Controller::HTTP_OK);
        }else{
            $respons = array(
                'status' => false,
                'pesan' => 'data tidak ditemukan',
            );
            $this->response($respons, REST_Controller::HTTP_OK);
        }
    }

    
}


?>