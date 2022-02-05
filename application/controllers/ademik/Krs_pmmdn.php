<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Krs_pmmdn extends CI_Controller {

	public $TahunPeriode;
	public $nim='';
	public $jenjang='';
	function __construct() {
		parent::__construct();
		// $this->load->library('form_validation');
    // $this->load->library('encryption');
    $this->load->helper('fikri');
    // $this->load->model('additional_model');
	  $this->load->library('m_pdf');
		$this->load->model('KrsPmmdn','pmmdn');

    $this->app->cek_login();
	}
  
	public function index() {
		$sessionData = json_encode([
			'nim'=>$this->session->userdata('unip'),
			'periode'=>$this->session->userdata('periode')
		]);
		$data['token'] = base64encode($sessionData);
		$totalSKS ='';
		if (in_array($this->session->userdata('ulevel'),[1,5,6,7])) {
			// $this->nim = '19016005'; //$this->session->userdata('unip');
			// $jenjang = 'C';// $this->session->userdata('jenjang');
		}else {
			$this->nim = $this->session->userdata('unip');
			$jenjang = $this->session->userdata('jenjang');
		}
		if (isset($_SESSION['periode'])) {
			$this->TahunPeriode = $_SESSION['periode'];
			$totalSKS = $this->pmmdn->countSKS($this->nim,$this->TahunPeriode);
		};
		$data['totalSKS'] = $totalSKS;
		$profile = $this->pmmdn->getProfile($this->nim);
		$data['profile'] = $profile;

		if (isset($jenjang)) {
			$this->db->where('_v2_jurusan.jenjang',$jenjang);
		}
		$this->db->select('_v2_tahun.kode,_v2_tahun.nama');
		$this->db->group_by('_v2_tahun.kode');
		$data['tahun_semester'] = $this->app->getPeriodeKrsProdi();
		// echo $this->db->last_query();die;
		// $data['tahun_semester']=[];
		// $data['kueri'] = [];
		$thnKrs = $this->pmmdn->getTahunKrs($this->nim);
		// $data['thnKrs'] = $thnKrs;
		if (!empty($thnKrs)) {
			foreach ($thnKrs as $thn){
				$this->db->select('_v2_tahun.kode,_v2_tahun.nama');
				$this->db->group_by('_v2_tahun.kode');
				if (isset($jenjang)) {
					$this->db->where('_v2_jurusan.jenjang',$jenjang);
				}
				$thnFromKrs = $this->app->getPeriodeKrsProdi($thn['tahun']);
				array_push($data['tahun_semester'],$thnFromKrs[0]);
				// array_push($data['kueri'],$this->db->last_query());
			}
		}

		$this->db->select('_v2_jurusan.kode,_v2_jurusan.nama_indonesia nama');
		$this->db->group_by('_v2_jurusan.kode');
		if (isset($jenjang)) {
			$this->db->where('_v2_jurusan.jenjang',$jenjang);
		}
		$data['daftar_prodi'] = $this->app->getProdi();

		// echo dump_d($data);exit;
			// dump_d($_SESSION);

		$this->load->view('dashbord',$data);
		$this->load->view('fikri.js/krs_pmmdn');

	}
  
	public function cari_nims()
	{
		$nim = $this->input->post('keyWord');
    $this->load->model('Inbound');
		$list = $this->Inbound->cariMhswByNim($nim);
		// echo $this->db->last_query();
		echo json_encode($list);
	}
  
	public function Tahun_semester($periode='',$nim='',$jenjang='')
	{
		if (in_array($this->session->userdata('ulevel'),[1,5,6,7])) {
			$this->nim = $nim;
			$this->jenjang = $jenjang;
		}
		if ($periode!='') {
			$this->db->select('_v2_bataskrs.*');
			if ($this->app->getPeriodeKrsProdi($periode,'',true)) {
				$_SESSION['periode']=$periode;
				$this->TahunPeriode=$periode;
			}else {
				unset($_SESSION['periode']);
			}
		}
		$this->index();
	}

	public function getKelasKuliah()
	{
		$prodi = $this->input->post('prodi');
		$periode = $this->input->post('periode');
		if ($prodi and $periode) {
	    $this->load->model('Inbound');
			$kelasKuliah = $this->app->getKelasPerkuliahan($prodi,$periode);

			$i=0;
			foreach ($kelasKuliah as $row) {
				$kelasKuliah[$i]->dosen = $this->Inbound->dosen_kelas($row->IDJADWAL)['data'];
				$i++;
			}
			echo json_encode($kelasKuliah);
		}else {
			echo json_encode(null);
		}
	}

	public function addMkKrs()
	{
		$input = $this->input->post();
		if ($this->cekMaxSks($input)) {
			$this->pmmdn->addMkKrs($input);
			$status="1";
			$msg="Matakuliah telah ditambahkan!";
		}else {
			$status="0";
			$msg="Gagal menambahkan MK, Total SKS melebihi batas yang ditentukan.";
		}

		// $data = $this->getKrs(true);
		$data['status'] = $status;
		$data['msg'] = $msg;
		echo json_encode($data);
	}

	private function cekMaxSks($dataBin)
	{
		$nim = $dataBin['nim'];
		$periode = $dataBin['periode'];
		$id_jadwal = $dataBin['IDJADWAL'];
		$totalSKS = $this->pmmdn->countSKS($nim,$periode);

		$sksMK = $this->db->select("SKS")->get_where("_v2_jadwal",["IDJADWAL"=>$id_jadwal])->row()->SKS;
		
		return (((int)$totalSKS + (int)$sksMK) <= 21) ? true : false ;
	}

	public function getKrs($return=false,$dataBin=[])
	{
		if (isset($_POST['periode'])) {
			$periode = $_POST['periode'];
			$nim = $_POST['nim'];
			$input = $_POST;
		}elseif (isset($_SESSION['periode'])) {
			$periode = $_SESSION['periode;'];
			$nim = $session['nim'];
			$input = $_SESSION;
		}elseif (count($dataBin) >= 1 ) {
			$periode = $dataBin->periode;
			$nim = $dataBin->nim;
			$input = json_decode(json_encode($dataBin), true);;
		}else{
			echo json_encode([]);
			exit(200);
		}
		
		$this->db->select("_v2_jadwal.IDJADWAL,_v2_jadwal.NamaMK,_v2_jadwal.KodeRuang,_v2_jadwal.SKS,concat(_v2_hari.Nama,', ',_v2_jadwal.JamMulai,' s/d ',_v2_jadwal.JamSelesai) as waktu,_v2_jurusan.Nama_Indonesia prodi");
		$this->db->select("_v2_krsmbkm.id");
		$krs = $this->pmmdn->getKrs($nim,$periode);
		$this->load->model('Inbound');
		
		// dump_d($krs);
		$i=0;
		foreach ($krs as $row) {
			$krs[$i]->dosen = $this->Inbound->dosen_kelas($row->IDJADWAL)['data'];
			$i++;
		}
		// $data['query'] = $this->db->last_query();
		$data['krs'] = $krs;
		$data['totalSKS'] = (int)$this->pmmdn->countSKS($nim,$periode);
		
		$sessionData = json_encode(['nim'=>$nim,'periode'=>$periode]);
		$data['token'] = base64encode($sessionData);
		// echo json_encode($data);exit;

		if ($return) {
			return $data;
		}else {
			echo json_encode($data);
		}
	}

	public function removeMK()
	{
		$nim = $this->input->post('nim');//$this->session->userdata('unip');
		$input = $this->input->post('id_krs');
		$cekMK = $this->db->get_where('_v2_krsmbkm',['nim'=>$nim,'id'=>$input]);
		if ($cekMK->num_rows()==1) {
			$this->db->delete('_v2_krsmbkm', array('id' => $input));
			$status="1";
			$msg="Matakuliah telah dihapus!";
		}else {
			$status="0";
			$msg="Gagal menghapus Matakuliah KRS.";
		}

		// $data = $this->getKrs(true);
		$data['status'] = $status;
		$data['msg'] = $msg;
		echo json_encode($data);
	}

	public function cetakKrs($token)
	{
		$sessionData = json_decode(base64decode($token));
		
		// falidasi data
		// if (
		// 	$this->session->userdata('unip') != $sessionData->nim and
		// 	$this->session->userdata('periode') != $sessionData->periode
		// 	) {
		// 		echo "<script> alert('URL token tidak sesuai'); window.location.href='".base_url('ademik/Krs_pmmdn/')."' </script>";
		// }

		// dump_d($sessionData);
		$this->load->library('m_pdf');
		

		$data=array(
			'detailKrs' => $this->getKrs(true,$sessionData)['krs'],
			'periode'	=> $this->db->select('nama_periode')
												->get_where(
													'_v2_periode_aktif',
													['periode_aktif'=>$sessionData->periode])
												->row()->nama_periode,
			'profile'	=> $this->pmmdn->getProfile($sessionData->nim)
		);
		
		// dump_d($data);
		$html = $this->load->view('ademik/report/cetak_krspmmdn', $data,true);
		$pdf = $this->m_pdf->exp_pdf();

		$pdf->AddPage('P');
		$pdf->pagenumPrefix = 'Halaman ';
		$pdf->nbpgPrefix = ' dari ';
		$pdf->setFooter('{PAGENO}{nbpg}');
		$pdf->WriteHTML($html);

		$pdf->Output("KRS_$sessionData->nim.pdf", "D");

		exit();
	}

	public function getProfile()
	{
		$data = [];
		$this->TahunPeriode = $this->input->post('periode');
		$this->nim = $this->input->post('nim');
		$data = $this->pmmdn->getProfile($this->nim);
		if ($data) {
			$data->totalSKS = $this->pmmdn->countSKS($this->nim,$this->TahunPeriode);
		}

		echo json_encode($data);
	}

}