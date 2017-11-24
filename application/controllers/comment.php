<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller {

	public function __construct(){//Core controller constructor
    	parent::__construct();
    	$this->load->model('ektreemodel');
        $this->load->helper('url');        				
	}
	
    public function index()
    {   
       	$data['query']=$this->ektreemodel->get_article();
       	$data['comments']=$this->ektreemodel->get_comments();
       	$this->load->view('comments', $data);
    }
    public function insert_comments()
    {
        $insertinfo=$this->ektreemodel->insertcomments_article();
        //$data['comments']=$this->ektreemodel->get_latestcomment();
        $data['comments']=$this->ektreemodel->get_comments();
        echo $this->load->view('commentdisplay',$data);
    }
    public function displaycomments()
    {
        $data['comments']=$this->ektreemodel->get_comments();
        echo $this->load->view('commentdisplay',$data);
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */