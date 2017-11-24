<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sort_ongkir extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_ongkir');
		$this->load->helper('url');
	}

	function index() {
		$data['drop'] = $this->m_ongkir->getProv();
		 
		 
		$this->load->view('v_sort_ongkir',$data);

	}

	function get_kota(){
		$this->load->model('data');
        $result = $this->data->get_kota_by();
        return $result;
/*
        if('IS_AJAX') {
        	$data['browse'] = $this->m_ongkir->get_kab($this->input->post('id_prov'));		
			$this->load->view('v_sort_ongkir',$data);

        }
*/        
	}
}