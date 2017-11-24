<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	function index() {
		$this->load->view('v_review');
	}

	function comment() {
		if('IS_AJAX') {
			//$username = $this->input->post('name');
			$data = array(
	              'nama' =>ucwords($this->input->post('username')),
	              'email' => $this->input->post('email'),
	              'isi_komentar' => $this->input->post('isi_komentar'),
	              'id_produk' => 1,
	              'rating' =>$this->input->post('rating'),
	              'tgl' =>date("Y-m-d"),
	              'jam_komentar' =>date("H:i:s"),
	              'status' => 2
	            );
			$this->db->insert('komentar',$data);
		}
	}


}	