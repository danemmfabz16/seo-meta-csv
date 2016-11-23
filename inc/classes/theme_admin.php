<?php

class Theme_Admin{

	public $config;

	public function __construct(){
		add_action( 'admin_menu', array($this, 'admin_options') );
		add_action( 'admin_enqueue_scripts', array($this, 'add_script') );
		add_action( 'wp_ajax_file_validate', array($this, 'file_validate') );
		add_action( 'wp_ajax_nopriv_file_validate', array($this, 'file_validate') );

		//$this->config = new Config();

		
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

	/*
	* Ajax callback function for file validation
	*/
	function file_validate() {

		if(!empty($_FILES["filebutton"]["name"])) {    
			$allowed_ext = array("csv");  
	    	$extension = end(explode(".", $_FILES["filebutton"]["name"]));  

		    if(in_array($extension, $allowed_ext)) { 
		    	global $wpdb; 

			   	/*$wpdb->insert( 
					'smc_postmeta', 
					array( 
						'post_id' => 10, 
						'meta_key' => '_yoast_wpseo_focuskw_text_input',
						'meta_value' => 'test-only' 
					), 
					array( 
						'%d', 
						'%s',
						'%s' 
					) 
				);*/

					$file_data = fopen($_FILES["filebutton"]["tmp_name"], 'r');  
		           	fgetcsv($file_data);  

		           	$flag = true;
		           	while( $row = fgetcsv($file_data)  ) {  

		                $post_id = $row[0];  
		                $meta_key = $row[1];  
		                $meta_value = $row[2]; 
		                

		                $wpdb->insert( 'smc_postmeta', array( 
											'post_id' => $post_id, 
											'meta_key' => $meta_key,
											'meta_value' => $meta_value 
									), 
										array( 
											'%d', 
											'%s',
											'%s' 
									) 
						);		                

		           	}


					//fclose($file);

	        	die();
	      	}  
	      	else {  
	           echo 'Error1';  
	      	}  
 		}  
		else {  
		    echo "Error2";  
		}  

		die();
	}

	/***********************************/
	// Includes js
	/***********************************/
	function add_script($hook) {
	    wp_enqueue_script( 'smc-main-script', plugins_url() . '/seo-meta-csv/inc/script/main.js' );
	    wp_localize_script( 'smc-main-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}


}


$theme_admin = new Theme_Admin();