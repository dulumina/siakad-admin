<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use RestServer\Libraries\REST_Controller;

class dosen extends REST_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('dosen_model');
    }

    public function index_get(){
        $KodeFakultas = $this->get('KodeFakultas');
        $KodeJurusan = $this->get('KodeJurusan');
        $nip = $this->get('nip');
        $NIDN_NUP_NIDK = $this->get('NIDN_NUP_NIDK');
        // var_dump($Name);die;

        $data = $this->dosen_model->get_data($KodeFakultas,$KodeJurusan,$nip,$NIDN_NUP_NIDK);
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
    // =======================================================
        
       /* $data = $this->api_model->get_data();
        if($data->num_rows() > 0){
            $respon = array(
                'status' => true,
                'pesan' => 'Sukses',
                'data' => $data->result()
            );
            $this->response($respon, REST_Controller::HTTP_OK);
        }else{
            $respon = array(
                'status' => false,
                'pesan' => 'data tidak ditemukan',
                'data' => []
            );
            $this->response($respon, REST_Controller::HTTP_OK);
        }*/
    }
}


?>