<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compare extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('m_compare');
		$this->load->helper('url');
	}

	function index() {
		/*
		$query = $this->db->query('SELECT a.npm, a.matakuliah
									FROM absensi a
									WHERE NOT EXISTS 
									(
									    SELECT * 
									    FROM mk_ambil mk 
									    WHERE mk.nim = a.id AND a.statut = mk.kode_mk 
									)');
		
		if($query->num_rows()>0)//jika data ada 
		{
			foreach ($query->result() as $row) {		
				// retrieve any data on database
				
			} 
		}
		*/	
		$data['absen'] = $this->m_compare->getData();
		$this->load->view('compare', $data);
	}

	function db_compare(){
        
	}
}