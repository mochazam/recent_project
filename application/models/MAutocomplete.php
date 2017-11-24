<?php 
class MAutocomplete extends CI_Model{ 
    function lookup($keyword){ 
        $this->db->select('*')->from('nation'); 
        $this->db->like('printable_name',$keyword,'after'); 
        $this->db->or_like('iso',$keyword,'after'); 
        $query = $this->db->get();     
        return $query->result(); 
    } 
} 