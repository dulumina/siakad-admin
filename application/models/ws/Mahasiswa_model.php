<?php

class Mahasiswa_model extends CI_Model
{

    public $select = "NIM, Name, Sex, TempatLahir, TglLahir, Alamat, KodeFakultas, KodeJurusan, Status, KodeProgram, StatusAwal, Semester, TahunAkademik ";
    //method Mengambil data Mahasiswa
    public function getMahasiswa($nim = null, $select=false)
    {
        $l = $this->input->get('limit');
        $o = $this->input->get('offset');
        $kdf = $this->input->get('KodeFakultas');
        $kdj = $this->input->get('KodeProdi');
        $stts = $this->input->get('status');
        if ($kdf) {
            $this->db->where('KodeFakultas',$kdf);
        }
        if ($kdj) {
            $this->db->where('KodeJurusan',$kdj);
        }
        if ($l) {
            if ($o) {
                $this->db->limit($l,$o);
            }else {
                $this->db->limit($l);
            }
        }

        if (!$select) {
            $this->db->select($this->select);
        }else {
            $this->db->select($select);
        }
        
        if ($nim) {
            $this->db->where('NIM', $nim);
        }
        if ($stts) {
            $this->db->where('status',$stts);
        }else {
            $this->db->where_in('status',['A','C','U']);
        }
        
        $res = $this->db->get('_v2_mhsw')->result_array();

        return $res;
        // return $this->db->last_query();
    }

    //method Menghapus data mahasiswa
    public function deleteMahasiswa($nim)
    {
        $this->db->delete('_v2_mhsw', ['NIM' => $nim]);
        return $this->db->affected_rows();
    }

    //method Membuat data mahasiswa baru
    public function createMahasiswa($data)
    {
        $this->db->insert('_v2_mhsw', $data);
        return $this->db->affected_rows();
    }

    //method Mengubah data mahasiswa
    public function updateMahasiswa($data, $nim)
    {
        $this->db->update('_v2_mhsw', $data, ['NIM' => $nim]);
        return $this->db->affected_rows();
    }
}
