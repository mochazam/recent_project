<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Filter extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
		$this->load->model('m_filter');
	}

	function index() {
		//$this->load->view('filter');
		$this->load->view('filter2');
	}
/*
	function fetch() {
		$city = $this->input->post("kota");
		
		$result = $this->m_filter->getFetchData($city);	
		return $result;
	}
*/
	function fetch2() {
		$ccheck = $this->input->post("ccheck");

		$WHERE = array(); $inner = $w = '';

		if(!empty($ccheck)) {
			if(strstr($ccheck,',')) {
				$data2 = explode(',',$ccheck);
				$carray = array();
				foreach($data2 as $c) {
					$carray[] = "state_id = $c";
				}
				$WHERE[] = '('.implode(' OR ',$carray).')';
			} else {
				$WHERE[] = '(state_id = '.$ccheck.')';
			}
		}

		$w = implode(' AND ',$WHERE);
		if(!empty($w)) $w = 'WHERE '.$w;

		$mysql_query = "SELECT * FROM city $w";

		$result = $this->m_filter->getFetchData2($mysql_query);	
		return $result;
	}

}