<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Absen extends CI_controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_matakuliah', 'M_absen', 'app_model'));
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
		date_default_timezone_set('Asia/Jakarta');
	}

	function index(){
		$this->ID();
	}

	function ID() {
		if($this->uri->segment(3)) {
			//
			$years = date('Y') - 1;
			$months = date('m');
			$dwisem = array('gasal', 'genap');
			if ($months < 6) {
			  	$sem = $dwisem[0];
			}  
			else {
				$sem = $dwisem[1];
			}
			$sem_total = $sem . "-" . $years;
			//get today
			$days = array('Ahad', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');    
            $today = $days[date('w')];
			//cek di database
			$this->db->where('nim',$this->uri->segment(3));
			$query = $this->db->get('pw_mst_mahasiswa');
			if($query->num_rows()>0)//jika data ada 
			{
				foreach($query->result() as $row)
				{
					//buat array untuk melempar data ke form
					$data_page['npm'] = $this->uri->segment(3);
					$data_page['nama_mhs'] = $row->nama_mhs;
					$data_page['id'] = $row->nim;	
					$data_page['matakul'] = $this->M_matakuliah->dropdownMk($row->nim, $sem_total, $today);	
					$data_page['semester'] = $sem_total;			
				}
			}
			//
			$this->load->view('absensi', $data_page);
		}
	}

	function log() {
		if('IS_AJAX') {
			$data = array(
	              'npm' => $this->input->post('id'),
	              'matakuliah' => $this->input->post('mk'),
	              'status' => $this->input->post('status'),
	              'date' => date("Y-m-d")
	            );
			$this->db->insert('absensi',$data);
		}	
	}

	function log_absensi() {
		$this->app_model->getLogin();

		$this->load->view('retrieve_absensi');
	}

	function retrieve_absensi() {
		if('IS_AJAX') {
			//$tgl = $this->input->post('tgl');
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$mk = $this->input->post('id');
		}	
		// ini belum ditambahkan parameter
		//$result = $this->M_absen->get_logAbsen($tgl, $mk);
		$result = $this->M_absen->get_logAbsen($start, $end, $mk);
        return $result;
	}

	function kroscek() {
		if('IS_AJAX') {
			$npm = $this->input->post('id');
			$mk = $this->input->post('mk');
		}	
		// ini belum ditambahkan parameter
		$result = $this->M_absen->check($npm, $mk);
        return $result;
	}

	function rekapitulasi() {
		$this->app_model->getLogin();
		
		$this->load->view('rekapitulasi');
	}	

	function rekap_absen() {
		if('IS_AJAX') {
			$mk = $this->input->post('mk');
		}

		$result = $this->M_absen->get_rekap($mk);
        return $result;
	}

}