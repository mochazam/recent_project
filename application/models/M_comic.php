<?php

class M_comic extends CI_Model {

	var $table = 'content';
	var $table2 = 'komik';

	function __construct() {
        parent::__construct();
    }

    function getIsi() {
    	$this->db->select("artikel.*, kategori.*, artikel.id as id_artikel");
        $this->db->from($this->table);
        $this->db->join($this->table2,"artikel.kategori_id = kategori.id");
		$query = $this->db->get();

    	return $query;
    }

    function delete($key){
        $this->db->where('id',$key);
        $this->db->delete($this->table);
    }    

    //fungsi insert ke database
    function get_insert($data){
       	$this->db->insert($this->table, $data);
      	return TRUE;
    }

    function get_update($data, $key){
        $this->db->where("id", $key);
        $this->db->update($this->table, $data);
        return TRUE;
    }

    // category

    function getComicName() {
    	$this->db->where('com_id',0);
    	$getb = $this->db->get($this->table2);
    	return $getb;
    }

    function delete_com($key){
        $this->db->where('id',$key);
        $this->db->delete($this->table2);
    }    

    //fungsi insert ke database
    function get_com_insert($data){
       	$this->db->insert($this->table2, $data);
      	return TRUE;
    }

    function get_com_update($data, $key){
        $this->db->where("id", $key);
        $this->db->update($this->table2, $data);
        return TRUE;
    }

    function getDetailComic($key) {
    	$this->db->where("id", $key);
       	$getb = $this->db->get($this->table2);
    	return $getb;
    }

    function getComicById($key) {
    	$this->db->where("com_id", $key);
        $getb = $this->db->get($this->table2);
    	return $getb;
    }

    function content($key) {
        $this->db->where('kategori_id',$key);
        $this->db->order_by('id', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);

        return $query;
    }

    function getContent($key, $id) {
        $this->db->where('kategori_id',$key);
        $this->db->where('slug',$id);
        $query = $this->db->get($this->table);

        return $query;
    }

    function menu($key) {
        $this->db->where('kategori_id',$key);
        $query = $this->db->get($this->table);

        return $query;
    }

}
