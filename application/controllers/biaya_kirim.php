<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Biaya_Kirim extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_ongkir');
		$this->load->helper('url');
	}

	function index() {
		$this->load->view('v_ongkir');
	}

	function select_ongkir(){
        if('IS_AJAX') {
        	$data['price'] = $this->m_ongkir->getprice();		
			$this->load->view('biaya',$data);

			//print_r($data);
        }
		
	}
}