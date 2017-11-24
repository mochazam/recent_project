<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Mahasiswa extends CI_controller 
{
	function __construct(){
		parent::__construct();
        $this->load->model(array('M_mahasiswa', 'app_model'));
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
            $this->form_validation->set_rules('nama_mhs', 'nama_mhs', 'required');
            $this->form_validation->set_rules('kelamin', 'kelamin', 'required');
            $this->form_validation->set_rules('angkatan', 'angkatan', 'required');

            if ($this->form_validation->run() == TRUE) {
                //set auto NPM 
                $no = 24;
                $awal = 001;
                $tahun = date("y");
                //get nilai nim max
                $this->db->select_max('nim');
                $query = $this->db->get('pw_mst_mahasiswa');
                if($query->num_rows()>0)//jika data ada 
                {
                    foreach ($query->result() as $row) {
                        $nPM = $row->nim+1;
                    };
                } else { // jika tidak ada data
                    $nPM = $no.$tahun.$awal;
                }    
                //set auto email
                $faculty = 'TI';
                $first_email = str_replace(' ', '_', $this->input->post('nama_mhs'));
                $last_email = '@email.com';
                $total_email = $first_email.$last_email;
                $data = array(
                            'nama_mhs' => $this->input->post('nama_mhs'),
                            'nim' => $nPM,//$this->input->post('nim'),
                            'kelamin' => $this->input->post('kelamin'),
                            'angkatan' => $this->input->post('angkatan'),
                            'email' => $total_email,//$this->input->post('dosen'),
                            'password' => $nPM//$this->input->post('mahasiswa'),
                        );

                $this->M_mahasiswa->get_insert($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'mahasiswa', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'mahasiswa', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('nama_mhs', 'nama_mhs', 'required');
            $this->form_validation->set_rules('kelamin', 'kelamin', 'required');
            $this->form_validation->set_rules('angkatan', 'angkatan', 'required');

            if ($this->form_validation->run() == TRUE) {
                
                //set auto email
                $faculty = 'TI';
                $first_email = str_replace(' ', '_', $this->input->post('nama_mhs'));
                $last_email = '@email.com';
                $total_email = $first_email.$last_email;
                $data = array(
                            'nama_mhs' => $this->input->post('nama_mhs'),
                            'kelamin' => $this->input->post('kelamin'),
                            'angkatan' => $this->input->post('angkatan'),
                            'email' => $total_email//$this->input->post('dosen'),
                        );

                $this->M_mahasiswa->get_update($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'mahasiswa', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'mahasiswa', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_mahasiswa->delete($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'mahasiswa', 'refresh');
        }
        $data_page['data_mhs'] = $this->M_mahasiswa->getMahasiswa();
		$data_page['page_name']  = 'mahasiswa';
        $data_page['page_title'] = 'manage mahasiswa';
		$this->load->view('mahasiswa', $data_page);
    }


}