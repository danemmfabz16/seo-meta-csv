<?php

class Config{

	public $prefix;
	public $dbase;
	public $meta_table;

	public function __construct(){
		global $wpdb;
		$this->dbase = $wpdb;
		$this->prefix = $this->dbase->prefix;
		$this->meta_table = $this->prefix.'postmeta';
	}

	public function check_existing_rows(){
   		$querystr = " SELECT * FROM $this->meta_table WHERE meta_key = '_yoast_wpseo_focuskw' ";
		$results = $this->dbase->get_results($querystr, OBJECT);
		return $results;
   	}


}

$config = new Config();