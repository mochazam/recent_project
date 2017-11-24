<?php
class Demo extends CI_Controller {

	function __construct(){
		parent::__construct();		
		//$this->load->model('MiscellaneousModel');		
	}

	public function index(){
		//$query = $this->MiscellaneousModel->getEmployee();
		//echo json_encode (array($query));	

		$kota = $this->db->get('kota');

		foreach ($kota->result() as $row) {
			echo 'nama kota '.$row->value.'<br>';
		}

		var_dump($kota);

	}

	public function propinsi(){
		//$query = $this->MiscellaneousModel->getEmployee();
		//echo json_encode (array($query));	

		$this->db->where('id', 2);
		$propinsi = $this->db->get('provinsi');

		foreach ($propinsi->result() as $row) {
			echo 'nama propinsi '.$row->value.'<br>';
		}

		//var_dump($kota);

	}
}
