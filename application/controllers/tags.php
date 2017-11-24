<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Tags extends CI_controller 
{

	public function __construct() {
        parent::__construct();   
        $this->load->model(array('m_tags'));
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));    
    }
 
    function index() {
    	$this->load->view('tag_view');  
    }

    function getTags() {
    	if ('IS_AJAX') {
    		$name = $this->input->post('query');
    	}
    	$result = $this->m_tags->getData($name);
        return $result;
    }

    function inputTags() {
    	if ('IS_AJAX') {
    		$name = $this->input->post('name');
    		$tag = $this->input->post('tags');
    	}
    	$data = array(
    		'bookmark_id' => $name,
    		'tag_id' => $tag
    	);
    	$result = $this->m_tags->get_insert($data);
    	return $result;
    }

    function search() {
    	// Query for “bookmark+webservice+semweb” 

		// SELECT b.*
		// FROM tagmap bt, bookmark b, tag t
		// WHERE bt.tag_id = t.tag_id
		// AND (t.name IN ('bookmark', 'webservice', 'semweb'))
		// AND b.id = bt.bookmark_id
		// GROUP BY b.id
		// HAVING COUNT( b.id )=3

       	$this->db->join('tagmap', 'bookmark.bookmark_id = tagmap.bookmark_id', 'left');
		$this->db->join('tag', 'tag.tag_id = tagmap.tag_id', 'left');   
		          
		    
		$a_tag = array(); 
		//I am using static array for this example only (It can be dynamic array from Front end (eg. user inputs))
		$filter_tag = array("bookmark", "webservice", "semweb");
		      
		$a_tag = explode(",", trim($filter_tag)); // Your tags as an array.
		     
		$a_tag  = array_unique($a_tag);  // to have unique array (protect duplicate array values)
		     
		$tag_count = count($a_tag); // count the number of elements in the array
		     
		$this->db->where_in('tag.name', $a_tag);
		     
		$this->db->group_by('bookmark.bookmark_id');
		     
		$count = "COUNT(bookmark.bookmark_id) = $tag_count";   // Custom string 
		     
		$this->db->having($count);

		$query = $this->db->get('bookmark');   

		return ($query->num_rows() > 0)  ? $query->result() : FALSE; 
    }

}	