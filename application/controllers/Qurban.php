<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Qurban extends CI_controller 
{
	var $table = 'qurban';
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_qurban'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
        header('Content-Type: text/html; charset=UTF-8');
	}

	function index(){
		$this->load->view('daftar_qurban');
	}

	function daftarQurban() {
		$group = $this->setGroup();

		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telpon' => $this->input->post('telpon'),
			'group' => $group,
			'tahun' => date("Y")
		);

		$query = $this->db->insert($this->table, $data);
		if ($query) {
			echo "Your data have been save!";
		} else {
			echo "Error when save data!";
		}
	}

	function setGroup() {
		// get jml pendaftar
		$thn = date("Y");
		$this->db->where('tahun', $thn);
        $query = $this->db->get($this->table);
        $jml = $query->num_rows();
        // var_dump($jml);
        // die();
		if ($jml > 0) {
			$getRaw = ceil($jml / 7);
			if ($jml % 7 == 0) {
				$getGroup = $getRaw + 1;
			} else {
				$getGroup = $getRaw;
			}
		} else {
      		$getGroup = 1;
		}
		
		return $getGroup;
	}

	function show() {
		$group = $this->setGroup();
		for ($i=1; $i <= $group; $i++) { 
			$data['qurbans'.$i] = $this->M_qurban->getListQurban($i);
		}
		// var_dump();
		// die();
		$data['group'] = $group;
		$this->load->view('list_qurban', $data);
	}
   
}