<?php

class M_kelas extends CI_Model{

	public function get_klsMk($key, $semester) {
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(-1);
        //$tgl_sekarang = date("Y-m-d");
        $this->db->select('mk_ambil.nim, mk_ambil.kode_mk, mk_ambil.semester_ditempuh, ja_mst_mk.kode_mk, ja_mst_mk.nama_mk, pw_mst_mahasiswa.nama_mhs as mahasiswa, pw_mst_mahasiswa.nim as npm');
        $this->db->from('mk_ambil');
        //$this->db->join('ja_mst_dosen', 'mk_ambil.kode_dosen = ja_mst_dosen.kode_dosen');
        $this->db->join('ja_mst_mk', 'mk_ambil.kode_mk = ja_mst_mk.kode_mk');
        $this->db->join('pw_mst_mahasiswa', 'mk_ambil.nim = pw_mst_mahasiswa.nim');
        $this->db->where("mk_ambil.kode_mk",$key);
        $this->db->where("mk_ambil.semester_ditempuh",$semester);
        $query = $this->db->get();

        $no = 1;
        foreach ($query->result() as $row)
        {   
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$row->mahasiswa."</td>";
            echo "<td>".$row->nim."</td>";
            //echo "<td>".$row->dosen."</td>";
            //echo "<td>".$reformatted_time."</td>";
            //echo "<td>".$status."</td>";
            echo "</tr>"; 
            $no++;
        }
    }

}
