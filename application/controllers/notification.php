<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Notification extends CI_controller 
{

	public function __construct() {
        parent::__construct();   
        $this->load->model(array('m_notify'));
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));    
    }
 
    function index() {
    	$this->load->view('notify');  
    }

    function getNotif() {
    	if ('IS_AJAX') {
    		$view = $this->input->post('view');
    		
    	}
    	if ($view != '') {
			$data = array('comment_status' => 1);
			$this->m_notify->get_update($data, 0);
    	}
    	$result = $this->m_notify->getData();
        return $result;
    }

	function storeNotif() {
		if ('IS_AJAX') {
			$subject = $this->input->post('subject');
			$comment = $this->input->post('comment');
		}	
		$data = array(
    		'comment_subject' => $subject,
    		'comment_text' => $comment
    	);
    	$result = $this->m_notify->get_insert($data);
    	return $result;
	}   

}	