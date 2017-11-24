<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Skor extends CI_controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_quiz', 'app_model'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
    }

    function index(){
        $this->app_model->getLogin();
        $this->go($param1 = '', $param2 = '', $param3 = '');
    }

    function go($param1 = '', $param2 = '', $param3 = '')
    {
        $this->app_model->getLogin();
        if ($param1 == 'create') {
            $this->form_validation->set_rules('skor', 'skor', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                            'nilai' => $this->input->post('skor'),
                            'status' => $this->input->post('status')
                        );

                $this->M_quiz->get_insert_skor($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'skor', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'skor', 'refresh');
            }
        }
        if ($param1 == 'edit') {
           
            $this->form_validation->set_rules('skor', 'skor', 'required');
            $this->form_validation->set_rules('status', 'status', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                            'nilai' => $this->input->post('skor'),
                            'status' => $this->input->post('status')
                        );

                $this->M_quiz->get_update_skor($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'skor', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'skor', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_quiz->delete_skor($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'skor', 'refresh');
        }
        $data_page['data_skor'] = $this->M_quiz->getSkor();
		$data_page['page_name']  = 'skor';
        $data_page['skor']  = 'active';
        $data_page['page_title'] = 'manage skor';
		$this->load->view('skor', $data_page);
    }


}