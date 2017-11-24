<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
	}

	function index() {
		$this->load->view('v_pdf');
	}

	
}