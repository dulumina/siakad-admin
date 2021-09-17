<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Model{

	public function cek_login(){
		$uname=$this->session->userdata('uname');
		$ulevel=$this->session->userdata('ulevel');
		if (empty($uname) and empty($ulevel)){
			$this->session->sess_destroy();
			$this->session->set_flashdata('konfirmasi','Silahkan login terlebih dahulu...!');
			redirect(base_url());
		}
	}

	public function checksession(){
		$uname=$this->session->userdata('uname');
		$ulevel=$this->session->userdata('ulevel');
		if (!empty($uname) and !empty($ulevel)){
			$this->load->view('dashbord');
		} else {
			redirect(base_url('menu'));
		}
	}

	public function checksession_ajax(){
		$uname=$this->session->userdata('uname');
		$ulevel=$this->session->userdata('ulevel');
		if (!empty($uname) and !empty($ulevel)){
			return true;
		} else {
			redirect(base_url('menu'));
		}
	}

	public function checksession_2(){
		$uname=$this->session->userdata('uname');
		$ulevel=$this->session->userdata('ulevel');
		if (!empty($uname) and !empty($ulevel)){
			$this->load->view('dashbord');
		} else {
			$this->load->view('login');
		}
	}

	public function check_modul() {
		$ulevel = $this->session->userdata('ulevel');
		$template = $this->session->userdata('tamplate');

		$cek = $this->db->query("select * from modul WHERE Link = '$template' and Level like '%-$ulevel-%'")->num_rows();

		if ($cek){
			return true;
		} else {
			redirect(base_url("menu"));
		}
	}

	function tanggal_inggris($formattes){
		// fandu function tanggal inggris
		$id=array("January","February","March","April","May","June","July","August","September","October","November","December");
		$tgl = substr($formattes, 0, 2); // memisahkan format tahun menggunakan substring
		$kd = substr($formattes, 2, 2); // memisahkan format tahun menggunakan substring
		$bulan = substr($formattes, 5, 6); // memisahkan format bulan menggunakan substring
		$tahun   = substr($formattes, 8, 11); // memisahkan format tanggal menggunakan substring
		if($tgl=="01")  $tgl="1";
		else if($tgl=="02")  $tgl="2";
		else if($tgl=="03")  $tgl="3";
		else if($tgl=="04")  $tgl="4";
		else if($tgl=="05")  $tgl="5";
		else if($tgl=="06")  $tgl="6";
		else if($tgl=="07")  $tgl="7";
		else if($tgl=="08")  $tgl="8";
		else if($tgl=="09")  $tgl="9";

		$result = $id[(int)$bulan-1]." ". $tgl."<sup>".$kd."</sup> ".$tahun;

		return($result);
	}

	function tanggal_indonesia($formattes){
		// fandu function tanggal indonesia

		$id=array("Januari","Pebruari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

		$tgl = substr($formattes, 0, 2); // memisahkan format tahun menggunakan substring
		$i = substr($formattes, 0, 1);
		if($i=='0') $tgl = substr($formattes, 1, 1);

		$bulan = substr($formattes, 3, 4); // memisahkan format bulan menggunakan substring
		$tahun   = substr($formattes, 6, 9); // memisahkan format tanggal menggunakan substring

		$result = $tgl." ".$id[(int)$bulan-1]." ".$tahun;
		return($result);
	}

	public function all_val($table){
		$menu = $this->db->get_where($table);
		return $menu;
	}

	public function one_val($table, $par1, $val1){
		$menu = $this->db->get_where($table, array($par1 => $val1));
		return $menu;
	}

	public function two_val_option($par1, $par2, $table, $val1, $val2){
		if (!empty($val2)) $val2 = "and $val2";
		$option ="";
		$s = "select $par1 as par1, $par2 as par2 from $table where $val1 $val2";
		$r = $this->db->query($s);
		foreach ($r->result() as $row) {
			$option .= "<option value='".$row->par2."'>".$row->par1."</option>";
		}
		return $option;
	}

	public function two_val($table, $par1, $val1, $par2, $val2){
		$menu = $this->db->get_where($table, array($par1 => $val1, $par2 => $val2));
		return $menu;
	}

	public function select_all_val($table,$select){
		$this->db->select($select);
		$this->db->from($table);

		return $this->db->get();
	}

	public function check($uri3){
		$break = $this->session->userdata('menu');
		if (in_array($uri3, $break)) {
			$key = array_search($uri3, $break);
			$module=$this->session->userdata($key.'T');
			return $module;
		} else {
			return false;
		}
	}

	function GetFields($_results, $_tbl, $_key, $_value) {
		$s = "select $_results from $_tbl where $_key='$_value' limit 1";
		$r = $this->db->query($s);
		return $r;
	}

	function GetField ($_results, $_tbl, $value, $value1) {
		if (!empty($value1)) $value1 = "and $value1";
		$s = "select $_results from $_tbl where $value $value1";
		$r = $this->db->query($s);
		return $r;
	}

	public function getOnRow($select, $tabel, $kondisi) {
		$query = "select $select from $tabel where $kondisi"; // Modif 08 - 2006 and Tahun='$thn'
		$row = $this->db->query($query)->row();
		return $row;
	}

	public function getPeriodeKrsProdi($periode='',$prodi='',$bolean=false)
	{
		$where=array(
			'_v2_tahun.NotActive' => 'N',
			'_v2_jurusan.NotActive' => 'N',
			'_v2_bataskrs.NotActive' => 'N',
			'_v2_bataskrs.krsm <= ' => date('Y-m-d'),
			'_v2_bataskrs.krss >= ' => date('Y-m-d'),

		);
		
		if ($periode!='') {
			$where['_v2_tahun.kode'] = $periode;
		}
		if ($prodi!='') {
			$where['_v2_jurusan.kode'] = $prodi;
		}

		$this->db->join('_v2_jurusan','_v2_jurusan.Kode=_v2_tahun.KodeJurusan','inner');
		$this->db->join('_v2_bataskrs','_v2_bataskrs.Tahun=_v2_tahun.Kode AND _v2_tahun.KodeProgram=_v2_bataskrs.KodeProgram AND _v2_bataskrs.KodeJurusan=_v2_jurusan.Kode', 'inner');
		$this->db->where($where);
		$this->db->order_by('_v2_tahun.kode','DESC');

		$tabel_periode = $this->db->get('_v2_tahun');
		if ($bolean) {
			if ($tabel_periode->num_rows()>0) {
				return true;
			}else {
				return false;
			}
		}else {
			return $tabel_periode->result();
		}
	}
	public function getProdi()
	{
		$this->db->where('_v2_jurusan.kode !=','PMMDN');
		$this->db->where('_v2_jurusan.NotActive','N');
		$this->db->join('fakultas','fakultas.kode=_v2_jurusan.kodeFakultas','inner');
		return $this->db->get('_v2_jurusan')->result();
	}
	public function getKelasPerkuliahan($prodi='',$periode='')
	{
		$select = "id_kelas_kuliah,IDJADWAL,id_mk,IDMK,NamaMK,SKS,IDDosen,Hari,JamMulai,JamSelesai,KodeRuang";
		$where=[];
		if ($prodi) {
			$where['_v2_jadwal.KodeJurusan']=$prodi;
		}
		if ($periode) {
			$where['_v2_jadwal.tahun']=$periode;
		}

		$this->db->select($select);
		$this->db->select("concat(_v2_hari.Nama,', ',_v2_jadwal.JamMulai,' s/d ',_v2_jadwal.JamSelesai) as waktu");
		
		$this->db->join('_v2_jurusan','_v2_jurusan.Kode=_v2_tahun.KodeJurusan','inner');
		// $this->db->join('_v2_bataskrs','_v2_bataskrs.Tahun=_v2_tahun.Kode AND _v2_tahun.KodeProgram=_v2_bataskrs.KodeProgram AND _v2_bataskrs.KodeJurusan=_v2_jurusan.Kode', 'inner');
		$this->db->join('_v2_jadwal','_v2_jadwal.Tahun=_v2_tahun.Kode AND _v2_jadwal.KodeJurusan=_v2_jurusan.Kode','inner');
		$this->db->join('_v2_hari','_v2_jadwal.hari=_v2_hari.id','inner');
		$this->db->where($where);
		$this->db->order_by('_v2_tahun.kode','DESC');
		$this->db->group_by('IDJADWAL');
		$res = $this->db->get('_v2_tahun');
		return $res->result();
	}
}
