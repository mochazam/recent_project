<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Filter_check extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_provinsi');
	}

	function index() {
		$data['provinsi'] = $this->m_provinsi->getProvinsi();
		$this->load->view('v_filter', $data);
	}

	function select_provinsi(){
        if('IS_AJAX') {
        	$data['kota'] = $this->m_provinsi->getkota();		
			$this->load->view('kota',$data);

			echo $this->input->post('filter');
        }
		
	}

}