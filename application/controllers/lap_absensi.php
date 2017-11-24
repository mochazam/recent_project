<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_absensi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form','html'));
	}

	public function index()
	{
		error_reporting(0);  //suppress some error message
		$parameters=array(
			'paper'=>'A4',   //paper size
			'orientation'=>'portrait',  //portrait or lanscape
			'type'=>'none',   //paper type: none|color|colour|image
			'options'=>array(0.6, 0.9, 0.8) //I specified the paper as color paper, so, here's the paper color (RGB)
		);
		$this->load->library('pdf', $parameters);  //load ezPdf library with above parameters
		
		$this->pdf->selectFont(APPPATH.'/third_party/pdf-php/fonts/Helvetica.afm');
  		//choose font, watch out for the dont location!
		$this->pdf->ezText('<b>Data Absensi</b>',16,array('justification' => 'center'));
		$this->pdf->ezSetDy(-5);
		$this->pdf->ezText('Teknik Informatika, Universitas Wijaya Kusuma',12,array('justification' => 'center'));
		$this->pdf->ezSetDy(-5);
		// Teks di tengah atas untuk judul header
		
		$all = $this->pdf->openObject();
    	$this->pdf->saveState();
    	$this->pdf->setStrokeColor(0,0,0,1);

		$this->pdf->ezSetMargins(50,60,60,60);
        $this->pdf->ezStartPageNumbers(790,22,8,'','{PAGENUM}',1);
        $this->pdf->line(40,40,800,40);
        $this->pdf->addText(650,570,10,'Printed on ' . date('m/d/Y h:i:s a'));
        $this->pdf->addText(50,25,10,'CI PDF Tutorial - http://chris.dev');

        $this->pdf->restoreState();
    	$this->pdf->closeObject();
        $this->pdf->addObject($all,'all');
		
		// get value from form
		//$tgl = $this->input->post('tanggal');
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$mk = $this->input->post('kd_mk');
		$nama_mk = $this->input->post('mk_name');

		$this->pdf->ezText($nama_mk,12,array('justification' => 'center'));
		$this->pdf->ezSetDy(-15);
		
		//get data from database (note: this should be on 'models' but mehhh..), we'll try creating table using ezPdf
		$this->db->select("pw_mst_mahasiswa.nim, pw_mst_mahasiswa.nama_mhs, absensi.npm, absensi.status, absensi.tgl_post, absensi.date");
        $this->db->from("pw_mst_mahasiswa");
        $this->db->join("absensi","pw_mst_mahasiswa.nim = absensi.npm");
        //$this->db->where("date", $tgl);
        $this->db->where("absensi.date >=",$start);
        $this->db->where("absensi.date <=",$end);
        $this->db->where("matakuliah", $mk);
        $this->db->order_by('nim', 'desc');
        $query = $this->db->get();
		//this data will be presented as table in PDF
        
        
        $jml = $query->num_rows();
        print_r($jml);

		if ($jml > 0){
			$i = 1;
			
			foreach ($query->result_array() as $key) {

				switch ($key['status']) {
	                case '1':
	                    $status = "Hadir";
	                    break;          
	                default:
	                    $status = "Terlambat";
	                    break;
	            }  

				$mydatetime = $key['tgl_post'];
	            $datetimearray = explode(" ", $mydatetime);
	            $date = $datetimearray[0];
	            $time = $datetimearray[1];
	            $reformatted_date = date('d-m-Y',strtotime($date));
	            $reformatted_time = date('H:i:s',strtotime($time));
			
			  $data[$i]=array(
			  		'No'=>$i, 
	          		'Nama Mahasiswa'=>$key['nama_mhs'],  
	          		'NPM'=>$key['nim'], 
	          		'Jam'=>$reformatted_time, 
	          		'Status'=>$status, 
	          		);
			  $i++;
			}
		}

		$options = array('fontSize'=>12);
		$this->pdf->ezTable($data, '', '', $options); //generate table
		//$this->pdf->ezTable($data_table, $column_header); //generate table
		$this->pdf->ezSetY(480);  //set vertical position
		//$this->pdf->ezImage(base_url('images/test_noalpha.png'), 0, 100, 'none', 'center');  //insert image
		$now = date('d/m/Y');
		$this->pdf->ezStream(array('Content-Disposition'=>$now.'_Data_absensi.pdf'));
 		 //force user to download the file as 'just_random_filename.pdf'
	}

}	