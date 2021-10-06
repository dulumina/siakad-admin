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

    function mhsw($status=[]){
        $ulevel=$this->CI->session->userdata('ulevel');
        $kdf=$this->CI->session->userdata('kdf');
        $kdj=$this->CI->session->userdata('kdj');
        if ($ulevel == '4' || $ulevel == '10' ) {
            return 0;
        }
        if (!$status) {
            $this->CI->db->where_in('status', ['A','C','U']);
        }else {
            $this->CI->db->where_in('status', $status);
        }
        
        if ($kdj) {
            $this->CI->db->where('KodeJurusan',$kdj);
        }elseif ($kdf) {
            $this->CI->db->where('KodeFakultas',$kdf);
        }
        $mhs = $this->CI->db->select("count(*) jumlah")->get('_v2_mhsw');
        if ($mhs->num_rows()==0) {
            return 0;
        }
        return $mhs->row()->jumlah;

    }

    function mhswKrs($periode=''){
        $ulevel=$this->CI->session->userdata('ulevel');
        if (!$periode || $ulevel == '4' || $ulevel == '10') {
            return 0;
        }
        
        $kf=$this->CI->session->userdata('kdf');
        $kp=$this->CI->session->userdata('kdj');
        $semester = "_v2_krs$periode";

        // $this->CI->db->join('_v2_mhsw',"$semester.nim=_v2_mhsw.nim",'inner');
        
        if (isset($kdj)) {
            $this->CI->db->where('KodeJurusan',$kdj);
        }elseif (isset($kdf)) {
            $this->CI->db->where('KodeFakultas',$kdf);
        }
        // $this->CI->db->group_by("$semester.nim");
        // $mhs = $this->CI->db->select("$semester.nim")->get($semester)->num_rows();
        // $this->CI->db->where_in('_v2_mhsw.nim',"Select nim from $semester where tahun = $periode");
        // $mhs = $this->CI->db->select("count(*) jumlah")->get('_v2_mhsw');
        
        $mhs = $this->CI->db->query("SELECT count(*) jumlah FROM _v2_mhsw WHERE nim IN (Select nim from $semester where tahun = $periode)");
        if ($mhs->num_rows()==0) {
            return 0;
        }
        return $mhs->row()->jumlah;
    }

    function mhswBayar($periode=''){
        $ulevel=$this->CI->session->userdata('ulevel');
        if (!$periode || $ulevel == '4' || $ulevel == '10') {
            return 0;
        }
        
        $kf=$this->CI->session->userdata('kdf');
        $kp=$this->CI->session->userdata('kdj');
        
        // $this->CI->db->join('_v2_mhsw',"_v2_spp2.nim=_v2_mhsw.nim",'inner');
        
        if (isset($kdj)) {
            $this->CI->db->where('_v2_mhsw.KodeJurusan',$kdj);
        }elseif (isset($kdf)) {
            $this->CI->db->where('_v2_mhsw.KodeFakultas',$kdf);
        }
        // $this->CI->db->where_in('_v2_mhsw.nim',"Select nim from _v2_spp2 where tahun = $periode");
        // $mhs = $this->CI->db->select("count(*) jumlah")->get('_v2_mhsw');
        $mhs = $this->CI->db->query("SELECT count(*) jumlah FROM _v2_mhsw WHERE nim IN (Select nim from _v2_spp2 where tahun = $periode)");
        if ($mhs->num_rows()==0) {
            return 0;
        }
        // echo $this->CI->db->last_query();
        // print_r($mhs->result());
        // die;
        return $mhs->row()->jumlah;
    }
}
?>