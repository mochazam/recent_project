<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Color_size extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_colorSize');
	}

	function index() {
		$data['colors'] = $this->m_colorSize->getActiveColors();
		$data['sizes'] = $this->m_colorSize->getActiveSizes();
		$this->load->view('v_colorSize', $data);
	}

}