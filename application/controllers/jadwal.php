<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Jadwal extends CI_controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_matakuliah', 'app_model'));
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
            $this->form_validation->set_rules('matakuliah', 'matakuliah', 'required');
            $this->form_validation->set_rules('dosen', 'dosen', 'required');
            $this->form_validation->set_rules('jadwal', 'jadwal', 'required');
            $this->form_validation->set_rules('jam', 'jam', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                            'kode_mk' => $this->input->post('matakuliah'),
                            'kode_dosen' => $this->input->post('dosen'),
                            'jadwal' => $this->input->post('jadwal'),
                            'ruang' => $this->input->post('ruang'),
                            'jam' => $this->input->post('jam')
                        );

                $this->M_matakuliah->get_insert_jdwl($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'jadwal', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'jadwal', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('matakuliah', 'matakuliah', 'required');
            $this->form_validation->set_rules('dosen', 'dosen', 'required');
            $this->form_validation->set_rules('jadwal', 'jadwal', 'required');
            $this->form_validation->set_rules('jam', 'jam', 'required');

            if ($this->form_validation->run() == TRUE) {
            	$data = array(
                            'kode_mk' => $this->input->post('matakuliah'),
                            'kode_dosen' => $this->input->post('dosen'),
                            'jadwal' => $this->input->post('jadwal'),
                            'ruang' => $this->input->post('ruang'),
                            'jam' => $this->input->post('jam')
                        );

                $this->M_matakuliah->get_update_jdwl($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'jadwal', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'jadwal', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_matakuliah->delete_jdwl($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'jadwal', 'refresh');
        }
        $data_page['data_jadwal'] = $this->M_matakuliah->getJadwalMk();
		$data_page['page_name']  = 'jadwal';
        $data_page['page_title'] = 'manage jadwal';
		$this->load->view('jadwal', $data_page);
    }


}