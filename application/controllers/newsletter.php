<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	function index() {
		$this->load->view('v_newsletter');
	}

	function subscriber() {
		if('IS_AJAX') {
			$news = $this->input->post('news');
			$data = array(
	              'email' => $news,
	              'status' => 1,
	              'tgl_post' => date('Y-m-d'),
	            );
			$this->db->insert('email',$data);
		}
	}


}	