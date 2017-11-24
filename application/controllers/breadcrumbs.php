<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Breadcrumbs extends CI_controller 
{

	public function __construct() {
        parent::__construct();   
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
    }
 
    function index() {
    	$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => 'Penerbit',
			'href' => 'inter/milan'
		);
		$data['breadcrumbs'][] = array(
			'text' => '',
			//'href' => ''
		);
        $this->load->view('v_bread', $data);
    }

  

	

}	