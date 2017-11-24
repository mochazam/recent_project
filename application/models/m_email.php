<?php

class M_email extends CI_Model {

	var $table = 'tag';
	function __construct() {
        parent::__construct();
    }

	function is_email_available($email) {
		$this->db->where('email', $email);
		$query = $this->db->get($this->table);

		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}   

}