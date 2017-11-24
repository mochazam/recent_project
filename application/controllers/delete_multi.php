<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Delete_multi extends CI_controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_mahasiswa'));
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
		date_default_timezone_set('Asia/Jakarta');
	}

	function index() {
		$this->load->view('multi');	
	}

	function getAllData() {	
		$result = $this->M_mahasiswa->getAllData();
        return $result;
	}

	function delAll() {
		if('IS_AJAX') {
			$myid = $this->input->post('id');
			$id = str_replace(' ', ',', $myid);
		}

		$result = $this->M_mahasiswa->deleteID($id);

		return $result;	
	}

}	