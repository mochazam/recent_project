<?php

class M_Compare extends CI_Model{
    //put your code here
    
    public function getData() {
        error_reporting(-1);
        $matakuliah = 1111502;
        //$tgl = ;
        $query = $this->db->query('SELECT mk.nim, mk.kode_mk FROM mk_ambil mk WHERE NOT EXISTS (SELECT * FROM absensi a WHERE mk.kode_mk = 1111502)');
        return $query;
       
    }
}