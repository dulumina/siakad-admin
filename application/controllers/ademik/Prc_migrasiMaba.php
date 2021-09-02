<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Prc_migrasiMaba extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_prcSiakad2');
		$this->load->helper('form');
		$this->load->helper('fikri');
	}

	public function index()
	{
		echo form_open("ademik/Prc_migrasiMaba/MigrationStart");
		echo "<input type='text' placeholder='NIM' name='nim'>";
		echo "<input type='text' placeholder='No Ujian' name='noujian'>";
		echo "<input type='submit' value='go'>";
	}

	public function MigrationStart()
	{
		$where='';
		if ($this->input->post('NIM') or $this->input->post('noujian') ) {
			$nim	= $this->input->post('NIM');
			$noujian	= $this->input->post('noujian');
			$where = " and ( lulus_pcmb.st_nim =$nim or lulus_pcmb.noujian = $noujian )";
		}
		
		$data_mhsw = $this->M_prcSiakad2->getDaftarulang($where);
		echo 'Jumlah '.$data_mhsw->num_rows().' <br>';
		if ($data_mhsw->num_rows()) {
			$this->db->insert_batch('_v2_tempMaba',$data_mhsw->result());
			
			$count = $this->db->affected_rows();
			if ($count) {
				$i=0;
				foreach ($data_mhsw->result() as $maba) {
					$noujian[$i] = $maba->PMBID;
					$i++;
					echo $maba->KodeJurusan."-".$maba->PMBID.'-'.$maba->NIM."-".$maba->Name."<br>";
				} 
				$up = $this->M_prcSiakad2->updateStatusMigrasi($noujian);
				
				echo 'insert temp :'.$count.' | success :'.$up.'<br>';
	
				if ( $jumlah = $this->M_prcSiakad2->commitMigrasion() ) {
					echo "Suksess, $jumlah data tersimpan";
				}else {
					echo "Tidak ada data yang tersimpan";
				}
			}
		}else {
			echo "Tidak ada data baru";
		}

	}

	private function getStatusProgram($ket)
	{
		$program = "";

		if ($ket == 0) {
			$program = "REG";
		}
		elseif($ket == 1){
			$program = "NONREG";
		}
		elseif($ket == 2){
			$program = "Kampus Touna";
		}
		elseif($ket == 3){
			$program = "kampus Morowali";
		}
		else{
			$program = "-";
		}

		return $program;
	}

	public function getStatusKampus2($ket, $kode)
	{
		$kodefakultas = "";
		
		if($ket == 2){
			$kodefakultas = "K2T";
		}
		elseif($ket == 3){
			$kodefakultas = "K2M";
		}else{
			$kodefakultas = $kode;
		}

		return $kodefakultas;
	}

}
