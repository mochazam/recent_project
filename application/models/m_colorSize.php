<?php 

class M_colorSize extends CI_Model {

	function getActiveSizes(){
	/*	
	    $data = array();
	    $this->db->select('id,name');
	    $this->db->where('status','active');
	    $Q = $this->db->get('sizes');
	    if ($Q->num_rows() > 0){
	        foreach ($Q->result_array() as $row){
	          	$data[$row['id']] = $row['name'];
	        }
	    }
	    $Q->free_result();  
	    return $data; 
	*/
	    $id = 69;

	    $this->db->select('*');
	    $this->db->from('sizes');
	    $this->db->join('products_sizes', 'products_sizes.size_id = sizes.id');
	    $this->db->where('status','active');
	    $this->db->where('product_id',$id);
	    $query = $this->db->get();
	    $hasil = $query->result();
        return $hasil;
    }

    function getActiveColors(){    
    /*	
        $this->db->select('id,name');
        $this->db->where('status','active');
        $query = $this->db->get('colors');
        $data = array();
        foreach ($query->result_array() as $row) {
            $data[$row['id']] = $row['name'];
            
        }

        return $data; 
    */   
        $id = 66;

    	$this->db->select('*');
	    $this->db->from('colors');
	    $this->db->join('products_colors', 'products_colors.color_id = colors.id');
	    $this->db->where('status','active');
	    $this->db->where('product_id',$id);
	    $query = $this->db->get();
	    $hasil = $query->result();
        return $hasil;    
    }

}