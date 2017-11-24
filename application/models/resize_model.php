<?php

class Resize_model extends CI_Model {

	var $resized_path;
	function __construct() {
        parent::__construct();
        $this->resized_path = realpath(APPPATH. '../upload');
        $this->load->library('image_lib');
    }

    function do_upload($nama_file) {

        $data = $this->upload->data($nama_file);
        $image_data = $this->upload->data();
        $nama_filenya = $image_data['file_name'];

        $config = array(
            'source_image'      => $image_data['full_path'], //path to the uploaded image
            'new_image'         => $this->resized_path . '/resized', //path to
            'maintain_ratio'    => false,
            'width'             => 350,
            'height'            => 537,
            // watermark config
            /*'wm_text' => 'harviacode.com',
            'wm_type' => 'text',
            'wm_font_path' => './system/fonts/texb.ttf',
            'wm_font_size' => '16',
            'wm_font_color' => 'ffffff',
            'wm_vrt_alignment' => 'middle',
            'wm_hor_alignment' => 'center'
            */// end watermark config
        );

        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        // watermark
        //$this->image_lib->watermark();
        // end watermark
        return $nama_filenya;
    }

    function do_watermark($nama_file) {

        $data = $this->upload->data($nama_file);
        $image_data = $this->upload->data();
        $nama_filenya = $image_data['file_name'];
        $pathnya = $image_data['full_path'];

        $config = array(
            'source_image'      => $image_data['full_path'], //path to the uploaded image
            //'new_image'         => $this->resized_path . '/resized', //path to
            // watermark config

            // watermark with image
            // 'wm_overlay_path' => 'images/agem.jpg'; /*path gambar watermark pada server yang akan ditambahkan*/
            // 'dynamic_output' => true; /*True, yang berarti gambar akan ditampilkan di klien dan tidak disimpan pada disk server*/
            // 'wm_vrt_alignment' => 'midle'; /*Posisi gambar watermark berada di tengah garis vertikal terhadap gambar*/
            // 'wm_hor_alignment' => 'center'; /*Posisi gambar watermark berada di tengah garis horizontal terhadap gambar*/
            // 'wm_opacity' => 65; /*Nilai opacity gambar watermark*/
            // 'wm_type' => 'overlay'; /*Tipe Watermark*/

            // watermark with text
            'wm_text' => 'harviacode.com',
            'wm_type' => 'text',
            'wm_font_path' => './system/fonts/texb.ttf',
            'wm_font_size' => '16',
            'wm_font_color' => 'ffffff',
            'wm_vrt_alignment' => 'middle',
            'wm_hor_alignment' => 'center'
            // end watermark config

        );

        $this->image_lib->initialize($config);
        // watermark
        $this->image_lib->watermark();
        // end watermark
        return $nama_filenya;
    }


}
