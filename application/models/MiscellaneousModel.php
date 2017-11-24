<?php
class MiscellaneousModel extends CI_Model {

	function __construct(){
		parent::__construct();		
	}
	
	function getEmployee(){	
		$this->db->select("EMPLOYEE_ID,EMPLOYEE_NAME");
		$this->db->from('trn_employee');				
		$query = $this->db->get();		
		return $query->result();			
	}
	
}