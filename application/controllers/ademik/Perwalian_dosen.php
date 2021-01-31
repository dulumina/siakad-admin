<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');

class Perwalian_dosen extends CI_Controller {

  private $page = "ademik/perwalian_dosen";
  private $smstr = '';

	function __construct(){
    parent::__construct();
    $this->load->model('Perwalian_admin_model');
    $this->load->helper('addtional');
    $this->load->library('counter'); 
    $this->smstr = semester_aktif();
    if (isset($_SESSION['tahunPeriode'])) {
      $this->smstr = $this->session->userdata('tahunPeriode');
    }
  }

  public function index()
  {
    // $this->smstr = '20201';
    $data['listMhsw'] = $this->Perwalian_admin_model->getMhsw($this->smstr);
    $data['tahun']=$this->smstr;
    $data['periode'] = $this->getPeriode();
    $this->render_view($data,true);
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

  public function listMk($nim)
  {
    // $this->smstr = '20201';
    $krs = $this->db->select('id,KodeMK,NamaMK,SKS,st_wali')
                    ->where('nim',$nim)
                    ->get('_v2_krs'.$this->smstr)
                    ->result();
    echo json_encode($krs);
  }

  function dataSource()
  {
    // $this->smstr = '20201';
    $data = $this->Perwalian_admin_model->getMhsw($this->smstr);
    echo json_encode($data);
  }
  public function getPeriode()
  {
    $jur = $this->session->userdata("kdj");
    $periode = $this->db->select("Kode,Nama,(case when Kode=$this->smstr then 'selected' else '' end) selected")
            ->join('_v2_bataskrs','_v2_bataskrs.Tahun=Kode and _v2_bataskrs.KodeJurusan=_v2_tahun.KodeJurusan','inner')
            ->where(['_v2_tahun.KodeJurusan'=>$jur])
            ->where('ukrss >= now()')
            ->order_by('Kode','DESC')
            ->limit('10')
            ->get('_v2_tahun')
            ->result();

    return $periode;
  }
  public function setPeriode()
  {
    $periode = $this->input->post('periode');
    $jur = $this->session->userdata("kdj");
    $tahun = $this->db->get_where('_v2_tahun',['Kode'=>$periode,'KodeJurusan'=>$jur]);

    if ($tahun->num_rows()==1) {
      $this->session->set_userdata('tahunPeriode',$periode);
    }
    // header("Refresh:0");
  }
  function setSetujui(){
    // if (!$this->input->post('id') || !$this->input->post('st_wali')) {
    //   exit('403');
    //   return false;
    // }
    // $this->smstr = '20201';
    
    $this->db->set('st_wali',$this->input->post('st_wali'))
            ->where('id',$this->input->post('id'))
            ->update('_v2_krs'.$this->smstr);
    
    echo $this->db->last_query();
  }
}