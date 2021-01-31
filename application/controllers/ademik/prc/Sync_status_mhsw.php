<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sync_status_mhsw extends CI_Controller
{

  private $page = 'ademik/sync_status_mhsw';
  private $smstr = '';
	function __construct() {
    parent::__construct();
    $this->load->library('encryption');
    $this->load->library('Feeder_untad');
    date_default_timezone_set("Asia/Makassar");
  }
  private function render_view($data=[],$js=false)
  {
    $this->load->view('temp/head');
    $this->load->view($this->page,$data);
    $this->load->view('temp/footers');
    if ($js) {
      $this->load->view($this->page.'_js');
    }
  }

  public function index()
  {
    $data['status'] = $this->db->query("SELECT status_siakad, COUNT(nim) jumlah FROM mhs_selisih_feeder where prc='0' GROUP BY status_siakad")->result();
    $data['on_siakad'] = $this->db->query("SELECT on_siakad, COUNT(nim) jumlah FROM mhs_selisih_feeder GROUP BY on_siakad")->result();
    $data['jenisKeluar'] = $this->feeder_untad->get('GetJenisKeluar',"apa_mahasiswa= '1'")->data;
    $this->render_view($data,true);
  }

  public function getListMhsw($st='')
  {
    if ($this->input->post('st')) {
      $sta = $this->input->post('st');
    }
    if ($st) {
      $sta = $st;
    }
    $select = "mhs_selisih_feeder.*,NomorSKYudisium,TglSKYudisium,ipk,NomerIjazah,JudulTA";
    $where = "mhs_selisih_feeder.status_siakad='$sta' and mhs_selisih_feeder.prc=0 and id_reg !='0'";
    $res = $this->db->query("SELECT $select FROM mhs_selisih_feeder INNER JOIN _v2_mhsw on mhs_selisih_feeder.nim=_v2_mhsw.nim where $where limit 1000")->result();
    // $i=0;
    // foreach ($res as $row) {
    //   $res[$i]->id_registrasi_mahasiswa= $this->getHistoryPendidikan($row->nim);
    //   $i++;
    // }
    echo json_encode($res);
  }

  public function prosesMhsw()
  {
    $return['sia']=0;
    $nim = $this->input->post('nim');
    $record = $this->input->post();
    unset($record['nim']);
    $res = $this->feeder_untad->insert('InsertMahasiswaLulusDO',$record);
    if ($res->error_code==0) {
      $this->db->set('prc','1')->where('nim',$nim)->update('mhs_selisih_feeder');
      // $this->db->set('status',1)->where('nim',)->update('_v2_mhsw');
      $return['sia']=1;
    }
    $return['fdr']=$res;
    echo json_encode($return);
  }

  private function getHistoryPendidikan($nim='')
  {
    // $nim = $this->input->post('nim');
    $res = $this->feeder_untad->get('GetListRiwayatPendidikanMahasiswa',"nim like '%$nim%'");
    // echo json_encode($res->data);
    return $res->data[0]->id_registrasi_mahasiswa;
  }

  public function getCodeFeeder()
  {
    $data = $this->db->query("SELECT id,nim FROM mhs_selisih_feeder where (id_reg='0' or id_reg='' ) limit 1000")->result();
    $i=0;
    foreach ($data as $row) {
      echo ($i+1).' = ';
      echo json_encode($row);
      $nim = $row->nim;
      $res = $this->feeder_untad->get('GetListRiwayatPendidikanMahasiswa',"nim like '%$nim%'");
      $set = array(
        'id_pd' => $res->data[0]->id_mahasiswa,
        'id_reg' => $res->data[0]->id_registrasi_mahasiswa
      );
      echo " | ";
      $r = $this->db->set($set)->where('id',$row->id)->update('mhs_selisih_feeder');
      echo json_encode($r);
      echo "<br>";
      $i++;
    }
  }
}
