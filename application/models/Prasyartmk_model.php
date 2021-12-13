<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prasyartmk_model extends CI_Model
{

	// Get Mk Syarat Berdasar Kdf
	public function getmksfak($kdf)
	{
		$data = $this->db->query("SELECT _v2_prasyaratmk.ID, _v2_prasyaratmk.KodeMK, _v2_prasyaratmk.KodeMK, _v2_prasyaratmk.IDMK, _v2_matakuliah.Nama_Indonesia FROM `_v2_prasyaratmk` JOIN _v2_matakuliah ON _v2_matakuliah.Kode= _v2_prasyaratmk.KodeMK AND _v2_matakuliah.IDMK=_v2_prasyaratmk.IDMK WHERE _v2_matakuliah.KodeFakultas = '$kdf' GROUP BY IDMK;");
		return $data->result();
	}

	// Get Mk Syarat Berdasar Kdj
	public function getmksjur($kdj)
	{
		$data = $this->db->query("SELECT _v2_prasyaratmk.ID, _v2_prasyaratmk.KodeMK, _v2_prasyaratmk.IDMK, _v2_matakuliah.Nama_Indonesia FROM `_v2_prasyaratmk` JOIN _v2_matakuliah ON _v2_matakuliah.Kode= _v2_prasyaratmk.KodeMK AND _v2_matakuliah.IDMK=_v2_prasyaratmk.IDMK WHERE _v2_matakuliah.KodeJurusan = '$kdj' GROUP BY IDMK;");
		return $data->result();
	}

	// Get Mk Semua MK Syarat
	public function getmkssup()
	{

		$data = $this->db->query("SELECT _v2_prasyaratmk.ID, _v2_prasyaratmk.KodeMK, _v2_prasyaratmk.IDMK, _v2_matakuliah.Nama_Indonesia FROM _v2_prasyaratmk JOIN _v2_matakuliah ON _v2_matakuliah.Kode= _v2_prasyaratmk.KodeMK AND _v2_matakuliah.IDMK=_v2_prasyaratmk.IDMK GROUP BY IDMK");
		return $data->result();
	}

	// Get Syarat
	public function getsyarat($id)
	{

		$data = $this->db->query("SELECT _v2_prasyaratmk.ID, _v2_prasyaratmk.KodeMK, _v2_prasyaratmk.PraID, _v2_matakuliah.Nama_Indonesia, _v2_prasyaratmk.NotActive FROM _v2_prasyaratmk JOIN _v2_matakuliah ON _v2_matakuliah.Kode= _v2_prasyaratmk.KodeMK AND _v2_matakuliah.IDMK=_v2_prasyaratmk.IDMK WHERE _v2_prasyaratmk.IDMK = '$id' ");
		return $data->result();
	}

	// Get Syarat
	public function getmk($data)
	{
		$data = $this->db->query("SELECT Kode, CONCAT(Nama_Indonesia, ' - ' ,IDMK) AS Nama FROM _v2_matakuliah WHERE Nama_Indonesia LIKE '%" . $data . "%'");
		return $data->result();
	}

	// Get Kode
	public function kode($kode)
	{
		$data = $this->db->query("SELECT IDMK FROM _v2_matakuliah WHERE Kode LIKE '%" . $kode . "%'");
		return $data->row_array();
	}

	// Tambah Syarat MK
	public function add($data)
	{
		$this->db->insert('_v2_prasyaratmk', $data);
	}

	public function update($IDMK, $PraID, $NotActive)
	{
		// print_r($IDMK);
		// print_r($PraID);
		// print_r($NotActive);
		$this->db->query("UPDATE _v2_prasyaratmk SET NotActive= '$NotActive' WHERE IDMK = '$IDMK' AND PraID = '$PraID';");
		echo $this->db->last_query();
		die;
	}


	// public function hapusData($id) {
	// 	$this->db->where('ID',$id);
	// 	$this->db->delete('_v2_kurikulum');
	// }

}
