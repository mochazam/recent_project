<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Email_available extends CI_controller 
{

	public function __construct() {
        parent::__construct();   
        $this->load->model(array('m_email'));
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));    
    }
 
    function index() {
    	$data['title'] = "Check Email Availibility";
    	$this->load->view('email_availibility', $data);  
    }

    function check_email_availibility() {
    	if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) {
    		echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"> Invalid Email</span></label>';
    	} else {
    		if ($this->m_email->is_email_available($this->input->post('email'))) {
    			echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"> Email Already Register</span></label>';	
    		} else {
    			echo '<label class="text-success"><span class="glyphicon glyphicon-ok"> Email Available</span></label>';
    		}
    	}
    }
    

}	