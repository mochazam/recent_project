<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rating_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	// to get parent of comments .. default value zero
  	function parent_comment($entry_id) {
        $this->db->where('entry_id', $entry_id);
        $this->db->where('parent_id', 0);
        $this->db->where('comment_state', 1);
        $query = $this->db->get('comment');
        if ($query->num_rows() !== 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
	// to get child comments by entry id and parent id
 	function child_comment($entry_id, $id) {
        $this->db->where('entry_id', $entry_id);
        $this->db->where('parent_id', $id);
        $this->db->where('comment_state', 1);
        $query = $this->db->get('comment');
        if ($query->num_rows() !== 0) {
            return $query->result_array();
        } else {
            return NULL;
        }
    }

}    