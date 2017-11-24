<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Exam extends CI_controller 
{
	function __construct(){
		parent::__construct();
		$this->load->model(array('M_exam'));
        $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email'));
        $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download'));
        header('Content-Type: text/html; charset=UTF-8');
	}

	function index(){
		$data['tests'] = $this->M_exam->getTest();
		$this->load->view('test_list', $data);
	}

	function manage_exam($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
            $this->form_validation->set_rules('test_name', 'test_name', 'required');

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'test_name' => $this->input->post('nama'),
                    'slug' => url_title($this->input->post('nama')),
                    'time' => $this->input->post('time')*60,
                    'date' => date('Y-m-d')
                );
               
                $this->M_exam->get_insert($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'exam/manage_exam', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'exam/manage_exam', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('nama_artikel', 'nama_artikel', 'required');

            if ($this->form_validation->run() == TRUE) {
            	$data = array(
                    'test_name' => $this->input->post('nama'),
                    'slug' => url_title($this->input->post('nama')),
                    'time' => $this->input->post('time')*60,
                    'date' => date('Y-m-d')
                );

                $this->M_exam->get_update($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'exam/manage_exam', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'exam/manage_exam', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_exam->delete($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'exam/manage_exam', 'refresh');
        }
		$data_page['data_exam'] = $this->M_exam->getTest();        
		$data_page['page_name']  = 'exam';
		$data_page['article']  = 'active';
        $data_page['page_title'] = 'manage exam';
        $this->load->view('manage_exam', $data_page);
    }

    function manage_question($param1 = '', $param2 = '', $param3 = '')
    {
        if ($param1 == 'create') {
            $this->form_validation->set_rules('question', 'question', 'required');

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'test_id' => $this->input->post('test_id'),
                    'question' => $this->input->post('question'),
                    'option1' => $this->input->post('option1'),
                    'option2' => $this->input->post('option2'),
                    'option3' => $this->input->post('option3'),
                    'option4' => $this->input->post('option4'),
                    'answer' => $this->input->post('answer')
                );
               
                $this->M_exam->get_insertQuestion($data); //akses model untuk menyimpan ke database
                $this->session->set_flashdata('flash_message' , 'data added successfully');

                redirect(base_url() . 'exam/manage_question', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal disimpan');
                redirect(base_url() . 'exam/manage_question', 'refresh');
            }
        }
        if ($param1 == 'edit') {
            $this->form_validation->set_rules('nama_artikel', 'nama_artikel', 'required');

            if ($this->form_validation->run() == TRUE) {
            	$data = array(
                    'test_id' => $this->input->post('test_id'),
                    'question' => $this->input->post('question'),
                    'option1' => $this->input->post('option1'),
                    'option2' => $this->input->post('option2'),
                    'option3' => $this->input->post('option3'),
                    'option4' => $this->input->post('option4'),
                    'answer' => $this->input->post('answer')
                );

                $this->M_exam->get_updateQuestion($data,$param2);
                $this->session->set_flashdata('flash_message' , 'data updated');
                redirect(base_url() . 'exam/manage_question', 'refresh');
            } else {
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata('flash_message_error' , 'data gagal diupdate');
                redirect(base_url() . 'exam/manage_question', 'refresh');
            }
        }
        if ($param1 == 'delete') {
            $this->M_exam->deleteQuestion($param2);
            $this->session->set_flashdata('flash_message' , 'data deleted');
            redirect(base_url() . 'exam/manage_question', 'refresh');
        }
		$data_page['data_question'] = $this->M_exam->getAllQuestion();        
		$data_page['page_name']  = 'question';
		$data_page['article']  = 'active';
        $data_page['page_title'] = 'manage question';
        $this->load->view('manage_question', $data_page);
    }

	function test($id) {
		$data['questions'] = $this->M_exam->getQuestion($id);
		$query = $this->M_exam->getTime($id);
		foreach ($query as $row) {
			$count_time = $row['time'];
		}
		$data['count_time'] = $count_time;
		$this->load->view('exam_online', $data);
	}

	function result() {

		$mark = 0;

		$datas = $this->M_exam->select_question_details_by_test_id(1);

		foreach ($datas as $test) {
			if ($this->input->post('quizId'.$test['id']) == $test['answer']) {
				$mark += 1;
			}	
			// } elseif ($this->input->post('quizId'.$test['id']) != $test['answer']) {
			// 	$mark -= 1;
			// }
		}

		$data['marks'] = $mark;
		$this->load->view('result', $data);
	}
   
}