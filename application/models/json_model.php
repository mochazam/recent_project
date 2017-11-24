<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class Json_model extends CI_model{

	function __construct(){
		parent::__construct();
	}

	function create(){
		$query1 = $this->db->query('SELECT id, value, name FROM kategori_layanan');

		$arr = array();

		foreach ($query1->result_array() as $layanan) {
			$query2 = $this->db->query('SELECT id, value, name FROM provider WHERE id_kat = '.$layanan['id']);

			foreach ($query2->result_array() as $provider) {
				$query3 = $this->db->query('SELECT id, value, name FROM product WHERE id_prov = '.$provider['id']);

				foreach ($query3->result_array() as $produk) {
					$provider['product'][] = $produk;
				}
				$layanan['provider'][] = $provider; 
			}
			$arr[] = $layanan;
		}

		$base_out = array();

	    // Kind of dirty, but doesnt hurt much with low number of records
	    foreach ($arr as $key => $record) {
	        // id_codes were necessary before, to keep track of ports (by id_code), 
	        // but they bother json now, so we do...
	        $base_out[] = $record;
	    }

	    $json = json_encode($base_out);

	    echo $json;
	}

	function bank(){
		$query = $this->db->query('SELECT id, value, name FROM bank');

		$arr = array();

		foreach ($query->result_array() as $layanan) {

			$arr[] = $layanan;
		}

		$base_out = array();

	    // Kind of dirty, but doesnt hurt much with low number of records
	    foreach ($arr as $key => $record) {
	        // id_codes were necessary before, to keep track of ports (by id_code), 
	        // but they bother json now, so we do...
	        $base_out[] = $record;
	    }

	    $json = json_encode($base_out);

	    echo $json;
	}

	function getprice(){
        $produk_id = $this->input->post('produk_id');
        $result = array();
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('id',$produk_id);
        $array_keys_values = $this->db->get();
        
        foreach ($array_keys_values->result() as $row)
        {
            //$result[0]= '-Pilih-';
            $result = $row->price;
        }
        
        return $result;
    }
}