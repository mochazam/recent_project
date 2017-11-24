<?php

class User_service extends CI_Model {
 	
 	public function __construct(){
		parent:: __construct();
		
	}

	public function send_htmltemp()
	{
	
	    $this->load->library('form_validation');
		//$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|xss_clean|trim');
		
		$this->form_validation->set_rules('txtEmail','emailId','required|valid_email|xss_clean|trim');

		
		//$this->form_validation->set_rules('txtName','Name','required|xss_clean|trim');


		if ($this->form_validation->run() == FALSE)
		{	  
			$this->settemplate->usertemp('user/contact_us',$this->data);
		}
		else
		{
            $sender_mail = 'contact@eknowledgetree.com';
                                       
			$data['mail']=$this->input->post('txtEmail');
			                                       
			$data['firstname']=$this->input->post('txtName');			
			$data['body']=$this->input->post('txtdescription');
			$this->load->library('email');
			$config = array(
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
			$this->email->initialize($config);
			$this->email->from($sender_mail,'User Enquiry ');
			$this->email->to($sender_mail);
			$this->email->subject('eKnowledgetree Enquiry Form');
				
			$emaildescription=$this->load->view('user/sampletemplate',$data,TRUE);

			$this->email->message($emaildescription);
			$result=$this->email->send();   
		    return $result;
		 
		}
	}

}