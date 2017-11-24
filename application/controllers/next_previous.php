<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Next_previous extends CI_Controller {

	// default id
	public $id = 7 ;

	function __construct() {
		parent::__construct();
		//$this->load->model('m_next');
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
	}

	function index() {
		
		$mysql = "select * from propinsi where propinsi_id = $this->id";
		$result = $this->db->query($mysql);
		$data['query'] = $result;
		$data['next_data'] = $this->get_next_id();
		$data['prev_data'] = $this->get_prev_id();
		//$data['query'] = $this->m_next->getData($this->id);
		$this->load->view('V_next', $data);
	}

	function get_next_id() {
		$mysql_next = "SELECT * FROM propinsi WHERE propinsi_id>$this->id ORDER BY propinsi_id ASC LIMIT 1";
		$result = $this->db->query($mysql_next);
		return $result;
	}

	function get_prev_id() {
		$mysql_prev = "SELECT * FROM propinsi WHERE propinsi_id<$this->id ORDER BY propinsi_id DESC LIMIT 1";
		$result = $this->db->query($mysql_prev);
		return $result;
	}

}