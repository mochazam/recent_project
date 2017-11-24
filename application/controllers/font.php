<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Font extends CI_controller 
{
	var $destination;

	function __construct(){
		parent::__construct();
		$this->load->model(array('M_font', 'app_model'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
        $this->destination = realpath(APPPATH. '../fonts/');
	}

	function index(){
		$this->go($param1 = '', $param2 = '', $param3 = '');
	}

	function go($param1 = '', $param2 = '', $param3 = '')
    {
        $tanggal = date('Y-m-d');
        if ($param1 == 'create') {
            $this->form_validation->set_rules('nama_font', 'nama_font', 'required');
            $this->form_validation->set_rules('font_file', 'font_file', 'required');

            $this->load->library('upload');

	        $nmfile = "font-".date("Y-m-d"); //nama file saya beri nama langsung dan diikuti fungsi time
	       
	        $config['upload_path'] = './fonts/'; //path folder
	        $config['allowed_types'] = 'zip'; //type yang dapat diakses bisa anda sesuaikan
	        $config['file_name'] = $_FILES['font_file']['name']; //$nmfile; //nama yang terupload nantinya
		
	        $this->upload->initialize($config);

            //var_dump($_FILES['font_file']['name']);
            //die();

            //if ($this->form_validation->run() == TRUE) {


            	if ($this->upload->do_upload('font_file'))
	            {
	                $data = array(
                        'nama_font' => $this->input->post('nama_font'),
                        'slug' => str_replace(' ', '_', $this->input->post('nama_font')),
                        'date' => date('Y-m-d'),
                        'file' => $_FILES['font_file']['name']
                    );

                    //Unzip file

                    $full_path = $this->upload->data('full_path');
                    /**** without library ****/
                    $zip = new ZipArchive;
         
                    if ($zip->open($full_path) === TRUE) 
                    {
                        $zip->extractTo(FCPATH.'/fonts/extFont/');
                        $zip->close();
                    }
		                
	                $this->M_font->get_insert($data); //akses model untuk menyimpan ke database
                	$this->session->set_flashdata('flash_message' , 'data added successfully');

                	redirect(base_url() . 'font', 'refresh');
                //}	 
                
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'font', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('nama_font', 'nama_font', 'required');
            $this->form_validation->set_rules('font_file', 'font_file', 'required');

            $this->load->library('upload');

	        $nmfile = "blog".date("Y-m-d"); //nama file saya beri nama langsung dan diikuti fungsi time
	       
	        $config['upload_path'] = './fonts'; //path folder
	        $config['allowed_types'] = 'zip'; //type yang dapat diakses bisa anda sesuaikan
	        $config['file_name'] = $_FILES['font_file']['name']; //$nmfile; //nama yang terupload nantinya
		
	        $this->upload->initialize($config);

            if ($this->form_validation->run() == TRUE) {

                if ($this->upload->do_upload('font_file'))
	            {
	                $data = array(
                        'nama_font' => $this->input->post('nama_font'),
                        'slug' => str_replace(' ', '_', $this->input->post('nama_font')),
                        'date' => date('Y-m-d'),
                        'file' => $_FILES['font_file']['name']
                    );
		                
	                $this->db->select('*');
					$this->db->where(array('id'=>$param2));
					$query = $this->db->get('fonts');
		            $result =  $query->first_row('array');
		            $nama = $result['file'];
		            
		            //hapus file dari server
		               
		            // lokasi folder file
		            $map = $_SERVER['DOCUMENT_ROOT'];
		            $path = $this->destination . '/';
		            //lokasi gambar secara spesifik
		            $font = $path.$nama;
		            //hapus image
		            unlink($font);

	                $this->M_font->get_update($data,$param2);
                	$this->session->set_flashdata('flash_message' , 'data updated');
                	redirect(base_url() . 'font', 'refresh');
                }

                
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'font', 'refresh');
            }
        }
        if ($param1 == 'delete') {
        	// cek nama file di DB
        	$this->db->select('*');
			$this->db->where(array('id'=>$param2));
			$data =	 $this->db->get('fonts');
            $result =  $data->first_row('array');
            $nama = $result['file'];

            // lokasi folder file
            $map = $_SERVER['DOCUMENT_ROOT'];
            $path = $this->destination . '/';
            //lokasi gambar secara spesifik
            $font = $path.$nama;
            //hapus image
            unlink($font);

            $this->M_font->delete($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'font', 'refresh');
        }
		$data_page['data_font'] = $this->M_font->getFont();        
		$data_page['page_name']  = 'customer';
        $data_page['page_title'] = 'manage font';
        $this->load->view('fonts', $data_page);
    }


}