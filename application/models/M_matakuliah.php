<?php

class M_matakuliah extends CI_Model {

	var $table = 'ja_mst_mk';
    var $table2 = 'ja_tr_jadwal';
	function __construct() {
        parent::__construct();
    }

    function getMatakuliah() {
    	$getb = $this->db->get($this->table);
    	return $getb;
    }

    function getAmbilMk($key) {
        $this->db->select('mk_ambil.nim, mk_ambil.kode_mk, mk_ambil.kode_dosen, mk_ambil.kode_thn, mk_ambil.semester_ditempuh, ja_mst_dosen.kode_dosen, ja_mst_dosen.nama_dosen, ja_mst_mk.kode_mk, ja_mst_mk.nama_mk, pw_mst_mahasiswa.nama_mhs, pw_mst_mahasiswa.nim');
        $this->db->from('mk_ambil');
        $this->db->join('ja_mst_dosen', 'ja_mst_dosen.kode_dosen = mk_ambil.kode_dosen');
        $this->db->join('ja_mst_mk', 'ja_mst_mk.kode_mk = mk_ambil.kode_mk');
        $this->db->join('pw_mst_mahasiswa', 'pw_mst_mahasiswa.nim = mk_ambil.nim');
       	//$this->db->where("barang.kd_ktgr",$key);
        $query = $this->db->get();
        return $query;
    }

    function delete($key){
        $this->db->where('kode_mk',$key);
        $this->db->delete($this->table);
    }    

    //fungsi insert ke database
    function get_insert($data){
       	$this->db->insert($this->table, $data);
      	return TRUE;
    }

    function get_update($data, $key){
        $this->db->where("kode_mk", $key);
        $this->db->update($this->table, $data);
        return TRUE;
    }

    function dropdownMk($key, $thn, $hari)
    {
        $this->db->select('*');
        $this->db->from('ja_mst_mk');
        $this->db->join('mk_ambil', 'mk_ambil.kode_mk = ja_mst_mk.kode_mk');
        $this->db->join('ja_tr_jadwal', 'ja_tr_jadwal.kode_mk = ja_mst_mk.kode_mk');
        $this->db->join('ja_mst_dosen', 'ja_mst_dosen.kode_dosen = ja_tr_jadwal.kode_dosen');
        $this->db->where('nim',$key);
        $this->db->where('kode_thn',$thn);
        $this->db->where('jadwal',$hari);
        $query = $this->db->get();
        $hasil = $query->result();
        return $hasil;  
    }

    /*************************************************************/

    function getJadwalMk() {
        $this->db->select('*');
        $this->db->from('ja_tr_jadwal');
        $this->db->join('ja_mst_dosen', 'ja_mst_dosen.kode_dosen = ja_tr_jadwal.kode_dosen');
        $this->db->join('ja_mst_mk', 'ja_mst_mk.kode_mk = ja_tr_jadwal.kode_mk');
        $query = $this->db->get();
        return $query;
    }

    function setJadwalMk($key) {
        $this->db->select('*');
        $this->db->from('ja_tr_jadwal');
        $this->db->join('ja_mst_dosen', 'ja_mst_dosen.kode_dosen = ja_tr_jadwal.kode_dosen');
        $this->db->join('ja_mst_mk', 'ja_mst_mk.kode_mk = ja_tr_jadwal.kode_mk');
        $this->db->where('id_jadwal', $key);
        $query = $this->db->get();
        return $query;
    }

    function delete_jdwl($key){
        $this->db->where('id_jadwal',$key);
        $this->db->delete($this->table2);
    }    

    //fungsi insert ke database
    function get_insert_jdwl($data){
        $this->db->insert($this->table2, $data);
        return TRUE;
    }

    function get_update_jdwl($data, $key){
        $this->db->where("id_jadwal", $key);
        $this->db->update($this->table2, $data);
        return TRUE;
    } 

    public function get_MkAmbil($key, $semester) {
        date_default_timezone_set('Asia/Jakarta');
        error_reporting(-1);
        $tgl_sekarang = date("Y-m-d");
        //$key = 1111312;
        $this->db->select('*');
        $this->db->select('mk_ambil.id, mk_ambil.nim, mk_ambil.kode_mk, mk_ambil.kode_thn, mk_ambil.semester_ditempuh, ja_tr_jadwal.kode_mk, ja_tr_jadwal.jadwal, ja_tr_jadwal.kode_dosen,   ja_mst_dosen.kode_dosen, ja_mst_dosen.nama_dosen as dosen, ja_mst_mk.kode_mk, ja_mst_mk.nama_mk, ja_mst_mk.jum_sks');
        $this->db->from('mk_ambil');
        $this->db->join('ja_mst_mk', 'mk_ambil.kode_mk = ja_mst_mk.kode_mk');
        $this->db->join('ja_tr_jadwal', 'ja_tr_jadwal.kode_mk = ja_mst_mk.kode_mk');
        $this->db->join('ja_mst_dosen', 'ja_tr_jadwal.kode_dosen = ja_mst_dosen.kode_dosen');
        $this->db->where("mk_ambil.nim",$key);
        $this->db->where("mk_ambil.semester_ditempuh",$semester);
        $query = $this->db->get();

        $no = 1;
        foreach ($query->result() as $row)
        { 

            $action = "<a href=\"#myModal2\" class=\"icon huge\" data-toggle=\"modal\"><i class=\"fa fa-trash-o\"></i></a>&nbsp;";

            $action .= "
                        <!-- Modal -->
                        <div id=\"myModal2\" class=\"modal hide fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel1\" aria-hidden=\"true\">
                            <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                                <h3 id=\"myModalLabel1\">Are you sure ?</h3>
                            </div>
                            
                            <div class=\"modal-footer\">
                                <button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">Cancel</button>
                                <a href=".base_url('krs/go/delete/'.$row->id)." class=\"btn btn-danger\" aria-hidden=\"true\">Delete</a>
                            </div>
                        </div>";   

          
            echo "<tr>";
            echo "<td>".$no."</td>";
            echo "<td>".$row->nama_mk."</td>";
            echo "<td>".$row->jum_sks."</td>";
            echo "<td>".$row->nama_dosen."</td>";
            echo "<td>".$row->jadwal."</td>";
            echo "<td> R.".$row->ruang."</td>";
            echo "<td>".$row->jam.".00 </td>";
            echo "<td>"."<button class=\"btn btn-sm btn-danger\" onclick=\"delete_data('".$row->id."','".$row->nama_mk."');\">Delete</button></td>";
            echo "</tr>"; 
            $no++;
        }
    } 

}