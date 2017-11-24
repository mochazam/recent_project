<?php

class M_Filter extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->table = "city";
	} 

	function getFetchData($state) {
	    $this->db->select("*");
	    $this->db->from($this->table);
        $this->db->where_in("state_id", $state);
        $query = $this->db->get();

        foreach ($query->result() as $row)
        {   
            
            echo "<li>".$row->city_name."</li>";
        }
    }

    function getFetchData2($mysql_query) {
	    $query = $this->db->query($mysql_query);
	    
        foreach ($query->result() as $row)
        {   
            echo "<li>".$row->city_name."</li>";
        }
    }
} 