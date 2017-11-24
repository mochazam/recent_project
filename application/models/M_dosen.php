<?php

class M_dosen extends CI_Model {

	var $table = 'ja_mst_dosen';
	function __construct() {
        parent::__construct();
    }

    function getDosen() {
    	$getb = $this->db->get($this->table);
    	return $getb;
    }

    function delete($key){
        $this->db->where('kode_dosen',$key);
        $this->db->delete($this->table);
    }    

    //fungsi insert ke database
    function get_insert($data){
       	$this->db->insert($this->table, $data);
      	return TRUE;
    }

    function get_update($data, $key){
        $this->db->where("kode_dosen", $key);
        $this->db->update($this->table, $data);
        return TRUE;
    }

}
