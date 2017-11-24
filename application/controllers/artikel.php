<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Artikel extends CI_controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_artikel', 'app_model'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email', 'Parsedown'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
        header('Content-Type: text/html; charset=UTF-8');
	}

	function index(){
		$this->go($param1 = '', $param2 = '', $param3 = '');
	}

	function go($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
            $this->form_validation->set_rules('nama_artikel', 'nama_artikel', 'required');

            if ($this->form_validation->run() == TRUE) {

            	//cek id data terakhir
            	$kategori_id = $this->input->post('kategori_id');
            	$this->db->where('kategori_id', $kategori_id);
                $query = $this->db->get('artikel');
		                    	
		        if ($query->num_rows()>0) {
		        	
                    $mysql = "SELECT * FROM artikel WHERE kategori_id = $kategori_id ORDER BY id DESC LIMIT 1";
					$hasil = $this->db->query($mysql);

					foreach ($hasil->result() as $row) {
						$artikel_id = $row->artikel_id;
					}

					$artikel_id +=1;

		        } else {
		        	$artikel_id = 1;
		        }

                // var_dump($artikel_id);
                // die();

                $data = array(
                        'kategori_id' => $kategori_id,
                        'artikel_id' => $artikel_id,
                        'nama_artikel' => $this->input->post('nama_artikel'),
                        'slug' => url_title($this->input->post('nama_artikel')),
                        'body' => $this->parsedown->text($this->input->post('isi')),
                        'parse' => $this->input->post('isi'),
                        'date' => date('Y-m-d')
                    );
               
                $this->M_artikel->get_insert($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'artikel', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'artikel', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('nama_artikel', 'nama_artikel', 'required');

            if ($this->form_validation->run() == TRUE) {
            	$data = array(
                        'kategori_id' => $this->input->post('kategori_id'),
                        'nama_artikel' => $this->input->post('nama_artikel'),
                        'slug' => url_title($this->input->post('nama_artikel')),
                        'body' => $this->parsedown->text($this->input->post('isi')),
                        'parse' => $this->input->post('isi'),
                        'date' => date('Y-m-d')
                    );

                $this->M_artikel->get_update($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'artikel', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'artikel', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_artikel->delete($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'artikel', 'refresh');
        }
		$data_page['data_artikel'] = $this->M_artikel->getArtikel();        
		$data_page['page_name']  = 'customer';
		$data_page['article']  = 'active';
        $data_page['page_title'] = 'manage kustomer';
        $this->load->view('artikel', $data_page);
    }

    function category($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
            $this->form_validation->set_rules('nama_kategori', 'nama_kategori', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                        'nama_kategori' => $this->input->post('nama_kategori'),
                        'date' => date('Y-m-d')
                    );
               
                $this->M_artikel->get_cat_insert($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'artikel/category', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'artikel/category', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('nama_kategori', 'nama_kategori', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                        'nama_kategori' => $this->input->post('nama_kategori'),
                        'date' => date('Y-m-d')
                    );

                $this->M_artikel->get_cat_update($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'artikel/category', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'artikel/category', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_artikel->delete_category($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'artikel/category', 'refresh');
        }
		$data_page['data_kategori'] = $this->M_artikel->getCategory();        
		$data_page['page_name']  = 'customer';
		$data_page['category']  = 'active';
        $data_page['page_title'] = 'manage kustomer';
        $this->load->view('kategori', $data_page);
    }

    function show($param1 = '', $param2 = '') {
        // get kategori id from nama kategori
        $this->db->select('*');
        $this->db->where(array('nama_kategori'=>$param1));
        $query = $this->db->get('kategori');
        $result =  $query->first_row('array');
        $id_artikel = $result['id'];
        if ($param2 != '') {
            $content = $this->M_artikel->getContent($id_artikel, $param2);
            // get ID
            $this->db->select('*');
            $this->db->where(array('slug'=>$param2));
            $query = $this->db->get('artikel');
            $result =  $query->first_row('array');
            $getID = $result['artikel_id'];
        } else {
            $content = $this->M_artikel->content($id_artikel);
            $getID = 1;
        }

        foreach ($content->result() as $val) {
            $konten = $val->body;
        }
        $data_page['content'] = $content;
        $data_page['deskripsi'] = str_replace("-", " ", $param2);
        $data_page['estimasi'] = $this->estimate_reading_time($konten);
        $data_page['menu_sidebar'] = $this->M_artikel->menu($id_artikel);
        $data_page['next_page'] = $this->get_next_id($id_artikel, $getID);
        $data_page['prev_page'] = $this->get_prev_id($id_artikel, $getID);

        $this->load->view('news', $data_page);
    }

    function estimate_reading_time($content) {
        $word_count = str_word_count(strip_tags($content));

        $minutes = floor($word_count / 200);
        $seconds = floor($word_count % 200 / (200 / 60));

        $str_minutes = ($minutes == 1) ? "minute" : "minutes";
        $str_seconds = ($seconds == 1) ? "second" : "seconds";

        if ($minutes == 0) {
            return "{$seconds} {$str_seconds}";
        }
        else {
            return "{$minutes} {$str_minutes}, {$seconds} {$str_seconds}";
        }
    }

    function changeArtikel() {
        
    }

    function get_next_id($param1 = '', $param2 = '') {
        if ($param2 != '') {
            # code...
        }
		$mysql_next = "SELECT * FROM artikel WHERE artikel_id > $param2 AND kategori_id = $param1 ORDER BY id ASC LIMIT 1";
		$result = $this->db->query($mysql_next);
		return $result;
	}

	function get_prev_id($param1 = '', $param2 = '') {
		$mysql_prev = "SELECT * FROM artikel WHERE artikel_id < $param2 AND kategori_id = $param1 ORDER BY id DESC LIMIT 1";
		$result = $this->db->query($mysql_prev);
		return $result;
	}

    function preview() {
        // load library parsedown
        $this->load->library('Parsedown');

        // $data['success'] = false;
        // $data['output'] = '';

        // if ($this->input->post('html')) {
        //     $string = str_replace('\n', '\r\n', $this->input->post('html'));
        //     $data['success'] = true;
        //     $data['output'] = $this->parsedown->text($string);
        // }

        // echo json_encode($data);
        $string = '# Hello **Parsedown**!';
        $result = $this->parsedown->text($string);
        echo $result;
    }

    function example() {
        $this->load->library('Parsedown');
        $text = 'Hello **Parsedown**!';
        $result = Parsedown::instance()->parse($text);
        echo $result;
    }

}