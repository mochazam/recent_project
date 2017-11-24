<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	 
	class Onchange extends CI_Controller {
	  
	  	public function __Construct() {
	   
	 		parent::__construct();
	    
	   		/* berfungsi untuk Memanggil file model */
	   		$this->load->model('mdl_onchange');
	 	}
	  
	  
	  	public function index() {
	   
	   		$this->show();
	  	}
	   
	   
	  	public function show() {
	    
	   		$data['provinsi'] = $this->mdl_onchange->get_provinsi(); /*memanggil fungsi get_provinsi dari model*/
	   		$data['kota'] = $this->mdl_onchange->get_kota(); /*memanggil fungsi get_kota dari model*/
	   		$data['kecamatan'] = $this->mdl_onchange->get_kecamatan(); /*memanggil fungsi get_kota dari model*/
	   		$this->load->view('form_onchange',$data); /*menampilkan data pada form_onchange*/
	  	}  

	}