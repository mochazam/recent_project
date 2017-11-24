<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Audio extends CI_controller 
{
	function __construct(){
		parent::__construct();
		//$this->load->model(array('M_audio'));
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
		date_default_timezone_set('Asia/Jakarta');
	}

	function index() {
		$this->load->view('audio');	
	}

	function upload() {
		$config['upload_path'] = './upload'; //path folder
		//$config['upload_path'] = realpath(APPPATH.'../upload/');
	    $config['max_size']    = '70000';
	    $config['allowed_types'] = '*';

	    $this->load->library('upload');
		$this->upload->initialize($config);

		//$this->upload->do_upload('userfile');

		print_r($_FILES['userfile']['type']);
		print_r($_FILES['userfile']['name']);

		

	    if (!$this->upload->do_upload('userfile')) {
	        $data = array('msg' => $this->upload->display_errors());

	    } else { //else, set the success message
	        $data = array('upload_data' => $this->upload->data());
	        $field = 'userfile';                        
	        var_dump($_FILES[$field]['type']);
	    }

	    
	}

	

}	