<?php

class M_qurban extends CI_Model {

	var $table = 'qurban';
	function __construct() {
        parent::__construct();
    }

    function getQurban() {
    	$this->db->select("*");
        $this->db->from($this->table);
		$query = $this->db->get();

    	return $query;
    }

    function getListQurban($key) {
        $this->db->select("*");
        $this->db->where('group', $key);
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query;
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


}
