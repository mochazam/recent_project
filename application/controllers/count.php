<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Count extends CI_controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_count'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
	}

	function index(){
		$this->go($param1 = '', $param2 = '', $param3 = '');
	}

	function go($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
            $this->form_validation->set_rules('title', 'title', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                        'title' => $this->input->post('title'),
                        'date' => date('Y-m-d'),
                        'time' => date('H:i:s')
                    );
            	
                $this->M_count->get_insert($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'count', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'count', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('title', 'title', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                        'title' => $this->input->post('title'),
                        'date' => date('Y-m-d'),
                        'time' => date('H:i:s')
                    );

                $this->M_count->get_update($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'count', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'count', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_count->delete($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'count', 'refresh');
        }
		$data_page['data_count'] = $this->M_count->getAll();        
		$data_page['page_name']  = 'goods';
        $data_page['page_title'] = 'manage goods';
        $this->load->view('countdown', $data_page);
    }


}