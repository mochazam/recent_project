<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	function index() {
		$this->load->model('m_model');
		$dataKota = $this->m_model->getDataKota();
		$data['kota'] = $dataKota;
		$this->load->view('view1', $data);
	}

	function get_kecamatan() {
		$this->load->model('m_model');
		$id_kota = $this->input->post('id_kota');
		$dataKecamatan = $this->m_model->getDataKecamatan($id_kota);

		echo '<select name="kecamatan" id="kecamatan">';
		foreach ($dataKecamatan as $a) {
			echo '<option value="'.$a->id_kecamatan.'">'.$a->nama_kecamatan.'</option>';
		}
		echo '</select>';
 	}

}
