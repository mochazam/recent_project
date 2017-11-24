<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Encode extends CI_controller{

	function __construct(){
		parent::__construct();
		$this->load->model('json_model');
		//$this->load->helper('url');
	}

	function index(){
		$this->load->view('encode_view');
	}

	function select_harga(){
        if('IS_AJAX') {
        	$data['price'] = $this->json_model->getprice();		
			$this->load->view('biaya',$data);

			//print_r($data);
        }
		
	}
}