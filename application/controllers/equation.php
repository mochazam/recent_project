<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Equation extends CI_controller 
{

	public function __construct() {
        parent::__construct();   
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));    
    }
 
    function index() {
    	$this->load->view('formula');  
    }

	function storeFormula() {
		$data = array(
            'kategori_id' => 2,
            'artikel_id' => 2,
            'nama_artikel' => $this->input->post('nama_artikel'),
            'slug' => url_title($this->input->post('nama_artikel')),
            'body' => $this->input->post('isi'),
            'date' => date('Y-m-d')
        );

		$query = $this->db->insert('artikel', $data);
		
    	if ($query) {
    		echo "your data is save!";
    	} else {
    		echo "error when save data!";
    	}
	}   

}	