<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modal extends CI_Controller {

	
	function __construct()
    {
        parent::__construct();	
        $this->load->helper(array('form'));	
        $this->load->model('M_matakuliah');
    }
	
	public function index()
	{
		
	}
	
	function popup($page_name = '' , $param2 = '' , $param3 = '')
	{
		//$page_name = 'modal_jadwal_edit';
		$data_page['param2']		=	$param2;
		$data_page['param3']		=	$param3;
		$this->load->view( $page_name.'.php' ,$data_page);
		
	}
}

