<?php

class Nim extends CI_Controller{

	function __construct(){
   		parent::__construct();
	   	$this->load->helper(array('form', 'url'));
	   	$this->load->library('form_validation');
	}

	function index() {
	 	$no = 24;
	   	$tahun = date("y");
	   	echo $no.$tahun.'100';
	   	echo '<br>';
	   	$this->db->select_max('nim');
	   	$query = $this->db->get('pw_mst_mahasiswa');
	   	foreach ($query->result() as $row) {
	   		echo $row->nim+1;
	   	}
	}

  
} 