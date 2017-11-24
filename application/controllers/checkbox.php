<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkbox extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	function index() {
		$this->load->view('v_checkbox');
	}

	function getSerialize(){
        if('IS_AJAX') {
        	print_r($_POST);
        }
		
	}

}