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
        
        if (isset($kp) && $kp!='') {
            $this->CI->db->where('KodeJurusan',$kp);
        }elseif (isset($kf) && $kf!='') {
            $this->CI->db->where('KodeFakultas',$kf);
        }
        $arr_nim = $this->db->query("Select nim from _v2_spp2 where tahun = $periode")->result_array();
        $this->db->select(" count(*) jumlah ");
        $this->db->where_in("nim",$arr_nim);
        $mhs = $this->db->get();
        // $mhs = $this->CI->db->query("SELECT count(*) jumlah FROM _v2_mhsw WHERE nim IN (Select nim from _v2_spp2 where tahun = $periode)");
        if ($mhs->num_rows()==0) {
            return 0;
        }
        return $mhs->row()->jumlah;
    }
    function mhsMembayarSpc($periode){
        $otherWhere = "";
        $ulevel=$this->CI->session->userdata('ulevel');

        if (!$periode || $ulevel == '4' || $ulevel == '10') {
            return 0;
        }
        
        $kf=$this->CI->session->userdata('kdf');
        $kp=$this->CI->session->userdata('kdj');
        
        if (isset($kp) && $kp!='') {
            $otherWhere = " AND kode_prodi = '$kp' ";
            // $this->CI->db->where('KodeJurusan',$kp);
        }elseif (isset($kf) && $kf!='') {

            $otherWhere = " AND kode_fakultas = '$kf' ";
            // $this->CI->db->where('KodeFakultas',$kf);
        }

        $spc = $this->CI->load->database('spc', TRUE);
        $kueri = "SELECT count(*) jumlah  FROM `tagihan` WHERE `kode_periode` LIKE '$periode' AND `st_bayar` = 1 AND kode_fakultas !='DAF' $otherWhere GROUP BY nomor_induk";
        $mhs = $spc->query($kueri);
        if ($mhs->num_rows()==0) {
            return 0;
        }
        return $mhs->row()->jumlah;
    }
    public function mhswinbon()
    {
        return $this->CI->db->select("count(*) jumlah")
                            ->where('status','A')
                            ->get('_v2_mhsw_pmmdn')
                            ->row()->jumlah;
    }

    public function dosen()
    {
        $ulevel=$this->CI->session->userdata('ulevel');
        if ( $ulevel == '4' || $ulevel == '10') {
            return 0;
        }
        $kf=$this->CI->session->userdata('kdf');
        $kp=$this->CI->session->userdata('kdj');
        
        $where='';
        if ($kp) {
            $where = " AND KodeJurusan='$kp' ";
        }elseif ($kf) {
            $where = " AND KodeFakultas='$kf' ";
        }
        $mhs = $this->CI->db->query("SELECT count(*) jumlah FROM _v2_dosen WHERE NotActive='N' $where");
        if ($mhs->num_rows()==0) {
            return 0;
        }
        
        // echo $this->CI->db->last_query();
        // exit();
        return $mhs->row()->jumlah;
    }

    public function matakuliah($periode)
    {
        $ulevel=$this->CI->session->userdata('ulevel');
        if ( $ulevel == '4' || $ulevel == '10') {
            return 0;
        }
        $kf=$this->CI->session->userdata('kdf');
        $kp=$this->CI->session->userdata('kdj');
        $where='';
        $str = "SELECT * FROM `_v2_jadwal` $where GROUP BY `kodeMK`, `kodeJurusan`";
        $this->CI->db->group_by('kodeMK');
        $this->CI->db->group_by('kodeJurusan');
        $count = $this->CI->db->get('_v2_jadwal')->num_rows();
        // echo $this->CI->db->last_query();
        // exit();
        return $count;
    }
}
?>
