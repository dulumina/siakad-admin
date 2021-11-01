<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;


class Mahasiswa extends REST_Controller
{
    public $fields = ["id_pd", "id_reg_pd", "NIM", "Name", "Email", "Sex", "TempatLahir", "TglLahir", "Alamat", "Dusun", "Kelurahan", "Kecamatan", "RT", "RW", "Kota", "Provinsi", "KodePos", "HP", "Phone", "NIK", "NPWP", "AgamaID", "Suku", "Kewarganegaraan", "JenisTinggal", "AlatTransportasi", "penerimaKPS", "nomorKPS", "NamaOT", "NamaIbu", "NamaWali", "PekerjaanOT", "HslAyah", "PekerjaanIbu", "HslIbu", "PekerjaanW", "HslW", "PendidikanOT", "PendidikanIbu", "PendidikanW", "AlamatOT1", "AlamatOT2", "AlamatW1", "AlamatW2", "RTOT", "RTW", "RWOT", "RWW", "KotaOT", "KotaW", "KodeTelpOT", "TelpOT", "TelpW", "EmailOT", "EmailW", "KodePosOT", "KodePosW", "KodeFakultas", "KodeJurusan", "Status", "TahunStatus", "KodeProgram", "StatusAwal", "UniversitasAsal", "ProdiAsal", "SKSditerima", "Semester", "TahunAkademik"];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ws/Mahasiswa_model', 'mahasiswa');
    }

    public function index_get()
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
        if (count($this->post_check())!=0) {
            // print_r($this->post_check());
            // die;
            $this->response([
                'status' => FALSE,
                'message' => $this->post_check()
            ], REST_Controller::HTTP_NOT_FOUND);
        }else {

            $data=[];
            foreach ($this->fields as $field) {
                $data[$field] = $this->post($field);
            }
            /*
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
            */
    
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

    private function post_check()
    {
        // $this->CI =& get_instance();

        $this->load->library('form_validation');

        $config = array(
            array(
                    'field' => 'NIM',
                    'label' => 'NIM',
                    'rules' => 'required',
                    'errors' => array(
                            'required' => 'Anda harus mengisi kolom %s.',
                    ),
            ),
            array(
                    'field' => 'Name',
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => array(
                            'required' => 'Anda harus mengisi kolom %s.',
                    ),
            ),
            array(
                    'field' => 'KodeFakultas',
                    'label' => 'Kode Fakultas',
                    'rules' => 'required',
                    'errors' => array(
                            'required' => 'Anda harus mengisi kolom %s.',
                    ),
            ),
            array(
                    'field' => 'KodeJurusan',
                    'label' => 'Kode jurusan',
                    'rules' => 'required',
                    'errors' => array(
                            'required' => 'Anda harus mengisi kolom %s.',
                    ),
            ),
            array(
                    'field' => 'KodeProgram',
                    'label' => 'Kode program',
                    'rules' => 'required',
                    'errors' => array(
                            'required' => 'Anda harus mengisi kolom %s.',
                    ),
            ),
            array(
                    'field' => 'StatusAwal',
                    'label' => 'Status awal',
                    'rules' => 'required',
                    'errors' => array(
                            'required' => 'Anda harus mengisi kolom %s.',
                    ),
            ),
            array(
                    'field' => 'Semester',
                    'label' => 'Semester/periode awal masuk',
                    'rules' => 'required',
                    'errors' => array(
                            'required' => 'Anda harus mengisi kolom %s.',
                    ),
            ),
            array(
                    'field' => 'TahunAkademik',
                    'label' => 'Tahun akademik/angkatan',
                    'rules' => 'required',
                    'errors' => array(
                            'required' => 'Anda harus mengisi kolom %s.',
                    ),
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE)
        {
            return $this->form_validation->error_array();
        }else {
            return false;
        }
    }
}

/* End of file Controllername.php */
