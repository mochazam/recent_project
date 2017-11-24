<?php

class searchcon extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper(array('url', 'form'));
	}

	public function index(){
		$this->load->view('search_view');
	}

	public function advSearch(){
		$query = "";
		$bodyStyle=$this->input->post("bodyStyle");
		$fuelType=$this->input->post("fuelType");
		$cities=$this->input->post("cities");
		$states=$this->input->post("states");
		$make =$this->input->post("make");
		$model =$this->input->post("model");
		$budgetarr=$this->input->post("budget");
		$sql_query="select  * from userorsellcar";

	  	if(!empty($budgetarr)){
		 	foreach($budgetarr as $key=>$value){
	         	if($value == " > 2000000"){
	        		$pricearr[]=' price '.$value.'';
		 		}
		 		else{
		    		$pricearr[]=' price between '.$value.'';
		 		}
       		}
		  	$price=implode(' or ', $pricearr);
		  	$query[]= ' ('.$price.')';
	 	}

	 	if(!empty($cities)){
		 	$comma = "'".$cities."'"; 
		 	$query[]=' city='.$comma.'';
	 	}

	  	if(!empty($states)){
            $comma = "'".$states."'"; 
		 	$query[]=' state='.$comma.'';
	 	}

	  	if(!empty($make)){
		 	$comma = "'".$make."'"; 
		 	$query[]=' make='.$comma.'';
	 	}

	   	if(!empty($model)){
		 	$comma = "'".$model."'"; 
		 	$query[]=' model='.$comma.'';
	 	}

		if(!empty($bodyStyle)){
		 	$comma_separated=implode("','", $bodyStyle);
		 	$comma = "'".$comma_separated."'"; 
		 	$query[]=' bodystyle in ('.$comma.')';
	 	}

	 	if(!empty($fuelType)){
	        $comma_separated=implode("','", $fuelType);
			$comma = "'".$comma_separated."'"; 
			$query[]=' fueltype in ('.$comma.')';
	 	}

	 	if(!empty( $fuelType) || !empty($bodyStyle) || !empty($cities) || !empty($budgetarr) || !empty($states)  || !empty($make)  || !empty($model)) {
	  		$where_clause = implode(' and ', $query);
	  		$sql_query.=" where".$where_clause." order by created_date asc";
	 	}
             
        $data['query']=$this->db->query($sql_query);

		/*Note:Here In the example I did not created display search_usedcar 
		view,please create a create view as you like to display the results by 
		echoing the view directly to display results  */      
 		echo $this->load->view("user/search_usedcar_ads",$data);

	}

	function citydetailswithstate(){
		$state=$this->input->post('state');
		//echo $state;
		$query=$this->user_service->get_city_info();
		echo '<option value="">Select City </option>';
	  	foreach($query->result() as $row){ 
	   		echo "<option value='".$row->city_name."'>".$row->city_name."</option>";

	  	}
	}

	function modeldetailswithmake(){
		$make=$this->input->post('make');
		//echo $state;
		$query=$this->user_service->get_model_info();
		echo '<option value="">--Select model-- </option>';
		foreach($query->result() as $row){ 
		   	echo "<option value='".$row->model."'>".$row->model."</option>";
		}
	}

}
