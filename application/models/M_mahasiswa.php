<?php

class M_mahasiswa extends CI_Model {

	var $table = 'pw_mst_mahasiswa';
	function __construct() {
        parent::__construct();
    }

    function getMahasiswa() {
    	$getb = $this->db->get($this->table);
    	return $getb;
    }

    function delete($key){
        $this->db->where('nim',$key);
        $this->db->delete($this->table);
    }    

    //fungsi insert ke database
    function get_insert($data){
       	$this->db->insert($this->table, $data);
      	return TRUE;
    }

    function get_update($data, $key){
        $this->db->where("nim", $key);
        $this->db->update($this->table, $data);
        return TRUE;
    }

    function getData($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('nim',$id);
        $query = $this->db->get();

        foreach ($query->result_array() as $row)
        {   
            $nama = $row['nama_mhs'];
            $nim = $row['nim'];
            $gender = $row['kelamin'];
            $angkatan = $row['angkatan'];
            $kode = $row['kode_jur'];
            $program = $row['program'];
            $email = $row['email'];
            $pass = $row['password'];
        }

        $json = array(
                "nama" => $nama,
                "nim" => $nim,
                "gender" => $gender,
                "angkatan" => $angkatan,
                "kode" => $kode,
                "program" => $program,
                "email" => $email,
                "pass" => $pass
        );

        header("Content-Type: application/json", true);

        echo json_encode($json);
    }

    public function getAllData() {
        $this->db->select("*");
        $this->db->from("pw_mst_mahasiswa");
        $this->db->order_by('nim', 'desc');
        $query = $this->db->get();

        $no = 1;
        foreach ($query->result() as $row)
        {   
            
            echo "<tr>";
            echo "<td class='text-center'><input type='checkbox' class='checkitem' value='".$row->nim."'></td>";
            echo "<td>".$no."</td>";
            echo "<td>".$row->nama_mhs."</td>";
            echo "<td>".$row->nim."</td>";
            echo "<td>".$row->angkatan."</td>";
            echo "</tr>"; 
            $no++;
        }
    }

    function deleteID($id) {
        $this->db->query("DELETE FROM pw_mst_mahasiswa WHERE nim IN ($id)");
    }


}
