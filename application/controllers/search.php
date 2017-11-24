<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Search extends CI_controller 
{

	public function __construct() {
        parent::__construct();   
        $this->load->helper('util');    
    }
 
    function index() {
    	$this->load->view('search');
    }

    //To add parentheses around the LIKE clauses
	function make_like_conditions (array $fields, $search_text) {
	    $likes = array();
	    foreach ($fields as $field) {
	        $likes[] = "$field LIKE '%$search_text%'";
	    }
	    return '('.implode(' || ', $likes).')';
	}

	function do_something()
	{
		$total = $this->uri->total_segments();
		$last = $this->uri->segment($total);

	   	$search_fields = array(
		    'id',
		    'nama_artikel',
		    'body',
		);

	  	$search_text = "food";

	  	$like_conditions = $this->make_like_conditions($search_fields, $search_text);
	  	$query = $this->db->from('artikel')->where($like_conditions)->get();
	  	return $query->result();
	}

	function golek() {
		$text = explode(' ', $this->input->post('text_search'));
		
		// for ($i=0; $i < count($text) ; $i++) { 
		// 	echo $text[$i].'<br>';

		// }

		foreach ($text as $key) {
			$likes[] = "'body' LIKE '%$key%'";
		}
		$like_conditions = '('.implode(' || ', $likes).')';
		$query = $this->db->from('artikel')->where($like_conditions)->get();
	  	$data['data'] = $query->result();
	  	$this->load->view('tag_view', $data);
	}

	

}	