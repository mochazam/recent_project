<?php   if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email_html extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('user_service');
	
	}

	public function send_email(){
		$data= $this->user_service->send_htmltemp();
		if($data){
  			$this->session->set_flashdata('message',' Submitted Successfully');		
		
  			$this->settemplate->usertemp('user/Success',$data);

		}
		else{
			$this->settemplate->usertemp('user/contact_us',$data);
		}
	}
}