<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Multi_upload extends CI_Controller {
 
	public function __construct() {
        parent::__construct();
        //load model untuk fungsi crud
        $this->load->model('crud_model','crud');
       	$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
 
    }
 
	public function index()
	{
		$this->load->view('upload_image');
	}

	public function add()
	{
		$this->load->view('add');
	}

	public function proses()
	{
		if (empty($_FILES['image_1']['name'])) {
	 	   	$this->session->set_flashdata('warning', 'Setidaknya 1 file harus diupload');	
           	redirect('multi_image/add');
        } else {
            //with upload image

            $this->load->library('upload');

	        $nmfile = "image_".date("Y-m-d"); //nama file saya beri nama langsung dan diikuti fungsi time
	       
	        $config['upload_path'] = './upload'; //path folder
	        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
	        $config['max_size'] = '2048'; //maksimum besar file 2M
	        $config['max_width']  = '1600'; //lebar maksimum 1288 px
	        $config['max_height']  = '768'; //tinggi maksimu 768 px    
	        //$config['file_name'] = $nmfile; //nama yang terupload nantinya
            
            foreach($_FILES as $row => $val ) {

            	$config['file_name'] = time();

            	$this->upload->initialize($config);
            	if (!$this->upload->do_upload($row)) {
                	$error = $this->upload->display_errors();
                    $this->session->set_flashdata('warning', $error);
                   redirect('multi_image/add');
                } else {
                    $data['nama'] = $this->upload->file_name;
                   	$data['date'] = date('Y-m-d');
                    $this->crud_model->insert($data, 'multiple');
                }
            }
            redirect('multi_image');
        }
	}

	public function insert(){
	
		$this->form_validation->set_rules('name_field', 'name_field', 'required');

        $this->load->library('upload');

        $nmfile = "image_".date("Y-m-d"); //nama file saya beri nama langsung dan diikuti fungsi time
       
        $config['upload_path'] = './upload'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048'; //maksimum besar file 2M
        $config['max_width']  = '1600'; //lebar maksimum 1288 px
        $config['max_height']  = '768'; //tinggi maksimu 768 px    
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
	
        $this->upload->initialize($config);    
		
    	if($_FILES['name_field']['name'])
        {
            if ($this->upload->do_upload('name_field'))
            {
                $gbr = $this->upload->data();
            	$data = array(
                  'nama' =>$gbr['file_name'],
                  'date' => date('Y-m-d')
                );
	                
                $this->_insert($data);

                //pesan yang muncul jika berhasil diupload pada session flashdata
				$this->session->set_flashdata('warning', '<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><strong>Success!</strong> Data Sukses disimpan.</div>');

                redirect('multi_upload'); //jika berhasil maka akan ditampilkan view vupload
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
				$this->session->set_flashdata('warning','<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button><strong>Error!</strong> Data gagal disimpan / diupdate.</div>');

                redirect('multi_upload'); //jika gagal maka akan ditampilkan form upload
            }
        }
        
        
    }

    function _insert($data) {
		$this->db->insert('multiple', $data);
	}

	function test2() {
		$this->load->view('multi_upload');
	}

	function do_upload()
	{       
	    $this->load->library('upload');

	    $files = $_FILES;
	    $cpt = count($_FILES['userfile']['name']);
	    for($i=0; $i<$cpt; $i++)
	    {           
	        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
	        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
	        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
	        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
	        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

	        $this->upload->initialize($this->set_upload_options());
	        $this->upload->do_upload();

	        if (!$this->upload->do_upload()) {
	            $error = array('error' => $this->upload->display_errors());

	            $this->load->view('upload_form', $error);
	        } else {
	            $data = array('upload_data' => $this->upload->data());

	            $this->load->view('upload_success', $data);
	        }

	        
	    }
	}

	private function set_upload_options()
	{   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = './Images/';
	    $config['allowed_types'] = 'gif|jpg|png';
	    $config['max_size']      = '0';
	    $config['overwrite']     = FALSE;

	    return $config;
	}


}