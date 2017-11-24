<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Multiple extends CI_Controller {

  private $_uploaded;

  public function __construct() {
        parent::__construct();
        //load model untuk fungsi crud
        $this->load->model('crud_model','crud');
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
 
    }

  public function index()
  {
    $this->load->helper('form');
    $data['title'] = 'Multiple file upload';
    
    // let's consider that the form would come with more fields than 
	// just the files to be uploaded. If this is the case, we would need to do 
	// some sort of validation. If we are talking about images, the only method
	// of validation for us would be to put the upload process inside a 
	// validation callback;
    $this->load->library('form_validation');

    //now we set a callback as rule for the upload field
    $this->form_validation->set_rules('uploadedimages[]','Upload image','callback_fileupload_check');
    
    //was something posted?
    if($this->input->post())
    {

      //run the validation
      if($this->form_validation->run())
      {
        // for now let's just verify if all went ok with the upload...
        echo '<pre>';
        print_r($this->_uploaded);
        echo '</pre>';
        // from here on you can do whatever you wish with the uploaded data or the other form fields that you might have. I decided to exit here, since this is not the object of our tutorial.
        exit;
      }
    }
    $this->load->view('upload_form', $data);
  }

  // now the callback validation that deals with the upload of files
  public function fileupload_check()
  {
    
    // we retrieve the number of files that were uploaded
    $number_of_files = sizeof($_FILES['uploadedimages']['tmp_name']);

    // considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
    $files = $_FILES['uploadedimages'];

    // first make sure that there is no error in uploading the files
    for($i=0; $i < $number_of_files; $i++)
    {
      if($_FILES['uploadedimages']['error'][$i] != 0)
      {
        //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
        $this->session->set_flashdata('warning','<div class="alert alert-error"><button class="close" data-dismiss="alert">×</button><strong>Error!</strong> Data gagal disimpan / diupdate.</div>');

        return FALSE;
      }
    }
    
    // we first load the upload library
    $this->load->library('upload');
    // next we pass the upload path for the images
    //$config['upload_path'] = FCPATH . 'upload/';
    // also, we make sure we allow only certain type of images
    //$config['allowed_types'] = 'gif|jpg|png';

    $config['upload_path'] = './upload'; //path folder
    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
    $config['max_size'] = '2048'; //maksimum besar file 2M
    $config['max_width']  = '1600'; //lebar maksimum 1288 px
    $config['max_height']  = '768'; //tinggi maksimu 768 px    
    //$config['file_name'] = $nmfile; //nama yang terupload nantinya

    // now, taking into account that there can be more than one file, for each file we will have to do the upload
    for ($i = 0; $i < $number_of_files; $i++)
    {
      $_FILES['uploadedimage']['name'] = $files['name'][$i];
      $_FILES['uploadedimage']['type'] = $files['type'][$i];
      $_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
      $_FILES['uploadedimage']['error'] = $files['error'][$i];
      $_FILES['uploadedimage']['size'] = $files['size'][$i];
      
      //now we initialize the upload library
      $this->upload->initialize($config);
      if ($this->upload->do_upload('uploadedimage'))
      {
        $this->_uploaded[$i] = $this->upload->data();
      }
      else
      {
        //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
        $this->session->set_flashdata('warning', $this->upload->display_errors());
        return FALSE;
      }
    }
    return TRUE;
  }
}