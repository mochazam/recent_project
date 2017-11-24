<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Multi_image extends CI_Controller {
 
	public function __construct() {
        parent::__construct();
        //load model untuk fungsi crud
        $this->load->model('crud_model','crud');
       	$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
 
    }
 
	public function index()
	{
		$data['list'] = $this->crud_model->show('multiple');
		$this->load->view('upload',$data);
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
            $config['upload_path'] = "./upload/"; //lokasi folder yang akan digunakan untuk menyimpan file
            $config['allowed_types'] = 'jpg|png|JPEG';
            
            foreach($_FILES as $row => $val ){
            	$config['file_name'] = $row;
            	$this->upload->initialize($config);
                	 if (!$this->upload->do_upload($row)) {
                    	$error = $this->upload->display_errors();
                        $this->session->set_flashdata('warning', $error);
                       redirect('multi_image/add');
                    } else {
                        $data['nama'] = $this->upload->file_name;
                       
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
       
        $config['upload_path'] = './assets/banner'; //path folder
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
                  'gambar_banner' =>$gbr['file_name']
                );
	                
                $this->_insert($data);

                //pesan yang muncul jika berhasil diupload pada session flashdata
				$this->session->set_flashdata('info', '<div class="alert alert-success"><button class="close" data-dismiss="alert">×</button><strong>Success!</strong> Data Sukses disimpan.</div>');

                redirect('admin/banner/tambah'); //jika berhasil maka akan ditampilkan view vupload
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
				$this->session->set_flashdata('info','<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button><strong>Error!</strong> Data gagal disimpan / diupdate.</div>');

                redirect('admin/banner/tambah'); //jika gagal maka akan ditampilkan form upload
            }
        }
        
        
    }

    function _insert($data) {
		$this->db->insert('multiple', $data);
	}


}