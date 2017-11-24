<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Kredit_motor extends CI_controller 
{
	function __construct(){
		parent::__construct();
	}

	function index(){
		$this->load->view('kredit');
	}

}