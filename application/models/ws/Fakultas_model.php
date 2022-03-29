<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
class Fakultas_model extends CI_Model{

    // public function get_data($Kode='',$Nama_Indonesia=''){
    public function get_data(){
    
    // if ($Kode){
    //     $this->db->where('Kode',$Kode);
    // }
    // if ($Nama_Indonesia){
    //     $this->db->where('Nama_Indonesia',$Nama_Indonesia);
    // }
    
    $this->db->select('Kode,Nama_Indonesia,Nama_English,Singkatan,dekan,nipdekan,NotActive');
    $this->db->where('NotActive','N');
    return $this->db->get('fakultas')->result_array();
    
    }

    //============= Input Data ============
    public function input_data($data=[])
    {
        $this->db->insert('fakultas', $data);
        return $this->db->affected_rows();
    }
}
?>