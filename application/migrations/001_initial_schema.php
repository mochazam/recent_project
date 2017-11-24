<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Initial_schema extends CI_Migration {

 	public function up() {
        $this->load->dbforge();
        $this->dbforge->add_field(array(
		    'blog_id' => array(
		    	'type' => 'INT',
		    	'constraint' => 5,
		    	'unsigned' => TRUE,
		    	'auto_increment' => TRUE
		   	),
		   	'blog_title' => array(
		    	'type' => 'VARCHAR',
		    	'constraint' => '100',
		   	),
		   	'blog_description' => array(
		    	'type' => 'TEXT',
		    	'null' => TRUE,
		   	),
		));

        $this->dbforge->add_key('blog_id', TRUE);  
        $this->dbforge->create_table('blog', TRUE);
 	}

 	public function down() {
        $this->load->dbforge();  
        $this->dbforge->drop_table('blog', TRUE);
 	}

}