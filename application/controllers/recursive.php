<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Recursive extends CI_controller 
{

	public function __construct() {
        parent::__construct();       
        $this->load->helper('directory');
    }
 
    function index() {
        
        $dir = APPPATH. "views/sinkron/";
		$map = directory_map($dir);
		echo "<select name='yourfiles'>";
		
		$this->show_dir_files($map,'');
		
		echo "</select>";

    }

    function show_dir_files($in,$path) {
	 	foreach ($in as $k => $v) {
			if (!is_array($v)) {
				echo "<option>".$path,$v."</option>";
	 		} else {
	 			print_dir($v,$path.$k.DIRECTORY_SEPARATOR);
	 		}
	 	}
	}

}	