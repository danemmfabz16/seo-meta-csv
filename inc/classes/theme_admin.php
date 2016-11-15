<?php

class Theme_Admin{

	public function __construct(){
		add_action( 'admin_menu', array($this, 'admin_options') );
	}

	public function admin_options(){
		add_menu_page('SEO Meta CSV', 'SEO Meta CSV', 'manage_options', 'seo-meta-csv', array( $this, 'general_settings' ) );
	}

	public function general_settings(){
		if( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ){
			?>

				<div class="wrap">
					<h2>Options</h2>
				</div><!-- .wrap -->

			<?php
		}
		else{
			echo $this->deactivated_yoast();
		}

	}
	
	public function deactivated_yoast(){
		$output = '<div class="wrap">';
		$output .= '<h2>Plugin Yoast deactivated.</h2>';
		$output .= '</div>';
		return $output;
	}

}


$theme_admin = new Theme_Admin();