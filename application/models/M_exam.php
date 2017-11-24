<?php

class M_exam extends CI_Model {

	var $table = 'tbl_question';
	var $table2 = 'tbl_test';
	function __construct() {
        parent::__construct();
    }

    function getQuestion($key) {
    	$this->db->select("*");
    	$this->db->where('test_id', $key);
    	$this->db->order_by(10, 'RANDOM');
    	$this->db->order_by('id', 'ASC');
    	$this->db->limit(10);
        $this->db->from($this->table);
		$query = $this->db->get();

    	return $query;
    }

    function getAllQuestion() {
    	$this->db->select("tbl_question.*, tbl_test.*, tbl_question.id as id_question");
    	$this->db->from($this->table);
    	$this->db->join('tbl_test', 'tbl_question.test_id = tbl_test.id');
        
		$query = $this->db->get();

    	return $query;
    }

    function getTest() {
    	$this->db->select("*");
        $this->db->from($this->table2);
        $query = $this->db->get()->result_array();

		return $query;
    }

    function getTime($key) {
    	$this->db->select("*");
    	$this->db->where('id', $key);
        $this->db->from($this->table2);
        $query = $this->db->get()->result_array();

		return $query;
    }

    function select_question_details_by_test_id($key) {
    	$this->db->select("*");
        $this->db->from($this->table);
        $this->db->order_by('rand()');
    	$this->db->limit(10);
    	$this->db->where('test_id', $key);
		$query = $this->db->get()->result_array();

		return $query;
    }

    function delete($key){
        $this->db->where('id',$key);
        $this->db->delete($this->table2);
    }    

    //fungsi insert ke database
    function get_insert($data){
       	$this->db->insert($this->table2, $data);
      	return TRUE;
    }

    function get_update($data, $key){
        $this->db->where("id", $key);
        $this->db->update($this->table2, $data);
        return TRUE;
    }

    // table question

    function deleteQuestion($key){
        $this->db->where('id',$key);
        $this->db->delete($this->table);
    }    

    //fungsi insert ke database
    function get_insertQuestion($data){
       	$this->db->insert($this->table, $data);
      	return TRUE;
    }

    function get_updateQuestion($data, $key){
        $this->db->where("id", $key);
        $this->db->update($this->table, $data);
        return TRUE;
    }

}
