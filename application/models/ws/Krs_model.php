<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Krs_model extends CI_Model
{

  public function get_data()
  {
    $this->db->select('_v2_krs20211.NIM, _v2_krs20211.Tahun, _v2_mhsw.KodeFakultas, _v2_mhsw.KodeJurusan kode_prodi');
    $this->db->join('_v2_mhsw', '_v2_mhsw.NIM=_v2_krs20211.NIM');
    $this->db->group_by('_v2_mhsw.NIM');
    return $this->db->get('_v2_krs20211')->result_array();
  }

  public function get_fak($fakultas)
  {
    $this->db->select('_v2_krs20211.NIM, _v2_krs20211.Tahun, _v2_mhsw.KodeFakultas, _v2_mhsw.KodeJurusan kode_prodi');
    $this->db->join('_v2_mhsw', '_v2_mhsw.NIM=_v2_krs20211.NIM');
    $this->db->where('_v2_mhsw.KodeFakultas', $fakultas);
    $this->db->group_by('_v2_mhsw.NIM');
    return $this->db->get('_v2_krs20211')->result_array();
  }

  public function get_prodi($fakultas, $prodi)
  {
    $this->db->select('_v2_krs20211.NIM, _v2_krs20211.Tahun, _v2_mhsw.KodeFakultas, _v2_mhsw.KodeJurusan kode_prodi');
    $this->db->join('_v2_mhsw', '_v2_mhsw.NIM=_v2_krs20211.NIM');
    $this->db->where('_v2_mhsw.KodeFakultas', $fakultas);
    $this->db->where('_v2_mhsw.KodeJurusan', $prodi);
    $this->db->group_by('_v2_mhsw.NIM');
    return $this->db->get('_v2_krs20211')->result_array();
  }
}
