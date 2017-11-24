<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Serialize extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		//$this->load->model('m_provinsi');
	}

	function index() {
		$this->load->view('v_serialize');
	}

	function getSerialize(){
        if('IS_AJAX') {
        	//print_r($_POST);
        	var_dump(unserialize($_POST));

        }
		
	}

}