<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	 
	class Mdl_onchange extends CI_Model {
	  
	  	/* fungsi untuk memanggil data pada table provinsi*/
	  	function get_provinsi() {
	   
	  		$query = $this->db->get('table_provinsi');
	  		return $query->result();
	  	}
	   
	  	/* fungsi untuk memanggil data pada table kota*/
	  	function get_kota() {
	   
	  		$query = $this->db->get('table_kota');
	  		return $query->result();
	   
	  	}

	  	function get_kecamatan() {
	   
	  		$query = $this->db->get('table_kecamatan');
	  		return $query->result();
	   
	  	}
	}
	 
	