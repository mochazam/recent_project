<?php 

class Crud extends CI_Controller
{

	function __construct(){
		parent::__construct();
		$this->load->model('m_crud');
		$this->load->helper('url');
		$this->load->database();
	}


	function index(){

		$data["people"]=$this->m_crud->read();
		$this->load->view("crud_view",$data);

	}

	function create(){
		echo json_encode(array("id"=>$this->m_crud->create()));
	}

	function update(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$modul= $this->input->post("modul");
		$this->m_crud->update($id,$value,$modul);
		echo "{}";
	}

	function delete(){
		$id= $this->input->post("id");
		$this->m_crud->delete($id);
		echo "{}";
	}

}