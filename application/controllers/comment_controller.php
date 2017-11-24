<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comment_controller extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }


    public function add_comment($entry_id) {

        $this->load->model('blog_model');
        $this->load->model('comment_model');
        // get a post COMMENTS based on id
        $data['parent_comment'] = $this->comment_model->parent_comment($entry_id);
        // get a post slug based on entry id
        $data['entry_one'] = $this->blog_model->get_entry_one($entry_id);

        //set validation rules
        $this->form_validation->set_rules('comment_name', 'Name', 'strip_tags|required|xss_clean|trim|htmlspecialchars');
        $this->form_validation->set_rules('comment_email', 'Email','strip_tags|required|valid_email|xss_clean|trim|htmlspecialchars');
        $this->form_validation->set_rules('comment_body', 'comment_body','strip_tags|required|xss_clean|trim|htmlspecialchars');

        if ($this->form_validation->run() == FALSE) {
            // if not valid load comments
            $this->load->view('comment', $data);
            if ($this->input->post('submit') == "add_comment ") {
                $this->session->set_flashdata('error_msg', validation_errors());
                redirect('view_article/' . $data['entry_one']->entry_slug);
            }
        } else {
            //if valid send comment to admin to tak approve
            $this->comment_model->add_new_comment();
            $this->session->set_flashdata('error_msg', 'Your comment is awaiting moderation.');
            redirect('blog/view_article/' .$data['entry_one']->entry_slug);
        }
    }

    function child_comment($entry_id, $id) {
        // load child comments
        $data['child_comment'] = $this->comment_model->child_comment($entry_id, $id);
        $this->load->view('child_comment', $data);
    }

}    