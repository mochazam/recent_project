<?php
class Queries extends CI_Model {
    //put your code here
    function __construct(){
        parent::__construct();
    }    
    
    function delete_data() {
        $this->db->delete('mk_ambil', array('id' => $this->input->post('id')));
        return true;        
    }
}