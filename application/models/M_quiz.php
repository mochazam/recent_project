<?php

class M_Quiz extends CI_model {

	var $table = 'soal';
	var $table2 = 'skor';
	function __construct() {
        parent::__construct();
    }

    function getSoal() {
    	$getb = $this->db->get($this->table);
    	return $getb;
    }

    function delete($key){
        $this->db->where('id',$key);
        $this->db->delete($this->table);
    }    

    //fungsi insert ke database
    function get_insert($data){
       	$this->db->insert($this->table, $data);
      	return TRUE;
    }

    function get_update($data, $key){
        $this->db->where("id", $key);
        $this->db->update($this->table, $data);
        return TRUE;
    }

	function fetchSoal() {
		$query = $this->db->query('SELECT * FROM soal');

		$arr = array();

		foreach ($query->result_array() as $soal) {

			$arr[] = $soal;
		}

		$base_out = array();

	    // Kind of dirty, but doesnt hurt much with low number of records
	    foreach ($arr as $key => $record) {
	        // id_codes were necessary before, to keep track of ports (by id_code), 
	        // but they bother json now, so we do...
	        $base_out[] = $record;
	    }

	    $json = json_encode($base_out);

	    echo $json;
	}

	/////////////////////////////////////////////////////////////////////////

	function getSkor() {
    	$getb = $this->db->get($this->table2);
    	return $getb;
    }

    function delete_skor($key){
        $this->db->where('id',$key);
        $this->db->delete($this->table2);
    }    

    //fungsi insert ke database
    function get_insert_skor($data){
       	$this->db->insert($this->table2, $data);
      	return TRUE;
    }

    function get_update_skor($data, $key){
        $this->db->where("id", $key);
        $this->db->update($this->table2, $data);
        return TRUE;
    }

	function fetchSkor(){
		$query = $this->db->query('SELECT * FROM skor');

		$arr = array();

		foreach ($query->result_array() as $pilihan) {

			$arr[] = $pilihan;
		}

		$base_out = array();

	    // Kind of dirty, but doesnt hurt much with low number of records
	    foreach ($arr as $key => $record) {
	        // id_codes were necessary before, to keep track of ports (by id_code), 
	        // but they bother json now, so we do...
	        $base_out[] = $record;
	    }

	    $json = json_encode($base_out);

	    echo $json;
	}

}