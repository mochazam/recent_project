<?php
class Dashboard extends CI_Controller{
 	
 	function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
		$this->load->model('dashboardmodel');
	}

	function index() {
		$this->load->view('insertform');
	}

	function insert() {

	  	$brandname = $this->input->post("brand_name");
	  	$dealername = $this->input->post("dealername");
	  	$emailid = $this->input->post("emailid");
	  	$webaddress = $this->input->post("webaddress");
	  	$city = $this->input->post("city");
	  	$contactno = $this->input->post("contactno");
	  	$state = $this->input->post("state");

	   	$branddet = array(
	   		'brandname' => $brandname ,
	   		'dealername' => $dealername ,
	   		'emailid' =>   $emailid,
	   		'webaddress' => $webaddress,
	   		'city' => $city ,
	   		'contactno' => $contactno,
	   		'state' => $state
	    );
	
	 	$this->db->insert('branddetails', $branddet);
	 	
	}
}	
