<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');  
   
class Resize extends CI_Controller {   
    
    public function __construct() {  
        parent:: __construct();
        $this->load->model('resize_model');  
        $this->load->helper('url');  
        $this->load->helper('form'); 
        $this->load->library('session', 'file'); 
    }  
        
    public function index() {  
        $this->load->view('resize_form');  
    }  

    public function insert(){
	
        $this->load->library('upload');

        //$nmfile = "foto".date("Y-m-d"); //nama file saya beri nama langsung dan diikuti fungsi time
       
        $config['upload_path'] = './upload'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '2048'; //maksimum besar file 2M
        $config['max_width']  = '1288'; //lebar maksimum 1288 px
        $config['max_height']  = '768'; //tinggi maksimu 768 px 
        $config['encrypt_name'] = TRUE;   
        //$config['file_name'] = $nmfile; //nama yang terupload nantinya
	
        $this->upload->initialize($config);    
		
        if ($this->upload->do_upload('name_field'))
        {
            // $gbr = $this->upload->data();	      

            // $this->resize_model->do_upload('name_field');

            $this->resize_model->do_watermark('name_field');          

            //pesan yang muncul jika berhasil diupload pada session flashdata
			$this->session->set_flashdata('info','<div class="alert alert-block alert-success"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Data sukses di Simpan.</div>');

            redirect('resize'); //jika berhasil maka akan ditampilkan view vupload
        }else{
            //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
			$this->session->set_flashdata('info','<div class="alert alert-block alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i class="icon-ok green"></i> Data gagal di Simpan.</div>');

            redirect('resize'); //jika gagal maka akan ditampilkan form upload
        }
        
        
    }
}    