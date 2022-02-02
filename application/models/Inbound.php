<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inbound extends CI_Model
{

    function dosen()
    {
        $ulevel = $this->session->userdata('ulevel');
        $kdf = $this->session->userdata('kdf');
        $unip = $this->session->userdata("unip");
        $this->db->distinct();
        $this->db->select('_v2_krsmbkm.id_jadwal, _v2_jadwal.IDDosen, _v2_dosen.Name, _v2_jurusan.Kode, _v2_jurusan.Nama_Indonesia, _v2_jurusan.KodeFakultas');
        $this->db->join('_v2_jadwal', '_v2_jadwal.IDJADWAL=_v2_krsmbkm.id_jadwal');
        $this->db->join('_v2_dosen', '_v2_dosen.nip=_v2_jadwal.IDDosen');
        $this->db->join('_v2_jurusan', '_v2_jurusan.Kode=_v2_dosen.KodeJurusan');
        if ($ulevel == 3) {
            $this->db->where('_v2_dosen.nip', $unip);
        } elseif ($ulevel == 5) {
            $this->db->where('_v2_jurusan.KodeFakultas', $kdf);
        }
        return $this->db->from('_v2_krsmbkm')
            ->get()
            ->result();
    }


    function mk($nip)
    {
        $this->db->distinct();
        $this->db->select('_v2_krsmbkm.id_jadwal, _v2_jadwal.IDDosen, _v2_dosen.Name, _v2_jadwal.KodeMK, _v2_jadwal.NamaMK');
        $this->db->join('_v2_jadwal', '_v2_jadwal.IDJADWAL=_v2_krsmbkm.id_jadwal');
        $this->db->join('_v2_dosen', '_v2_dosen.nip=_v2_jadwal.IDDosen');
        $this->db->where('_v2_jadwal.IDDosen', $nip);
        $this->db->order_by('_v2_jadwal.IDDosen', 'ASC');
        return $this->db->from('_v2_krsmbkm')
            ->get()
            ->result();
    }

    function krs($tahunakademik, $dosen, $mk)
    {
        $this->db->select('_v2_krsmbkm.id_jadwal, _v2_krsmbkm.nim, _v2_mhsw_pmmdn.name, _v2_mhsw_pmmdn.univ_asal, _v2_krsmbkm.tahun, _v2_krsmbkm.nilai, _v2_jadwal.KodeMK, _v2_jadwal.NamaMK, _v2_jadwal.IDDosen, _v2_dosen.Name as namadosen, _v2_krsmbkm.id, fakultas.Nama_indonesia, _v2_jurusan.Nama_Indonesia as prodi, _v2_jadwal.Keterangan');
        $this->db->join('_v2_jadwal', '_v2_jadwal.IDJADWAL=_v2_krsmbkm.id_jadwal');
        $this->db->join('_v2_dosen', '_v2_dosen.nip=_v2_jadwal.IDDosen');
        $this->db->join('_v2_mhsw_pmmdn', '_v2_mhsw_pmmdn.nim=_v2_krsmbkm.nim');
        $this->db->join('fakultas', 'fakultas.Kode=_v2_jadwal.KodeFakultas');
        $this->db->join('_v2_jurusan', '_v2_jurusan.Kode=_v2_jadwal.KodeJurusan');
        $this->db->where('_v2_krsmbkm.tahun', $tahunakademik);
        $this->db->where('_v2_jadwal.IDDosen', $dosen);
        $this->db->where('_v2_jadwal.KodeMK', $mk);

        $this->db->order_by('_v2_jadwal.IDDosen', 'ASC');
        return $this->db->get('_v2_krsmbkm')->result();
    }

    function in_nilai($id)
    {
        $this->db->select('_v2_krsmbkm.id_jadwal, _v2_krsmbkm.nim, _v2_mhsw_pmmdn.name, _v2_krsmbkm.tahun, _v2_krsmbkm.nilai, _v2_jadwal.KodeMK, _v2_jadwal.NamaMK, _v2_jadwal.IDDosen, _v2_dosen.Name, _v2_krsmbkm.id, _v2_krsmbkm.JmlHadir, _v2_krsmbkm.NilaiPraktek, _v2_krsmbkm.NilaiTugas, _v2_krsmbkm.NilaiNID, _v2_krsmbkm.NilaiUjian, _v2_krsmbkm.nilai, _v2_krsmbkm.GradeNilai');
        $this->db->join('_v2_jadwal', '_v2_jadwal.IDJADWAL=_v2_krsmbkm.id_jadwal');
        $this->db->join('_v2_dosen', '_v2_dosen.nip=_v2_jadwal.IDDosen');
        $this->db->join('_v2_mhsw_pmmdn', '_v2_mhsw_pmmdn.nim=_v2_krsmbkm.nim');
        $this->db->where('_v2_krsmbkm.id', $id);

        return $this->db->get('_v2_krsmbkm')->row();
    }

    function dosen_kelas($idjadwal){
        $query = "SELECT IDJADWAL,IDDosen ,_v2_dosen.Name nama_dosen
            FROM `_v2_jadwal`  
            JOIN _v2_dosen ON _v2_jadwal.IDDosen=_v2_dosen.nip
            WHERE IDJADWAL='$idjadwal' 
            UNION
            SELECT _v2_jadwalassdsn.IDJadwal,_v2_jadwalassdsn.IDDosen , _v2_dosen.Name nama_dosen
            FROM `_v2_jadwalassdsn` 
            JOIN _v2_dosen ON _v2_dosen.nip=_v2_jadwalassdsn.IDDosen
            WHERE IDJADWAL='$idjadwal'";
        $res['data'] = [];
        $data = $this->db->query($query);
        if($data->num_rows() > 0 ){
            $res['data'] = $data->result();
        }
        $res['query'] = $this->db->last_query();
        return $res;
    }

    function simpan_nilai($id, $hadir, $praktek, $tugas, $mid, $uas, $nilai, $grade)
    {
        $this->db->set('JmlHadir', $hadir);
        $this->db->set('NilaiPraktek', $praktek);
        $this->db->set('NilaiTugas', $tugas);
        $this->db->set('NilaiNID', $mid);
        $this->db->set('NilaiUjian', $uas);
        $this->db->set('nilai', $nilai);
        $this->db->set('GradeNilai', $grade);
        $this->db->where('id', $id);

        return $this->db->update('_v2_krsmbkm');
    }


    function mhs($nim)
    {
        $this->db->select('*');
        $this->db->where('nim', $nim);
        return $this->db->get('_v2_mhsw_pmmdn')->row();
    }

    function periode($nim)
    {
        $this->db->distinct();
        $this->db->select('tahun');
        $this->db->where('nim', $nim);


        return $this->db->get('_v2_krsmbkm')->result();
    }


    function khs($nim, $periode)
    {
        $this->db->select('_v2_krsmbkm.nim, _v2_mhsw_pmmdn.name, _v2_krsmbkm.tahun, _v2_jadwal.NamaMK, _v2_krsmbkm.nilai, _v2_krsmbkm.GradeNilai,_v2_jadwal.IDJADWAL');
        $this->db->join('_v2_mhsw_pmmdn', '_v2_mhsw_pmmdn.NIM = _v2_krsmbkm.nim');
        $this->db->join('_v2_jadwal', '_v2_jadwal.IDJADWAL= _v2_krsmbkm.id_jadwal');
        $this->db->where('_v2_mhsw_pmmdn.nim', $nim);
        $this->db->where('_v2_krsmbkm.tahun', $periode);
        return $this->db->get('_v2_krsmbkm')->result();
    }

    function cetak($nim, $periode)
    {
        $this->db->select('*');
        $this->db->join('_v2_mhsw_pmmdn', '_v2_mhsw_pmmdn.NIM = _v2_krsmbkm.nim');
        $this->db->join('_v2_jadwal', '_v2_jadwal.IDJADWAL= _v2_krsmbkm.id_jadwal');
        $this->db->where('_v2_mhsw_pmmdn.nim', $nim);
        $this->db->where('_v2_krsmbkm.tahun', $periode);
        return $this->db->get('_v2_krsmbkm')->result();
    }

    function tperiode($periode)
    {
        $this->db->select('*');
        $this->db->where('periode_aktif', $periode);
        return $this->db->get('_v2_periode_aktif')->row();
    }

    function grade_nilai($tahun, $total)
    {
        // $query = $this->db->query("SELECT * FROM _v2_nilai WHERE Kode='Umum' AND KodeFakultas='All' AND AngkatanKebawah=$tahun");
        $this->db->select('*');
        $this->db->where('Kode', 'Umum');
        $this->db->where('KodeFakultas', 'All');
        $this->db->where('AngkatanKebawah', $tahun);
        // return $query->result();
        return $this->db->get('_v2_nilai')->result();
    }
}
