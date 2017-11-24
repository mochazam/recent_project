<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kuisioner extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
		$this->load->model('m_kuisioner');
	}

	function index() {
		$data['soal'] = $this->m_kuisioner->getSoal();
		$data['skor'] = $this->m_kuisioner->getSkor();
		$this->load->view('v_kuisioner', $data);
	}

	function submit(){
        
		
	}

}