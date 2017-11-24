<?php

class M_map extends CI_Model {

	var $table = 'map';
	var $table2 = 'pinit';
	function __construct() {
        parent::__construct();
    }

    function getMap() {
    	$getb = $this->db->get($this->table);
    	return $getb;
    }

    function delete($key){
        $this->db->where('id',$key);
        $this->db->delete($this->table);
    }    

    //fungsi insert ke database
    function get_insert($data){
       	$this->db->insert($this->table, $data);
      	return TRUE;
    }

    function get_update($data, $key){
        $this->db->where("id", $key);
        $this->db->update($this->table, $data);
        return TRUE;
    }

    public function getAllData($key) {
        $this->db->select("*");
        $this->db->from($this->table2);
        $this->db->where('map_id', $key);
        $query = $this->db->get();

        $arr = array();
        foreach ($query->result_array() as $row)
        {   
          
            $arr[] = $row;
        }

        $base_out = array();

	    // Kind of dirty, but doesnt hurt much with low number of records
	    foreach ($arr as $key => $record) {
	        // id_codes were necessary before, to keep track of ports (by id_code), 
	        // but they bother json now, so we do...
	        $base_out[] = $record;
	    }

	    $json = json_encode($base_out);

	    echo $json;

	 
    }

    public function getRightData($key) {
        $this->db->select("*");
        $this->db->from($this->table2);
        $this->db->where('map_id', $key);
        $query = $this->db->get();

        $no = 1;
        foreach ($query->result() as $row)
        {   
            echo "<div id='poli' class='grey'>";
            echo "<div class='caption2 grid-align-center'>";            
            echo "<div>";
            echo "<span class='badge badge-danger'>".$no."</span>";
            echo "</div>";
            echo "<strong>".$row->title."</strong>";            
            echo "<div class='no-float-center'>";
            echo "<span class='price2'>";
            echo "<span class='price-valuta2'>Rp.</span>"; 
            echo "<span itemprop='price' class='harga'>350.<span class='kecil2'>000</span></span>";
            echo "</span>";
            echo "</div></div></div>";

            $no++;
        }
    }

    function getAllPin($key) {
        $this->db->select("*");
        $this->db->from("pinit");
        $this->db->where('map_id', $key);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function getPinData($key) {
        $this->db->select("*");
        $this->db->from("pinit");
        $this->db->where('map_id', $key);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();

        $no = 1;
        foreach ($query->result() as $row)
        {   
            
            echo "<tr>";
            echo "<td class='text-center'><input type='checkbox' class='checkitem' value='".$row->id."'></td>";
            echo "<td>".$no."</td>";
            echo "<td>".$row->title."</td>";
            echo "<td>".$row->id."</td>";
            echo "<td>".$row->xaxis."</td>";
            echo "<td>".$row->yaxis."</td>";
            echo "<td>".$row->date."</td>";
            echo "<td><a href=\"#\" onclick=\"showAjaxModal('".base_url()."modal/popup/modal_pin_edit/".$row->id."');\" class=\"icon huge\" title=\"edit\"><i class=\"fa fa-pencil\"></i></a>&nbsp</td>";
            echo "</tr>"; 
            $no++;
        }
    }

    function deleteID($id) {
        $this->db->query("DELETE FROM pinit WHERE id IN ($id)");
    }

}
