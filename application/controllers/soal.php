<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Soal extends CI_controller 
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
            $this->form_validation->set_rules('soal', 'soal', 'required|callback_soal_check');
            $this->form_validation->set_rules('status', 'status', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                            'soal' => $this->input->post('soal'),
                            'status' => $this->input->post('status')
                        );

                $this->M_quiz->get_insert($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'soal', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'soal', 'refresh');
            }
        }
        if ($param1 == 'edit') {
           
            $this->form_validation->set_rules('soal', 'soal', 'required|callback_soal_check');
            $this->form_validation->set_rules('status', 'status', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                            'soal' => $this->input->post('soal'),
                            'status' => $this->input->post('status')
                        );

                $this->M_quiz->get_update($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'soal', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'soal', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_quiz->delete($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'soal', 'refresh');
        }
        $data_page['data_soal'] = $this->M_quiz->getSoal();
		$data_page['page_name']  = 'soal';
        $data_page['soal']  = 'active';
        $data_page['page_title'] = 'manage soal';
		$this->load->view('soal', $data_page);
    }

     public function soal_check($str) {
        if ($str == 'test') {
            $this->form_validation->set_message('soal_check', 'The {field} field can not be the word "test"');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}