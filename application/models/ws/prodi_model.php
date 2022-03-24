<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
class prodi_model extends CI_Model{

    public function get_data($KodeFakultas='',$Nama_Indonesia=''){
    
    if ($KodeFakultas){
        $this->db->where('KodeFakultas',$KodeFakultas);
    }
    if ($Nama_Indonesia){
        $this->db->where('Nama_Indonesia',$Nama_Indonesia);
    }
    
    $this->db->select('Kode,Nama_Indonesia,Nama_English,Jenjang');
    return $this->db->get('_v2_jurusan')->result_array();
    
    // $this->db->from('_v2_jurusan');
    // $this->db->join('_v2_jenjangps','_v2_jenjangps.Kode=_v2_jurusan.Kode');
    // $this->db->where($NotActive);
    // $query = $this->db->get();
    // return $query->result();
    
    }
}
?>