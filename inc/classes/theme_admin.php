<?php

class Theme_Admin{

	public function __construct(){
		add_action( 'admin_menu', array($this, 'admin_options') );
	}

	public function admin_options(){
		add_menu_page('SEO Meta CSV', 'SEO Meta CSV', 'manage_options', 'seo-meta-csv', array( $this, 'general_settings' ) );
	}

	public function general_settings(){
		if( is_plugin_active( 'wordpress-seo/wp-seo.php' ) )
			echo $this->activated_yoast();		
		else
			echo $this->deactivated_yoast();
	}

	public function activated_yoast(){
		$key_1_value = get_post_meta( 2, '_yoast_wpseo_focuskw', true );
		$output = '<div class="wrap">';
		$output .= '<h2><em>Options</em></h2>';
		$output .= '<form enctype="multipart/form-data" method="post" id="upload-csv">';
			$output .= '<input type="file" name="csv_file" />';
			$output .= '<input type="submit" name="csv_uploader" value="Upload CSV" />';
		$output .= '</form>';
		$output .= '<h1>'.$key_1_value.'</h1>';
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