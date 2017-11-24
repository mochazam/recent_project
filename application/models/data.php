<?php

class Data extends CI_Model{
    //put your code here
    
    public function get_kota_by() {
        error_reporting(-1);

        $id = $this->input->post('prov_id');
        $this->db->select('*');
        $this->db->from('kota');
        $this->db->where('id_provinsi', $id);
        $query = $this->db->get();

        $no = 1;
        foreach ($query->result() as $row)
        {   
                        

            echo "<tr>";
            echo "<td style=\"text-align: left\">".$no."</td>";
            echo "<td style=\"text-align: left\">".$row->name."</td>";
            echo "<td style=\"text-align: left\">".$row->id_provinsi."</td>";
            echo "</tr>"; 
            $no++;
            
        }
    }
}