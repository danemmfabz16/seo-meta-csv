<?php

class Theme_Admin{

	public $config;

	public function __construct(){
		add_action( 'admin_menu', array($this, 'admin_options') );

		$this->config = new Config();
	}

	public function admin_options(){
		add_menu_page('SEO Meta CSV', 'SEO Meta CSV', 'manage_options', 'seo-meta-csv', array( $this, 'general_settings' ) );
	}

	public function general_settings(){
		if( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ){
			echo $this->activated_yoast();	

			echo '<pre>';
			print_r($this->config->check_existing_rows());
		}	
		else{
			echo $this->deactivated_yoast();
		}

	}

	public function activated_yoast(){
		$output = '<div class="wrap">';
		$output .= '<h2><em>Options</em></h2>';
		$output .= '<form enctype="multipart/form-data" method="post" id="upload-csv">';
			$output .= '<input type="file" name="csv_file" />';
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

}


$theme_admin = new Theme_Admin();