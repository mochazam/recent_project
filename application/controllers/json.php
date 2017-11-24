<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Json extends CI_controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_mahasiswa'));
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
		date_default_timezone_set('Asia/Jakarta');
	}

	function index() {
		$this->load->view('json');	
	}

	function getAllData() {
		if('IS_AJAX') {
			$id_mhs = $this->input->post('id_mahasiswa');
		}	
		$result = $this->M_mahasiswa->getData($id_mhs);
        return $result;
	}

}	