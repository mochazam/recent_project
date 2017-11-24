<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Ongkir extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function create(){
        $query1 = $this->db->query('SELECT id, value, name FROM provinsi');

        $arr = array();

        foreach ($query1->result_array() as $provinsi) {
            $query2 = $this->db->query('SELECT id, value, name FROM kota WHERE id_provinsi = '.$provinsi['id']);

            foreach ($query2->result_array() as $kota) {
                $query3 = $this->db->query('SELECT id, value, name FROM kecamatan WHERE id_kota = '.$kota['id']);

                foreach ($query3->result_array() as $ongkir) {
                    $kota['kecamatan'][] = $ongkir;
                }
                $provinsi['kota'][] = $kota; 
            }
            $arr[] = $provinsi;
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
        $kecamatan_id = $this->input->post('kecamatan_id');
        $result = array();
        $this->db->select('*');
        $this->db->from('kecamatan');
        $this->db->where('id',$kecamatan_id);
        $array_keys_values = $this->db->get();
        
        foreach ($array_keys_values->result() as $row)
        {
            $result = $row->price;
        }
        
        return $result;
    }

    function getProv(){
        $this->db->select('*');
        $this->db->from('provinsi');
        $this->db->order_by('name', 'ASC');
        $query = $this->db->get();
        $hasil = $query->result();

        return $hasil;
    }

    function get_kab(){
        $prov_id = $this->input->post('id_prov');
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('id_provinsi', $prov_id);
        $hasil = $this->db->get();
        
        return $hasil;
    }

    function get_city(){
        $this->db->select('*');
        $this->db->from('kota');
        $hasil = $this->db->get();
        
        return $hasil;
    }
}