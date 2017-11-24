<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Test extends CI_controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_rekap'));
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
		date_default_timezone_set('Asia/Jakarta');
	}

	function index(){
		$this->load->view('test');
	}

	function insert_auto(){
		//$key = 1111102;
		$key = $this->input->post('kd_mk');
		$status = 3;
		$years = date('Y') - 1;
        $months = date('m');
        $dwisem = array('gasal', 'genap');
        if ($months < 6) {
            $sem = $dwisem[0];
        }  
        else {
            $sem = $dwisem[1];
        }
        $semester = $sem . "-" . $years;

		$this->db->select('mk_ambil.nim, mk_ambil.kode_mk, mk_ambil.semester_ditempuh, ja_mst_mk.kode_mk, ja_mst_mk.nama_mk, pw_mst_mahasiswa.nama_mhs as mahasiswa, pw_mst_mahasiswa.nim as npm');
        $this->db->from('mk_ambil');
        $this->db->join('ja_mst_mk', 'mk_ambil.kode_mk = ja_mst_mk.kode_mk');
        $this->db->join('pw_mst_mahasiswa', 'mk_ambil.nim = pw_mst_mahasiswa.nim');
        $this->db->where("mk_ambil.kode_mk",$key);
        $this->db->where("mk_ambil.semester_ditempuh",$semester);
        $query = $this->db->get();

        if($query->num_rows()>0)
		{
			$array = array();
			foreach($query->result_array() as $row)
			{
				echo $row['nim'];
				echo "<br>";
				// insert data to database
			    $data = array(
	              'npm' => $row['nim'],
	              'matakuliah' => $key,
	              'status' => $status,
	              'date' => date("Y-m-d")
	            );
				$this->db->insert('absensi',$data);
			}
		}
		
	}

	function update() {
		$npm = 1108100210;
		$mk = 1111202;
		$tgl = date("2017-01-17");
		$id = 33;
		$data = array(
            'status' => 1
        );
		
		$this->db->where("npm", $npm);
		$this->db->where("matakuliah", $mk);
		$this->db->where("date", $tgl);
		//$this->db->where("id_absen", $id);
        $this->db->update("absensi", $data);
	}

	function rekap() {
		$npm = 1108100210;
		$mk = 1111315;
		$status = 1;
		$tgl = date("2017-01-17");
/*
		$this->db->select('*');
		//$this->db->select_sum('status');
		$this->db->where("matakuliah", $mk);
		//$this->db->where("status", $status);
		//$this->db->group_by('npm');
		$query = $this->db->get('absensi')->result_array();

		foreach ($query as $row) {
			echo $row['npm'];
			echo ' ';
			echo $row['status'];
			echo "<br>";
		}
*/
		//$data_page['data_rekap'] = $this->M_rekap->getData($mk, $tgl);
		//$this->load->view('rekap', $data_page);

		$query = $this->db->query("SELECT npm, status,
       			SUM(CASE WHEN status = '1' THEN status END) AS masuk,
       			SUM(CASE WHEN status = '2' THEN status END) AS terlambat,
       			SUM(CASE WHEN status = '3' THEN status END) AS absen
  				FROM absensi
  				WHERE matakuliah = $mk
				GROUP BY npm");

		foreach ($query->result_array() as $row) {
			$late = $row['terlambat'] / 2;
			$abstain = $row['absen'] / 3;
			echo $row['npm'];
			echo ' ';
			echo $row['masuk'];
			echo ' ';
			echo $late;
			echo ' ';
			echo $abstain;
			echo "<br>";
		}

	}

	function multi() {
		$var = ['image1.jpg', 'image2.jpg'];
		$nama = "nama";
		for ($i=0; $i < count($var); $i++) { 
			//echo $nama.($i+1);
			//echo "<br>";
			$data[$nama.($i+1)] = $var[$i];
			//echo "<br>";
		}
		
		//
		//$data['nama1'] = $var[0];
		//$data['nama2'] = $var[1];
		$this->_insert($data);

		echo "Success";
	}

	function _insert($data) {
		$this->db->insert('multiple', $data);
	}

}