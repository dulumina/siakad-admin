<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smesterakademik_model extends CI_Model {

	public function get_dataSearch($lvl, $user) {

        if ( $lvl == 1 ) {

            $this->db->select('Kode, Nama_Indonesia');
            $this->db->from('_v2_jurusan');

            return $this->db->get()->result_array();

        } elseif ( $lvl == 5 ) {

            $this->db->select('Kode, Nama_Indonesia');
            $this->db->from('_v2_jurusan');
            $this->db->where('KodeFakultas', $user);

            return $this->db->get()->result_array();

        } elseif ( $lvl == 2 || $lvl == 7 ) {

            $this->db->select('Kode, Nama_Indonesia');
            $this->db->from('_v2_jurusan');
            $this->db->where('Kode', $user);

            return $this->db->get()->result_array();

        }

    }

    public function select($Kode){
		return $this->db->query("select * from _v2_tahun WHERE Kode = '$Kode'");
		return $data->result_array();
	}

	public function select_data($tabelName){
		$result = $this->db->get($tabelName);
		return $result->result_array();
	}

	//Kode,Nama,KodeProgram,KodeJurusan
	public function getdata($where) {
		
		$this->db->where($where);

		$data = $this->db->query('select * from _v2_tahun LIMIT 56, 100');
		return $data->result_array();
	}

	public function select_field_from(){
		$data = $this->db->query("select Kode,Nama_Indonesia from _v2_jurusan");
		return $data->result_array();
	}

	public function insert_data($tabelName,$data){
		$res = $this->db->insert($tabelName,$data);
		return $res;
	}

	public function UpdataData($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}

	public function update_where($table, $data, $where)
	{
		$this->db->where($where);
		$update = $this->db->update($table, $data, $where);
		if ($update) {
			return 1;
		}
		else {
			return 0;
		}
	}

	public function DeleteData($tabelName, $where){
		       $this->db->where($where);
		$res = $this->db->delete($tabelName);
		return $this->db->last_query();
	}

	public function select_fields_where($table, $fields, $where)
	{
		$this->db->select($fields);
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result->result_array();
	}	

//Model datatable server side****************************************

	var $table 			= '_v2_tahun';

    var $column_order 	= array(
								null,
								'Kode',
								'Nama',
								'KodeProgram',
								'KodeJurusan'
    							); 

    var $column_search 	= array(
								'_v2_tahun.Kode'
    							);
    
    var $order 			= array('Kode' => 'asc'); 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query($program, $jurusan)
    {
    	$where = array(
    					'KodeProgram' => $program,
    					'KodeJurusan' => $jurusan
    					);

        $this->db->where($where);
        
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($program, $jurusan)
    {
        $this->_get_datatables_query($program, $jurusan);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($program, $jurusan)
    {
        $this->_get_datatables_query($program, $jurusan);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    /**
     * fungsi untuk membuat table krs
     * @author fikri
     * @param tring tahun Periode Krs contoh: '20201'
     * 
     */
    public function creatTableKrs($tahun)
    {
        # falidasi tahun
        $periode = substr($tahun,4);
        if(!in_array($periode,['1','2','3'])){
            return false;
        }

        # buat query
        $creatTable = "CREATE TABLE _v2_krs$tahun (   ID int(11) NOT NULL COMMENT 'ID numerik (nomor) Autoicrement, ter isi secara otomatis',   st_feeder int(1) NOT NULL DEFAULT '0' COMMENT 'Status feeder (-3 = `gagal`, 3 = `success` , 4 = `data pernah di update`, 5 = `data akan di update`)',   NIM varchar(20) NOT NULL DEFAULT '' COMMENT 'STAMBUK Mahasiswa',   Tahun varchar(5) NOT NULL DEFAULT '' COMMENT 'Tahun Akademik KRS ter input',   SMT varchar(5) DEFAULT NULL,   Sesi int(11) DEFAULT '0' COMMENT 'Sesi',   IDJadwal varchar(150) DEFAULT '0' COMMENT 'IDJadwal pada matakuliah tersebut',   IDPAKET varchar(100) DEFAULT NULL COMMENT 'Id Paket dari tabel _v2_paket',   IDMK00 varchar(150) DEFAULT '0',   IDMK varchar(150) DEFAULT NULL COMMENT 'ID Matakuliah	',   KodeMK varchar(10) DEFAULT NULL COMMENT 'Kode Matakuliah	',   NamaMK varchar(255) DEFAULT NULL COMMENT 'Nama Matakuliah	',   NamaMK_Inggris varchar(255) DEFAULT NULL COMMENT 'Nama Matakuliah Bahasa Inggris',   SKS decimal(5,1) NOT NULL DEFAULT '0.0' COMMENT 'Bobot Sks Matakuliah	',   Status varchar(5) DEFAULT NULL,   Program varchar(10) DEFAULT NULL COMMENT 'REG atau NON REG',   IDDosen varchar(20) DEFAULT NULL COMMENT 'ID Dosen Relasi pada tabel _v2_jadwal',   unip varchar(20) DEFAULT NULL COMMENT 'User Input KRS Mahasiswa',   Tanggal datetime DEFAULT NULL COMMENT 'Tanggal input KRS',   hr_1 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_2 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_3 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_4 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_5 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_6 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_7 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_8 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_9 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_10 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_11 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_12 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_13 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_14 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_15 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_16 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_17 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_18 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_19 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_20 char(2) DEFAULT NULL COMMENT 'digunakan',   hr_21 char(2) DEFAULT NULL,   hr_22 char(2) DEFAULT NULL,   hr_23 char(2) DEFAULT NULL,   hr_24 char(2) DEFAULT NULL,   hr_25 char(2) DEFAULT NULL,   hr_26 char(2) DEFAULT NULL,   hr_27 char(2) DEFAULT NULL,   hr_28 char(2) DEFAULT NULL,   hr_29 char(2) DEFAULT NULL,   hr_30 char(2) DEFAULT NULL,   hr_31 char(2) DEFAULT NULL,   hr_32 char(2) DEFAULT NULL,   hr_33 char(2) DEFAULT NULL,   hr_34 char(2) DEFAULT NULL,   hr_35 char(2) DEFAULT NULL,   hr_36 char(2) DEFAULT NULL,   jmlHadir int(2) NOT NULL DEFAULT '0',   Hadir decimal(5,2) DEFAULT '0.00',   Tugas1 decimal(5,2) DEFAULT '0.00',   Tugas2 decimal(5,2) DEFAULT '0.00',   Tugas3 decimal(5,2) DEFAULT '0.00',   Tugas4 decimal(5,2) DEFAULT '0.00',   Tugas5 decimal(5,2) DEFAULT '0.00',   NilaiPraktek decimal(5,2) NOT NULL DEFAULT '0.00',   NilaiMID decimal(5,2) DEFAULT '0.00',   NilaiUjian decimal(5,2) DEFAULT '0.00',   Nilai decimal(5,2) DEFAULT '0.00' COMMENT 'Nilai Angka',   GradeNilai varchar(5) DEFAULT NULL COMMENT 'Nilai Huruf pada matakuliah tersebut',   Bobot decimal(5,2) DEFAULT '0.00' COMMENT 'Bobot Nilai pada matakuliah tersebut',   useredt varchar(200) DEFAULT NULL COMMENT 'User Input/Edit Nilai Mahasiswa',   tgledt datetime DEFAULT NULL COMMENT 'Tanggal Input/Edit Nilai Mahasiswa',   rowedt int(11) DEFAULT '0',   Tunda enum('Y','N') DEFAULT 'N',   AlasanTunda varchar(255) DEFAULT NULL,   Setara enum('Y','N') NOT NULL DEFAULT 'N',   MKSetara varchar(100) DEFAULT NULL,   KodeSetara varchar(12) DEFAULT NULL,   SKSSetara int(11) DEFAULT '0',   GradeSetara varchar(5) DEFAULT NULL,   NotActive_KRS enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Status Akti Matakuliah jika N (Aktif) dan Y (Tidak Aktif)',   NotActive enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Status Akti Matakuliah jika N (Aktif) dan Y (Tidak Aktif)',   unipupd varchar(220) DEFAULT NULL,   angkatan char(4) DEFAULT NULL,   prckkn int(1) NOT NULL COMMENT 'proses kkn dari siakad (1 = sudah melakukan proses, 0 = belum melakukan proses kkn)',   st_abaikan int(1) NOT NULL DEFAULT '0' COMMENT 'Abaikan data Feeder',   enkripsi text NOT NULL COMMENT 'Enkripsi Dari Form Jadwal Untuk Input Nilai',   enkripsi_mhs text NOT NULL COMMENT 'Enkripsi Dari Form KRS',   unip_wali varchar(50) NOT NULL COMMENT 'user nip wali mahasiswa ',   user_abaikan varchar(25) NOT NULL COMMENT 'User yang melakukan abaikan KRS Mahasiswa',   error_code varchar(30) NOT NULL COMMENT 'Error Code dari Feeder',   error_desc varchar(150) NOT NULL COMMENT 'Error Deskripsi dari Feeder',   cluster_siakad varchar(15) NOT NULL,   st_wali int(1) NOT NULL DEFAULT '1',   prcAbsen int(11) NOT NULL DEFAULT '0' COMMENT 'untuk menandasi absensi mahasiswa yang sudah selesai di proses presentase kehadirannya' ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
        $addPrimaryKey = "ALTER TABLE _v2_krs$tahun ADD PRIMARY KEY (ID)";
        $modifyId = "ALTER TABLE _v2_krs$tahun MODIFY ID int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID numerik (nomor) Autoicrement, ter isi secara otomatis'";
        $addTrigerInsert = "CREATE TRIGGER log_nilai_krs_".$tahun."_insert AFTER INSERT ON _v2_krs".$tahun."  FOR EACH ROW BEGIN     INSERT INTO _v2_log_nilai_dbs     set tbl_name = '_v2_krs".$tahun."',      id_perubahan_lama = 'insert',     id_perubahan_baru = NEW.id,     NIM_lama = 'insert',     NIM_baru=new.NIM,     IDJadwal_lama = 'insert',     IDJadwal_baru = new.IDjadwal,     IDMK_lama = 'insert',     IDMK_baru = new.IDMK,     GradeNilai_lama = 'insert',     GradeNilai_baru = new.GradeNilai,     Bobot_lama = 'insert',     Bobot_baru = new.Bobot,     Datetime = NOW(),     log_user_db = USER(); END ";
        $addTrigerUpdate = "CREATE TRIGGER log_nilai_krs_".$tahun."_update BEFORE UPDATE ON _v2_krs".$tahun."  FOR EACH ROW BEGIN     INSERT INTO _v2_log_nilai_dbs     set tbl_name = '_v2_krs".$tahun."',     id_perubahan_lama = OLD.id,     id_perubahan_baru = NEW.id,     NIM_lama = OLD.NIM,     NIM_baru=new.NIM,     IDJadwal_lama = OLD.IDjadwal,     IDJadwal_baru = new.IDjadwal,     IDMK_lama = OLD.IDMK,     IDMK_baru = new.IDMK,     GradeNilai_lama = OLD.GradeNilai,     GradeNilai_baru = new.GradeNilai,     Bobot_lama = OLD.Bobot,     Bobot_baru = new.Bobot,     Datetime = NOW(),     log_user_db = USER(); END ";
        $addTrigerDelete = "CREATE TRIGGER log_nilai_krs_".$tahun."_delete AFTER DELETE ON _v2_krs".$tahun."  FOR EACH ROW BEGIN     DECLARE vUser varchar(50);     SELECT USER() INTO vUser;     INSERT INTO _v2_log_nilai_dbs     set tbl_name = '_v2_krs".$tahun."',      id_perubahan_lama = OLD.id,     id_perubahan_baru = 'Delete',     NIM_lama = OLD.NIM,     NIM_baru= 'Delete',     IDJadwal_lama = OLD.IDjadwal,     IDJadwal_baru = 'Delete',     IDMK_lama = OLD.IDMK,     IDMK_baru = 'Delete',     GradeNilai_lama = OLD.GradeNilai,     GradeNilai_baru = 'Delete',     Bobot_lama = OLD.Bobot,     Bobot_baru = 'Delete',     Datetime = NOW(),     log_user_db = vUser; END ";

        # eksekusi query menggunakan TRANSACTION
        $this->db->trans_start(TRUE);
        $this->db->query($creatTable);
        $this->db->query($addPrimaryKey);
        $this->db->query($modifyId);
        $this->db->query($addTrigerInsert);
        $this->db->query($addTrigerUpdate);
        $this->db->query($addTrigerDelete);
        $this->db->trans_complete();
        return $this->db->trans_status(); # mengembalikan status TRANSACTION TRUE jika berhasil FALSE juka gagal (jika gagal query dibatalkan)
    }
}	