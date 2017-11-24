<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_produk extends CI_Model {

	var $table = 'produk';
    function __construct() {
        parent::__construct();
        
    }

    function getAll() {
    	$getb = $this->db->get($this->table);
    	return $getb;
    }

    function getDetail($key) {
        $this->db->where('id',$key);
        $query = $this->db->get($this->table);
  		return $query;
    }

}