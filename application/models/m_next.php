<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_next extends CI_Model {

	function getData($id) {
		$this->db->select('*');
		$this->db->where('propinsi_id', $id);
		$query = $this->db->get('propinsi');
		$hasil = $query->result();
        return $query;
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */ 
