<?php

class M_mutu extends CI_model {

	
	function getSoal() {
		$query = $this->db->query('SELECT id,soal FROM soal');

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

	function getSkor(){
		$query = $this->db->query('SELECT id,nilai FROM skor');

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