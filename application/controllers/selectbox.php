<?php
class Selectbox extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('MChain');
		$this->load->helper(array('form'));
	}
	
	function index(){		
		$data['option_propinsi'] = $this->MChain->getPropinsiList();
		$this->load->view('chain/index',$data);
	}
	
	function select_kota(){
        if('IS_AJAX') {
        	$data['option_kota'] = $this->MChain->getKotaList();		
			$this->load->view('chain/kota',$data);
        }
		
	}
        
    function submit(){
        echo "Propinsi ID = ".$this->input->post("provinsi_id");
        echo "<br>";
        echo "Kota ID = ".$this->input->post("kota_id");
    }
}
?>
