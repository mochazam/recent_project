<?php

class Comic extends CI_Controller
{

	function __construct(){
		parent::__construct();
		$this->load->model(array('M_comic'));
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download','util'));
		date_default_timezone_set('Asia/Jakarta');
	}

	function index(){
		// $data['getComic'] = $this->M_comic->getComicName();
		// $this->load->view('upload_view', $data);
		$this->go($param1 = '', $param2 = '', $param3 = '');
	}

	function go($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
            $this->form_validation->set_rules('nama_komik', 'nama_komik', 'required');

            if ($this->form_validation->run() == TRUE) {
            	if ($this->input->post('com_id') == '') {
            		$comic_id = 0;
            	} else {
            		$comic_id = $this->input->post('com_id');
            	}
                $data = array(
                        'nama_komik' => $this->input->post('nama_komik'),
                        'slug' => url_title($this->input->post('nama_komik')),
                        'com_id' => $comic_id,
                        'keterangan' => $this->input->post('keterangan'),
                        'date' => date('Y-m-d')
                );
               
                $this->M_comic->get_com_insert($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'comic', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'comic', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('nama_komik', 'nama_komik', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                        'nama_komik' => $this->input->post('nama_komik'),
                        'slug' => url_title($this->input->post('nama_komik')),
                        'keterangan' => $this->input->post('keterangan'),
                        'date' => date('Y-m-d')
                    );

                $this->M_comic->get_com_update($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'comic', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'comic', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_comic->delete_com($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'comic', 'refresh');
        }
		$data_page['data_komik'] = $this->M_comic->getComicName();        
		$data_page['page_name']  = 'customer';
		$data_page['category']  = 'active';
        $data_page['page_title'] = 'manage kustomer';
        $this->load->view('comic_list', $data_page);
    }

    function getComic($param1 = '', $param2 = '', $param3 = '') {
    	if ($param1 == 'delete') {
            $this->M_comic->delete_com($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'comic/getComic/'.$param3, 'refresh');
        }
    	$data_page['id'] = $param1;
    	$data_page['detail_komik'] = $this->M_comic->getDetailComic($param1);   
    	$data_page['komik_seri'] = $this->M_comic->getComicById($param1);    
		$data_page['page_name']  = 'customer';
		$data_page['category']  = 'active';
        $data_page['page_title'] = 'manage kustomer';
        $this->load->view('comic_detail', $data_page);
    }

    function showComic($id) {
    	$data_page['judul'] = $this->getName($id);
    	$data_page['numbers'] = $this->getCountFiles($id);
    	$data_page['folder'] = $this->getDirName($id);
    	$this->load->view('comic_show', $data_page);
    }

    function storeComic($param1) {
    	$data_page['id'] = $param1;
    	$this->load->view('add_seri', $data_page);
    }

    function delSerie($param1) {
    	if ($param1 == 'delete') {
            $this->M_comic->delete_com($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'comic', 'refresh');
        }
    }

    function storeSerie($param1) {
    	$this->form_validation->set_rules('nama_komik', 'nama_komik', 'required');

    	$this->load->library('upload');
       
        $config['upload_path'] = './upload/komik/compress/'; //path folder
        $config['allowed_types'] = 'zip|rar'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '20048'; //maksimum besar file 20M
        $config['file_name'] = $_FILES['compress_file']['name']; //$nmfile; //nama yang terupload nantinya
	
        $this->upload->initialize($config);

    	if ($this->upload->do_upload('compress_file'))
        {
            $data = array(
	                'nama_komik' => $this->input->post('nama_komik'),
	                'slug' => url_title($this->input->post('nama_komik')),
	                'com_id' => $this->input->post('com_id'),
	                'date' => date('Y-m-d'),
	                'file' => $_FILES['compress_file']['name']
	        );

            //Unzip file

            $full_path = $this->upload->data('full_path');
            /**** without library ****/
            $zip = new ZipArchive;
 
            if ($zip->open($full_path) === TRUE) 
            {
                $zip->extractTo(FCPATH.'/upload/komik/');
                $zip->close();
            }

	        $this->M_comic->get_com_insert($data); //akses model untuk menyimpan ke database
	        $this->session->set_flashdata('flash_message' , 'data added successfully');

	        redirect(base_url() . 'comic/getComic/'.$param1, 'refresh');
	    } else {
            //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
            $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
            redirect(base_url() . 'comic/getComic/'.$param1, 'refresh');
        }    

    }

    function getDirName($id = '') {
    	// get directory name from id
        $this->db->select('*');
        $this->db->where(array('id'=>$id));
        $query = $this->db->get('komik');
        $result =  $query->first_row('array');
        $file = $result['file'];

        //$file = 'KomOPM127-SAMEHADAKU_NET';
    	$target = preg_replace("/\.zip$/i", "", $file); //'KomOPM127';
    	return $target;
    }

    function getName($id = '') {
    	// get directory name from id
        $this->db->select('*');
        $this->db->where(array('id'=>$id));
        $query = $this->db->get('komik');
        $result =  $query->first_row('array');
        $nama_komik = $result['nama_komik'];

    	return $nama_komik;
    }

    function getCountFiles($id = '') {
    	// // get directory name from id
     //    $this->db->select('*');
     //    $this->db->where(array('id'=>$id));
     //    $query = $this->db->get('komik');
     //    $result =  $query->first_row('array');
     //    $file = $result['file'];

     //    //$file = 'KomOPM127-SAMEHADAKU_NET';
    	// $target = preg_replace("/\.zip$/i", "", $file); //'KomOPM127';
    	$directory = FCPATH.'/upload/komik/'.$this->getDirName($id).'/';
		$files = glob($directory . '*.jpg');

		if ( $files !== false )
		{
		    $filecount = count( $files );
		    //echo $filecount;
		}
		// get number
		$arr = [];
		for ($i = 0; $i <= $filecount; $i++) {
            // echo add_leading_zero($i);
            // echo "<br>";
            $arr[$i] = add_leading_zero($i);
            
      	}
      	return $arr;
      	//print_r($arr);
      	//echo implode('', $arr);
      	
    }

	//Untuk proses upload foto
	function proses_upload(){

        $config['upload_path']   = FCPATH.'/upload-foto/';
        $config['allowed_types'] = 'gif|jpg|png|ico';
        $this->load->library('upload',$config);

        if($this->upload->do_upload('userfile')){
        	$token=$this->input->post('token_foto');
        	$nama=$this->upload->data('file_name');
        	$this->db->insert('foto',array('nama_foto'=>$nama,'token'=>$token));
        }
	}


	//Untuk menghapus foto
	function remove_foto(){

		//Ambil token foto
		$token=$this->input->post('token');

		
		$foto=$this->db->get_where('foto',array('token'=>$token));


		if($foto->num_rows()>0){
			$hasil=$foto->row();
			$nama_foto=$hasil->nama_foto;
			if(file_exists($file=FCPATH.'/upload-foto/'.$nama_foto)){
				unlink($file);
			}
			$this->db->delete('foto',array('token'=>$token));

		}


		echo "{}";
	}

}