<?php


class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        if($this->input->post()) {
          foreach($this->input->post() as $key => $value){
              $edit = $this->Settings_model->edit_line($key, $value);
              echo $edit;
          }
        }

        // Load View
        $data['main_content'] = 'settings/index';
        $this->load->view('layouts/main',$data);
    }

}
