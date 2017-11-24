<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Matakuliah extends CI_controller 
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
            $this->form_validation->set_rules('kode_mk', 'kode_mk', 'required');
            $this->form_validation->set_rules('nama_mk', 'nama_mk', 'required');
            $this->form_validation->set_rules('jum_sks', 'jum_sks', 'required');
            $this->form_validation->set_rules('semester', 'semester', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                            'kode_mk' => $this->input->post('kode_mk'),
                            'nama_mk' => $this->input->post('nama_mk'),
                            'jum_sks' => $this->input->post('jum_sks'),
                            'semester' => $this->input->post('semester')
                        );

                $this->M_matakuliah->get_insert($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'matakuliah', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'matakuliah', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('kode_mk', 'kode_mk', 'required');
            $this->form_validation->set_rules('nama_mk', 'nama_mk', 'required');
            $this->form_validation->set_rules('jum_sks', 'jum_sks', 'required');
            $this->form_validation->set_rules('semester', 'semester', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                            'kode_mk' => $this->input->post('kode_mk'),
                            'nama_mk' => $this->input->post('nama_mk'),
                            'jum_sks' => $this->input->post('jum_sks'),
                            'semester' => $this->input->post('semester')
                        );

                $this->M_matakuliah->get_update($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'matakuliah', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'matakuliah', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_matakuliah->delete($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'matakuliah', 'refresh');
        }
        $data_page['data_mk'] = $this->M_matakuliah->getMatakuliah();
		$data_page['page_name']  = 'matakuliah';
        $data_page['page_title'] = 'manage matakuliah';
		$this->load->view('matakuliah', $data_page);
    }	

	function log_klsMk() {
        $this->app_model->getLogin();
        
		$this->load->view('jdwl_matakuliah');
	}

	function retrieve_klsMk() {
		if('IS_AJAX') {
			$key = $this->input->post('id');
		}	
		//$key = $this->input->post('id');
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
		$this->load->model('M_kelas');
		$result = $this->M_kelas->get_klsMk($key, $sem_total);
        return $result;
	}

}