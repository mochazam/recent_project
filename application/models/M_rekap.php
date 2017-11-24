<?php

class M_rekap extends CI_Model{

    public function getData($mk, $tgl) {
    	/*
        $this->db->select("*");
        $this->db->from("absensi");
        $this->db->where("npm", $npm);
        $this->db->where("date", $tgl_sekarang);
        $this->db->where("matakuliah", $mk);
        $query = $this->db->get();
       	*/
        $query = $this->db->query("SELECT SUM(IF(`flag`='', status)) FROM absensi");

        //$query = $this->db->query("SELECT SUM(IF(`flag`='y', last_amount)) FROM absensi");
        return $query;
    }

}
