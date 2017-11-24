<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {

  	public function index() {
    	$this->load->library('migration');

    	if ( ! $this->migration->current()) {
      		show_error($this->migration->error_string());
    	} else {
    		echo 'The migration has concluded successfully.';
    	}

  	}

  	public function undo_migration($version = NULL) {
	    $this->load->library('migration');
	    $migrations = $this->migration->find_migrations();
	    $migration_keys = array();
	    foreach($migrations as $key => $migration) {
	      $migration_keys[] = $key;
	    }
	    if(isset($version) && array_key_exists($version,$migrations) && $this->migration->version($version)) {
	      	echo 'The migration was reset to the version: '.$version;
	      	exit;
	    } elseif(isset($version) && !array_key_exists($version,$migrations)) {
	      	echo 'The migration with version number '.$version.' doesn\'t exist.';
	    } else {
	      	$penultimate = (sizeof($migration_keys)==1) ? 0 : $migration_keys[sizeof($migration_keys) - 2];
	      	if($this->migration->version($penultimate)) {
	        	echo 'The migration has been rolled back successfully.';
	        	exit;
	      	} else {
	        	echo 'Couldn\'t roll back the migration.';
	        	exit;
	      	}
		}
  	}

}