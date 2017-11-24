<?php 

class M_model extends CI_Model {
	
	function getDataKota() {
		$query = "select * from kota";
		$q = $this->db->query($query);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	function getDataKecamatan($id_kota) {
		$query = "select * from kecamatan where id_kota = '$id_kota'";
		$q = $this->db->query($query);
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
}