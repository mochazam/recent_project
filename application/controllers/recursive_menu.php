<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Recursive_menu extends CI_Controller {
 
    function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
    }
    

    function index() {
	    echo $this->menu(0,$h="");
	}

    private function menu($parent=0,$hasil) {
        $w = $this->db->query("SELECT * from tbl_menu where id_parent='".$parent."'");
        
        if(($w->num_rows())>0) {
            $hasil .= "<ul>";
        }

        foreach($w->result() as $h) {
            $this->db->where("id_parent",$h->id_menu);
            if ($this->db->count_all_results('tbl_menu') != 0) {
                $hasil .= "<li><a href='#'>".$h->menu."</a>";
                $hasil = $this->menu($h->id_menu,$hasil);
                
            } else {
                $hasil .= "<li>".anchor(array('category', $h->id_menu), $h->menu) . "</li>";
            }

            $hasil .= "</li>";
        }

        if(($w->num_rows)>0) {
            $hasil .= "</ul>";
        }
        return $hasil;
        
        //$this->load->view('menu_recursive');
    }
	
}