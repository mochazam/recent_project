<?php

class M_kuisioner extends CI_model {

	function getSoal() {
		$this->db->select("*");
	    $this->db->from("soal");
        $result = $this->db->get();
		
		return $result;
	}

	function getSkor() {
		$this->db->select("*");
	    $this->db->from("skor");
        $result = $this->db->get();

		return $result;
	}

}