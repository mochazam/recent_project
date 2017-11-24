<?php 

class M_provinsi extends CI_Model {

	function __construct() {
		parent::__construct();
	}

    function getProvinsi(){
        $this->db->select('*');
        return $result = $this->db->get('provinsi');
    }

	function getkota(){
        $provinsi_id = $this->input->post('filter');
        //$provinsi_id = $this->input->post('provinsi_id');
        
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('id_provinsi',$provinsi_id);
        $result = $this->db->get();
        
        return $result;
    }

} 