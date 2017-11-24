<?php

class M_tags extends CI_Model {

	var $table = 'tag';
    var $table2 = 'tagmap';
	function __construct() {
        parent::__construct();
    }

    function getAll() {
    	$getb = $this->db->get($this->table);
    	return $getb;
    }

    function delete($key){
        $this->db->where('id',$key);
        $this->db->delete($this->table);
    }    

    //fungsi insert ke database
    function get_insert($data){
       	$this->db->insert($this->table2, $data);
      	return TRUE;
    }

    function get_update($data, $key){
        $this->db->where("id", $key);
        $this->db->update($this->table, $data);
        return TRUE;
    }

    function getData($key) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->like('name', $key);
        $this->db->limit(10);
        
        $query = $this->db->get();

        $json = [];
        foreach ($query->result_array() as $row)
        {   
            $json[] = $row['name'];
        }

        echo json_encode($json);
    }

}