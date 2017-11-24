<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class User_online extends CI_controller 
{

	public function __construct() {
        parent::__construct();   
        $this->load->model(array('m_usr'));
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));    
    }
 
    public function index(){

		$logged_in = $this->session->userdata('logged_in');
        if($logged_in){
            $this->load->view('user_view');
        }else{            
            $this->load->view('login_usr');
        } 
        
	}

	public function getLogin(){
		
		$this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_error_delimiters('', '<br/>');

        if ($this->form_validation->run() == TRUE) {
           	$u = $this->input->post('email');// menampung isian username dari view login
			$p = $this->input->post('password'); //menampung isian password dari view login
			
			$user = $this->m_usr->getLogin($u,$p);//mengakses file m_login dan memberikan nilai user dan password 
        }
		
	}

	//fungsi buat logout aplikasi
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('user_online');
	}

	function update_user() {
		$action = $this->input->post('action');
		if ($action == 'update_time') {
			$data = array('last_activity' => date('Y-m-d H:i:s'));
			$this->db->where("login_details_id", $this->session->userdata('login_id'));
        	$this->db->update("login_details", $data);
		}
	}

	function fetch_user_online() {
		$action = $this->input->post('action');
		$result = $this->m_usr->getData();
		return $result;
	}

	public function admins() {
		$data['user_online'] = 'true';
		$this->load->view('adm_view', $data);
	}

	public function user_list() {
		$data['user_list'] = 'true';
		$this->load->view('user_list', $data);
	}

	function fetch_user() {
		$action = $this->input->post('action');
		$result = $this->m_usr->fetchData();
		return $result;
	}

	function change_status() {
		$action = $this->input->post('action');
		$user_id = $this->input->post('user_id');
		$user_status = $this->input->post('user_status');
		$result = $this->m_usr->changeStatus($user_id, $user_status);

		return $result;
	}

}	