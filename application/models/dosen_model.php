<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
class dosen_model extends CI_Model{

    public function get_data($KodeFakultas='',$KodeJurusan='',$nip='',$NIDN_NUP_NIDK=''){
    
    /*$data =[
        'KodeFakultas' => $KodeFakultas,
        'KodeJurusan' => $KodeJurusan,
        'nip' => $nip,
        'NIDN_NUP_NIDK' => $NIDN_NUP_NIDK,
    ];
    $this->db->select('Name,nama_asli,glr_depan,glr_belakang,Phone,HP,Email,KodeFakultas,KodeJurusan,nip,Alamat,NIDN_NUP_NIDK,TempatLahir,TglLahir,AgamaID,NIK,NPWP');
    return $this->db->get_where('_v2_dosen', $data)->result_array();*/
    
    if ($KodeFakultas){
        $this->db->where('KodeFakultas',$KodeFakultas);
    }
    if ($KodeJurusan){
        $this->db->where('KodeJurusan',$KodeJurusan);
    }
    if ($nip){
        $this->db->where('nip',$nip);
    }
    if ($NIDN_NUP_NIDK){
        $this->db->where('NIDN_NUP_NIDK',$NIDN_NUP_NIDK);
    }
      
    $this->db->select('Name,nama_asli,glr_depan,glr_belakang,Phone,HP,Email,KodeFakultas,KodeJurusan,nip,Alamat,NIDN_NUP_NIDK,TempatLahir,TglLahir,AgamaID,NIK,NPWP');
    return $this->db->get('_v2_dosen')->result_array();
    
    }
}
?>