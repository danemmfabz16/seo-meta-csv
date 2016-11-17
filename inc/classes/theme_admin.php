<?php

class Theme_Admin{

	public $config;

	public function __construct(){
		add_action( 'admin_menu', array($this, 'admin_options') );
		add_action( 'admin_enqueue_scripts', array($this, 'add_script_main') );
		add_action( 'wp_ajax_my_action', array($this, 'my_action_callback') );
		add_action( 'wp_ajax_nopriv_my_action', array($this, 'my_action_callback') );

		

		$this->config = new Config();
	}

	public function admin_options(){
		add_menu_page('SEO Meta CSV', 'SEO Meta CSV', 'manage_options', 'seo-meta-csv', array( $this, 'general_settings' ) );
	}

	public function general_settings(){
		if( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ){
			echo $this->activated_yoast();	
		}	
		else{
			echo $this->deactivated_yoast();
		}

	}

	public function activated_yoast(){
		$output = '<div class="wrap">';
		$output .= '<h2><em>Options</em></h2>';
		$output .= '<form  enctype="multipart/form-data" method="post" id="upload-csv">';
			$output .= '<input type="file" name="filebutton"/>';
			$output .= '<input type="submit" name="csv_uploader" value="Upload CSV" />';
		$output .= '</form>';
		$output .= '</div>';
		return $output;
	}
	
	public function deactivated_yoast(){
		$output = '<div class="wrap">';
		$output .= '<h2><em>Plugin Yoast deactivated.</em></h2>';
		$output .= '</div>';
		return $output;
	}

	function my_action_callback() {
		$uploadedfile = $_FILES['filebutton'];
		$movefile = wp_handle_upload( $uploadedfile );
		if(!empty($movefile["file"])) {  

		      //$connect = mysqli_connect("localhost", "root", "", "testing");  
		      $output = '';  
		      $allowed_ext = array("csv");  
		      $extension = end(explode(".", $movefile["file"]));  
		      if(in_array($extension, $allowed_ext)) {  
		           echo 'Valid!';
		      }  
		      else {  
		           echo 'Error1';
		      }  
		}  
		else {  
		      echo $movefile["file"];
		}  

		die();
	}

	/*
	* Add main.js
	*/
	function add_script_main($hook) {
	    wp_enqueue_script( 'smc-main-script', plugins_url() . '/seo-meta-csv/inc/script/main.js' );
	    wp_localize_script( 'smc-main-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}


}


$theme_admin = new Theme_Admin();