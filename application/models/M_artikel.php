<?php

class M_artikel extends CI_Model {

	var $table = 'artikel';
	var $table2 = 'kategori';
	function __construct() {
        parent::__construct();
    }

    function getArtikel() {
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

    function getCategory() {
    	$getb = $this->db->get($this->table2);
    	return $getb;
    }

    function delete_category($key){
        $this->db->where('id',$key);
        $this->db->delete($this->table2);
    }    

    //fungsi insert ke database
    function get_cat_insert($data){
       	$this->db->insert($this->table2, $data);
      	return TRUE;
    }

    function get_cat_update($data, $key){
        $this->db->where("id", $key);
        $this->db->update($this->table2, $data);
        return TRUE;
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
