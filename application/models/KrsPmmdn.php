<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KrsPmmdn extends CI_Model{

  public function addMkKrs($input)
  {

    $data=array(
      'nim' => $input['nim'],
      'tahun' => $input['periode'],
      'id_jadwal' => $input['IDJADWAL'],
    );

    $this->db->insert('_v2_krsmbkm',$data);
    return true;
  }

  public function getKrs($nim,$tahun)
  {
    $this->db->where('nim',$nim);
    $this->db->where('_v2_krsmbkm.tahun', $tahun);
    $this->db->join('_v2_jadwal','_v2_jadwal.IDJADWAL=_v2_krsmbkm.id_jadwal','inner');
    $this->db->join('_v2_jurusan','_v2_jadwal.KodeJurusan=_v2_jurusan.kode','inner');
    $this->db->join('_v2_hari','_v2_hari.id=_v2_jadwal.hari','inner');
    return $this->db->get('_v2_krsmbkm')->result();
  }

  public function countSKS($nim,$tahun)
  {
    $this->db->select('sum(_v2_jadwal.sks) total_sks');
    $this->db->join('_v2_jadwal','_v2_jadwal.IDJADWAL=_v2_krsmbkm.id_jadwal','inner');
    $this->db->group_by('_v2_krsmbkm.tahun');
    $this->db->where('_v2_krsmbkm.nim',$nim);
    $this->db->where('_v2_krsmbkm.tahun', $tahun);
    $sks =  $this->db->get('_v2_krsmbkm');
    // echo json_encode($this->db->last_query());
    // exit;
    if ($sks->num_rows() >= 1) {
      return $sks->row()->total_sks;
    }else {
      return 0;
    }
    // return $sks;
    // echo json_encode( $sks );
    // echo json_encode($this->db->last_query());
    // exit;
  }

  public function getProfile($nim)
  {
    return $this->db->get_where('_v2_mhsw_pmmdn',['nim'=>$nim])->row();
  }
}
?>