<?php
class Products extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('v_products');
	}
	
	public function get_all_users(){

		$query = $this->db->get('products');
		if($query->num_rows > 0){
			$header = false;
			$output_string = '';
			$output_string .=  "<table border='1'>\n";
			foreach ($query->result() as $row){
				$output_string .= '<tr>\n';
				$output_string .= "<th>{$row['value']}</th>\n";	
				$output_string .= '</tr>\n';				
			}					
			$output_string .= '</table>\n';
		}
		else{
			$output_string = 'There are no results';
		}
		 
		echo json_encode($output_string);
	}
 }
