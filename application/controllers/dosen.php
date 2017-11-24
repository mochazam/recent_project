<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Dosen extends CI_controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_dosen', 'app_model'));
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
            $this->form_validation->set_rules('nama', 'nama', 'required');
            $this->form_validation->set_rules('kd_dosen', 'kd_dosen', 'required');
            $this->form_validation->set_rules('nO_id', 'nO_id', 'required');
            $this->form_validation->set_rules('alamat', 'alamat', 'required');
            $this->form_validation->set_rules('telpon', 'telpon', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                        'kode_dosen' => $this->input->post('kd_dosen'),
                        'nama_dosen' => $this->input->post('nama'),
                        'NIDN' => $this->input->post('nO_id'),
                        'alamat' => $this->input->post('alamat'),
                        'telp' => $this->input->post('telpon')
                    );
                /*
            	$data['kode_dosen'] = $this->input->post('kd_dosen');
                $data['nama_dosen'] = ucwords($this->input->post('nama'));
                $data['NIDN'] = $this->input->post('nO_id');
                $data['alamat'] = $this->input->post('alamat');
                $data['telp'] = $this->input->post('telpon');
                */
                $this->M_dosen->get_insert($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'dosen', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'dosen', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('nama', 'nama', 'required');
            $this->form_validation->set_rules('kd_dosen', 'kd_dosen', 'required');
            $this->form_validation->set_rules('nO_id', 'nO_id', 'required');
            $this->form_validation->set_rules('alamat', 'alamat', 'required');
            $this->form_validation->set_rules('telpon', 'telpon', 'required');

            if ($this->form_validation->run() == TRUE) {
            	$data = array(
                        'kode_dosen' => $this->input->post('kd_dosen'),
                        'nama_dosen' => $this->input->post('nama'),
                        'NIDN' => $this->input->post('nO_id'),
                        'alamat' => $this->input->post('alamat'),
                        'telp' => $this->input->post('telpon')
                    );

                $this->M_dosen->get_update($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'dosen', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'dosen', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_dosen->delete($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'dosen', 'refresh');
        }
		$data_page['data_dosen'] = $this->M_dosen->getDosen();        
		$data_page['page_name']  = 'customer';
        $data_page['page_title'] = 'manage kustomer';
        $this->load->view('dosen', $data_page);
    }


}