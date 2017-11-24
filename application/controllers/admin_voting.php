<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* @property voting_model $voting */
class admin_voting extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('voting_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters("<span class='notification-input ni-error'>", "</span>");
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
        header('Content-Type: text/html; charset=UTF-8');
    }

    public function index()
    {
        $this->votes_list();
    }

    /** 
     *  display all categories of votings in datagrid.
     */
    public function votes_list()
    {
        $data['categories'] = $this->voting_model->get_votes();
        $this->load->view('content/votes_list', $data);
    }

    /**
     *  create new voting
     */
    public function create()
    {

        $this->form_validation->set_rules('dv_title', 'dv_title', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('content/voting_new');
        } else {
            // choices sent by the form
            $fields = $this->input->post('fields');
            // remove empty choices,order every choice by chars from A To Z
            $orderd_data = $this->array_combine2($fields);

            $this->voting_model->create($orderd_data);
            $this->session->set_flashdata('success_msg', 'Vote Succesfully Created');
            redirect('admin_voting/votes_list/');
        }
    }

    /**
     * This function edit the vote
     * @example id=1
     * @param integer $id
     */
    public function edit($id)
    {
        $data['vote'] = $this->voting_model->get_one($id);
        $columns = $this->voting_model->get_all_columns($id);
        $data['columns'] = array_filter($columns);
        $vote = $this->voting_model->is_voted($id);
        if (!empty($vote)) {
            $this->session->set_flashdata('success_msg', 'sorry,you cant edit live vote');
            redirect('admin_voting/votes_list/');
        }
        $this->form_validation->set_rules('dv_title', 'dv_title', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('content/voting_edit', $data);
        } else {

            $fields = $this->input->post('fields');
            $orderd_data = $this->array_combine2($fields);
            $this->voting_model->update($orderd_data, $id);
            $this->session->set_flashdata('success_msg', 'Vote Succesfully edit');
            redirect('admin_voting/votes_list/');
        }
    }

    function array_combine2($arr2)
    {
        $filter_arr2 = array_filter($arr2);
        $arr1 = range('A', 'z');
        $count = min(count($arr1), count($filter_arr2));
        return array_combine(array_slice($arr1, 0, $count), array_slice($filter_arr2, 0, $count));
    }


    /**
     * This function remove voting then redirect to votes_list
     * @example id=1
     * @param integer $id
     */
    public function remove($id)
    {
        if ($this->voting_model->delete($id)) {
            $this->session->set_flashdata('success_msg', 'Vote successfully removed');
            redirect('admin_voting/votes_list/');
        }
    }

    /**
     * This function active voting then redirect to votes_list
     * @example id=1
     * @param integer $id
     */
    function activate_vote($id)
    {

        $this->voting_model->active($id);
        $this->session->set_flashdata('success_msg', '1 new category activated!');
        redirect('admin_voting/votes_list/');
    }

    /**
     * This function deactivate voting then redirect to votes_list
     * @example id=1
     * @param integer $id
     */
    function deactivate_vote($id)
    {
        $this->voting_model->deactivate($id);
        $this->session->set_flashdata('success_msg', '1 new category deactivated!');
        redirect('admin_voting/votes_list/');
    }


}

/* End of file dashboard.php */
/* Location: ./system/application/modules/matchbox/controllers/dashboard.php */