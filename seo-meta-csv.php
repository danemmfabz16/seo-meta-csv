<?php 

/**
 * Plugin Name: SEO Meta CSV
 * Version: 1.0
 * Plugin URI: https://github.com/danemmfabz16/seo-meta-csv.git
 * Description: CSV uploader that integrates to Yoast SEO plugin.
 * Author: FabzWebz
 * Author URI: #
 * Text Domain: seo-meta-csv
 * License: GPL v3
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}

if ( ! function_exists( 'wp_handle_upload' ) ) {
		    require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}

define( 'SMC_PLUGIN_DIR', dirname( __FILE__ ) );

require_once( SMC_PLUGIN_DIR . '/inc/classes/config.php' );
require_once( SMC_PLUGIN_DIR . '/inc/classes/theme_admin.php' );