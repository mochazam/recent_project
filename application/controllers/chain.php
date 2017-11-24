<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chain extends CI_Controller {

	function __construct() {
		parent::__construct();
		//$this->load->library('');
		//$this->load->helpers('');

	} 

	public function index()
	{
	    $this->load->model('m_chain');
	    $result['list']=$this->m_chain->getCountry();
	    $this->load->view('v_chain',$result);
	}

 	public function loadData()
	{
	    $loadType=$_POST['loadType'];
	    $loadId=$_POST['loadId'];
	    $this->load->model('m_chain');
	    $result=$this->m_chain->getData($loadType,$loadId);
	    $HTML="";

	    if($result->num_rows() > 0){
	     	foreach($result->result() as $list){
	       		$HTML.="<option value='".$list->id."'>".$list->name."</option>";
	     	}
	    }
	    echo $HTML;
	}
}