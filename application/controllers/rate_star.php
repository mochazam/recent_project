<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rate_star extends CI_Controller
{
    // default user and news id ,you can change
    public $user_id = 2 ;
    public $news_id = 39;

    function __construct()
    {
        parent::__construct();

        //$this->lang->load('rating');
        $this->load->model('m_rating');
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
    }

    /**
     *  display all ratings in specfic item.
     */
    function index()
    {
        $data['rated'] = $this->m_rating->get_rate_numbers($this->news_id,$this->user_id);
        $data['news'] = $this->m_rating->get_one($this->news_id);
        $this->load->view('rate',$data);
    }

    // create new rate
    function create_rate()
    {
        $news_id = $this->input->post("pid");
        $rate =  $this->input->post("score");

        $data['rated'] = $this->m_rating->get_rate_numbers($this->news_id,$this->user_id);
        //check the item is rated already
       	if ($data['rated'] == FALSE ) {
            // if no send new rate record
           	$this->m_rating->insert_rate($news_id,$rate,$this->user_id);
           	$this->session->set_userdata('uid',$this->user_id);
        } else {
            // else get news rate id and update value
            $rate_id = $this->m_rating->get_item_rate($news_id);
            $this->m_rating->update_rate($rate_id->nrt_id,$rate,$this->user_id);
          	$this->session->set_userdata('uid',$this->user_id);
        }
    }

    function clear_user_rating(){
        $this->m_rating->delete_user_rating($this->news_id,$this->user_id);
        $this->session->sess_destroy();
        redirect('rate_star');

    }
}