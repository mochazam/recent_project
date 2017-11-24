<?php
class Dashboardmodel extends CI_Model{

	public function insertbranddetials(){
	     	   
	  	$brandname = $this->input->post("brand_name");
	  	$dealername = $this->input->post("dealername");
	  	$emailid = $this->input->post("emailid");
	  	$address = $this->input->post("address");
	  	$webaddress = $this->input->post("webaddress");
	  	$city = $this->input->post("city");
	  	$contactno = $this->input->post("contactno");
	  	$state = $this->input->post("state");
	  	$fax = $this->input->post("fax");

	   	$branddet = array(
	   		'brand_name' => $brandname ,
	   		'dealer_name' => $dealername ,
	   		'email_id' =>   $emailid,
	   		'Address' => $address ,
	   		'website_addr' => $webaddress,
	   		'city' => $city ,
	   		'contact_number' => $contactno,
	   		'state' => $state ,
	   		'fax_number' => $fax
	    );
	/*    
		<div style="clear:both; margin-top:0em; margin-bottom:1em;"><a 
		href="http://www.eknowledgetree.com/codeigniter/codeigniter-version-3-0-3-latest-release-updates/"
		 target="_blank" rel="nofollow" 
		class="u25826a179428a80dc4bc1d42035b9283">%MINIFYHTMLb033585728912b25a3e69a9311ca598540%<div
		 style="padding-left:1em; padding-right:1em;"><span 
		class="ctaText">READ</span>  <span 
		class="postTitle">Codeigniter Version 3.0.3 latest release 
		updates</span></div></a></div>	 
	*/
	 	$insertdet=$this->db->insert('branddetails', $branddet);
	 	return $insertdet;
	}
}	
