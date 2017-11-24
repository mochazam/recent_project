<?php

class M_notify extends CI_Model {

	var $table = 'comments';
	function __construct() {
        parent::__construct();
    }

    function get_insert($data){
       	$this->db->insert($this->table, $data);
      	return TRUE;
    }

    function get_update($data, $key){
        $this->db->where("comment_status", $key);
        $this->db->update($this->table, $data);
        return TRUE;
    }

    function getData() {
        // $this->db->select('*');
        // $this->db->from($this->table);
        // $this->db->order_by('comment_id');
        // $this->db->limit(5);
        
        // $query = $this->db->get();
        $query = $this->db->select('*')
                ->order_by('comment_id')
                ->limit(5)
                ->get($this->table);
        $output = '';
        if ($query->num_rows() > 0) {
        	foreach ($query->result() as $row) {
        		$output .='
        			<li>
						<a href="#">
							<strong>'.$row->comment_subject.'</strong><br>
							<small><em>'.$row->comment_text.'</em></small>
						</a>
					</li>
        		';
        	}
        } else {
        	$output .='
        		<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>
        	';
        }

        // count
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('comment_status', 0);
        $query2 = $this->db->get();
        $count = $query2->num_rows();

        $data = array(
        	'notification' => $output,
        	'unseen_notification' => $count
        );
        echo json_encode($data);
    }

}