<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quiz extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
		$this->load->model('m_quiz');
	}

	function index() {
		$this->load->view('quiz');
	}

	function submit(){
        
		
	}

}