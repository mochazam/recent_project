<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Pinit extends CI_Controller {

	function __construct(){
		parent::__construct();
		$table1 = 'map';
        $table2 = 'pinit';
        $this->load->model(array('M_map', 'app_model'));
		$this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
        $this->destination = realpath(APPPATH. '../maps/');
		date_default_timezone_set('Asia/Jakarta');
	}
 
    function index(){
        $this->go($param1 = '', $param2 = '', $param3 = '');
    }

    function go($param1 = '', $param2 = '', $param3 = '')
    {
        $tanggal = date('Y-m-d');
        if ($param1 == 'create') {
            $this->form_validation->set_rules('nama_map', 'nama_map', 'required');
            $this->form_validation->set_rules('map_file', 'map_file', 'required');

            $this->load->library('upload');

            $nmfile = "map-".date("Y-m-d"); //nama file saya beri nama langsung dan diikuti fungsi time
           
            $config['upload_path'] = './maps/'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
            $config['file_name'] = $_FILES['map_file']['name']; //$nmfile; //nama yang terupload nantinya
        
            $this->upload->initialize($config);

            //var_dump($_FILES['map_file']['name']);
            //die();

            //if ($this->form_validation->run() == TRUE) {


                if ($this->upload->do_upload('map_file'))
                {
                    $data = array(
                        'nama_map' => $this->input->post('nama_map'),
                        'date' => date('Y-m-d'),
                        'image' => $_FILES['map_file']['name']
                    );
                        
                    $this->M_map->get_insert($data); //akses model untuk menyimpan ke database
                    $this->session->set_flashdata('flash_message' , 'data added successfully');

                    redirect(base_url() . 'pinit', 'refresh');
                //}  
                
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'pinit', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('nama_map', 'nama_map', 'required');
            $this->form_validation->set_rules('map_file', 'map_file', 'required');

            $this->load->library('upload');

            $nmfile = "map-".date("Y-m-d"); //nama file saya beri nama langsung dan diikuti fungsi time
           
            $config['upload_path'] = './maps'; //path folder
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
            $config['file_name'] = $_FILES['map_file']['name']; //$nmfile; //nama yang terupload nantinya
        
            $this->upload->initialize($config);

            //if ($this->form_validation->run() == TRUE) {

                if ($this->upload->do_upload('map_file'))
                {
                    $data = array(
                        'nama_map' => $this->input->post('nama_map'),
                        'date' => date('Y-m-d'),
                        'image' => $_FILES['map_file']['name']
                    );
                        
                    $this->db->select('*');
                    $this->db->where(array('id'=>$param2));
                    $query = $this->db->get('map');
                    $result =  $query->first_row('array');
                    $nama = $result['image'];
                    
                    //hapus file dari server
                       
                    // lokasi folder file
                    $map = $_SERVER['DOCUMENT_ROOT'];
                    $path = $this->destination . '/';
                    //lokasi gambar secara spesifik
                    $map = $path.$nama;
                    //hapus image
                    unlink($map);

                    $this->M_map->get_update($data,$param2);
                    $this->session->set_flashdata('flash_message' , 'data updated');
                    redirect(base_url() . 'pinit', 'refresh');
                //}

                
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'pinit', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            // cek nama file di DB
            $this->db->select('*');
            $this->db->where(array('id'=>$param2));
            $data =  $this->db->get('map');
            $result =  $data->first_row('array');
            $nama = $result['image'];

            // lokasi folder file
            $map = $_SERVER['DOCUMENT_ROOT'];
            $path = $this->destination . '/';
            //lokasi gambar secara spesifik
            $map = $path.$nama;
            //hapus image
            unlink($map);

            $this->M_map->delete($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'map', 'refresh');
        }
        $data_page['data_map'] = $this->M_map->getMap();        
        $data_page['page_name']  = 'customer';
        $data_page['page_title'] = 'manage map';
        $this->load->view('pin', $data_page);
    }

    public function show($param) {
        // get map
        $this->db->select('*');
        $this->db->where(array('id'=>$param));
        $query =  $this->db->get('map');
        $result =  $query->first_row('array');
        $nama = $result['image'];

        $data['id_map'] = $param;
        $data['image_map'] = $nama;
        $data['data_pin'] = $this->M_map->getAllPin($param);
        $this->load->view('v_pin', $data);
    }

    function getData() {
        if ('IS_AJAX') {
            $key = $this->input->post('id');
        }    
        $result = $this->M_map->getAllData($key);
        // $result = $this->M_map->getRightData($key);
        return $result;
    }

    function getRightData() {
        if ('IS_AJAX') {
            $key = $this->input->post('id');
        }    
        $result = $this->M_map->getRightData($key);
        return $result;
    }

    public function addPin() {
    	if ('IS_AJAX') {
            $id_map = $this->input->post('id_map');
            $title = $this->input->post('title_name');
    		$nodeX = $this->input->post('nodex');
    		$nodeY = $this->input->post('nodey'); 

    		$data = array(
                'map_id' => $id_map,
                'title' => $title,
                'xaxis' => $nodeX,
                'yaxis' => $nodeY,
                'date' => date('Y-m-d')
            );
    	}

    	$this->db->insert('pinit', $data);
    }

    public function dropPin($param) {
        $this->db->where('id',$param);
        $this->db->delete('pinit');
        redirect(base_url() . 'pinit/show', 'refresh');
    }

    function getAllData() { 
        if('IS_AJAX') {
            $map_id = $this->input->post('map_id');
        }
        $result = $this->M_map->getPinData($map_id);
        return $result;
    }

    function delAll() {
        if('IS_AJAX') {
            $myid = $this->input->post('id');
            $id = str_replace(' ', ',', $myid);
        }

        $result = $this->M_map->deleteID($id);

        return $result; 
    }
}