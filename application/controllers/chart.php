<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Chart extends CI_Controller {
 
    public function index()
    {
    	$this->load->model('chart_model');
        $data['pie_data']=$this->chart_model->GetPie();
        $this->load->view('v_chart',$data);
    }
}