<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Testlanguage extends CI_controller 
{

	public function __construct() {
        parent::__construct();       
        // $this->lang->load("message","english");
        $this->lang->load("message","swedish");
    }
 
    function index() {
        // $data["language_msg"] = $this->lang->line("msg_first_name");
        // $this->load->view('language_view', $data);

        echo $this->lang->line("msg_first_name");
    }

}	