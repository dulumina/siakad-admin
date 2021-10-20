<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Mahasiswa extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ws/Mahasiswa_model', 'mahasiswa');
    }

    public function index_get()
    {
        $this->response([
            'status' => TRUE
        ], REST_Controller::HTTP_OK);
    }

    //fungsi memanggil data
    public function list_get()
    {
        $nim = $this->get('NIM');
        
        if ($nim === null) {
            $mahasiswa = $this->mahasiswa->getMahasiswa();
        } else {
            $mahasiswa = $this->mahasiswa->getMahasiswa($nim);
        }

        if ($mahasiswa) {
            $this->response([
                'status' => TRUE,
                'data' => $mahasiswa
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Dd Not Found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //fungsi menghapus data
    public function index_delete()
    {
        $nim = $this->delete('NIM');

        if ($nim === null) {
            $this->response([
                'status' => FALSE,
                'message' => 'Provide an Stambuk!'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mahasiswa->deleteMahasiswa($nim) > 0) {
                //Berhasil Menghapus
                $this->response([
                    'status' => TRUE,
                    'NIM' => $nim,
                    'message' => 'Delete Success..'
                ], REST_Controller::HTTP_OK);
            } else {
                //Stambuk Not Found
                $this->response([
                    'status' => FALSE,
                    'message' => 'Stambuk Not Found!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    //fungsi menambahkan data
    public function index_post()
    {
        $data = [
            'ID' => $this->post('ID'),
            'NIM' => $this->post('NIM'),
            'Name' => $this->post('Name'),
            'Email' => $this->post('Email'),
            'Alamat' => $this->post('Alamat'),
            'Phone' => $this->post('Phone'),
            'KodeFakultas' => $this->post('KodeFakultas'),
            'KodeJurusan' => $this->post('KodeJurusan'),
            'Status' => $this->post('Status'),
            'DosenID' => $this->post('DosenID')
        ];
        if ($this->mahasiswa->createMahasiswa($data) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'Create Mahasiswa Success..'
            ], REST_Controller::HTTP_CREATED);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Create Mahasiswa Failed!'
            ], REST_Controller::HTTP_EXPECTATION_FAILED);
        }
    }

    //fungsi rubah data
    public function index_put()
    {
        $nim = $this->put('NIM');
        $data = [
            'ID' => $this->put('ID'),
            'NIM' => $this->put('NIM'),
            'Name' => $this->put('Name'),
            'Email' => $this->put('Email'),
            'Alamat' => $this->put('Alamat'),
            'Phone' => $this->put('Phone'),
            'KodeFakultas' => $this->put('KodeFakultas'),
            'KodeJurusan' => $this->put('KodeJurusan'),
            'Status' => $this->put('Status'),
            'DosenID' => $this->put('DosenID')
        ];
        if ($this->mahasiswa->updateMahasiswa($data, $nim) > 0) {
            $this->response([
                'status' => TRUE,
                'message' => 'Updated Mahasiswa Success..'
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => FALSE,
                'message' => 'Updated Mahasiswa Failed!'
            ], REST_Controller::HTTP_EXPECTATION_FAILED);
        }
    }
}

/* End of file Controllername.php */
