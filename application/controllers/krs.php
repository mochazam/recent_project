<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Krs extends CI_controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_matakuliah', 'app_model'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
    }

    function index(){
        $this->app_model->getLogin();
        
        $this->log_mkAmbil();
    }

    public function delete_data() {
        $this->load->model('Queries');
        $result = $this->Queries->delete_data();
        return $result;
    }

    function added_log() {
       $years = date('Y') - 1;
        $months = date('m');
        $dwisem = array('gasal', 'genap');
        if ($months < 6) {
            $sem = $dwisem[0];
        }  
        else {
            $sem = $dwisem[1];
        }
        $sem_total = $sem . "-" . $years;
        
        if('IS_AJAX') {
            $data = array(
                  'nim' => $this->input->post('mhs'),
                  'kode_mk' => $this->input->post('mk'),
                  'kode_thn' => $sem_total,
                  'semester_ditempuh' => $this->input->post('semester')
                );
            $this->db->insert('mk_ambil',$data);
        }   
    }	

	function log_mkAmbil() {
        $this->app_model->getLogin();

		$this->load->view('krs');
	}

	function retrieve_mkAmbil() {
		if('IS_AJAX') {
			$key = $this->input->post('id');
		}	
		$key = $this->input->post('id');
		$semester = $this->input->post('sms');
		$this->load->model('M_matakuliah');
		$result = $this->M_matakuliah->get_Mkambil($key, $semester);
        return $result;
	}

}