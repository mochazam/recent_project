<?php

class Account extends CI_Controller{

	function __construct(){
   		parent::__construct();
	   	$this->load->helper(array('form', 'url'));
	   	$this->load->library('form_validation');
	}

	function index() {
	   	$data['title'] = 'CI error validation using jQuery Ajax';
	   	$this->load->view('signup', $data);
	}

  	function signup() {  
	   	$this->form_validation->set_rules('un', 'Username', 'trim|required');
	   	$this->form_validation->set_rules('pw', 'Password', 'trim|required');
	   	$this->form_validation->set_rules('pw1', 'Password Confirmation', 'trim|required|matches[pw]');
	   	if ($this->form_validation->run() == FALSE) {
	    	echo validation_errors();
	   	} else {
    		//TODO: Logic for user registration.
   		}  
  	}
} 