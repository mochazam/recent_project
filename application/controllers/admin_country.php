<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_country extends CI_Controller {

    function __construct() {
        parent::__construct();

        //$this->lang->load('country/country');
        $this->load->model('country_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters("<span class='incorrect'>", "</span>");
    }

    function index(){
        $this->load->view('feature_list');
        /// put here your item list
    }
    /**
     *  create new new_category then redirect index.
     */
    public function create() {
        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required|xss_clean|htmlspecialchars');
        $data['services'] = $this->country_model->get_service_dropdown();

        if ($this->form_validation->run() == false) {
            $this->load->view('country_new',$data);
        } else {
            $this->country_model->create();
            $this->session->set_flashdata('success_msg', 'Success create!');
            redirect('admin_country/');
        }
    }



    /**
     * This function edit an new_category then redirect to index
     * @example id=1
     * @param integer $id
     */
    public function edit($id) {
        $data['category'] = $this->country_model->get_category_one($id);
        $data['services'] = $this->country_model->get_service_dropdown();
        $data['selected'] = $this->country_model->get_service_dropdown_byid($id);

        $this->form_validation->set_rules('category_name', 'category_name', 'trim|required|xss_clean|htmlspecialchars');

        if ($this->form_validation->run() == false) {
            $this->load->view('country_edit', $data);
        } else {
            $this->country->update($id);
            $this->session->set_flashdata('success_msg', 'Success Edit!');
            redirect('admin_country/');
        }
    }


}

/* End of file dashboard.php */
/* Location: ./system/application/modules/matchbox/controllers/dashboard.php */