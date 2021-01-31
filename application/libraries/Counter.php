<?php

class Counter{

    var $CI;

    public function __construct()
    {
            $this->CI =& get_instance();
            $this->CI->load->model('M_auth');
    } 

    function countMhsonClass($idjadwal="",$semester="")
    {
        $where['IDJadwal'] = $idjadwal;
        return $this->CI->db->get_where('_v2_krs'.$semester, $where)->num_rows();
    }

    function checkCapacityClass($idjadwal="",$semester="")
    {
        
        $where['IDJADWAL']  = $idjadwal;
        $total_college      = $this->countMhsonClass($idjadwal,$semester);
        $capasity           = $this->CI->db->select('kap')->get_where('_v2_jadwal', $where)->result_array();

        if($capasity <= $total_college ){ 
            return "full";
        }

        return false;
    }

    public function sumSksVal($thn,$nim,$acc)
    {
        $tbl = '_v2_krs'.$thn;
        $fields='count(sks) mk';
        $where=array(
            'nim'=>$nim,
            'st_wali'=>$acc
        );
        $krs = $this->CI->db->select($fields)->get_where($tbl,$where);
        return $krs->row()->mk;
        if ($krs->num_rows()==0) {
            return 0;
        }else {
            return $krs->row()->mk;
        }
    }


}
?>