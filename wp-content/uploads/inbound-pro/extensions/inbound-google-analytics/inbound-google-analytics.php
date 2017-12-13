<?php
/*
Plugin Name: Inbound Extension - Google Analytics
Plugin URI: http://www.inboundnow.com/
Description: Incredible integrations with Google Analyitics
Version: 2.0.4
Author: Inbound Now
Author URI: http://www.inboundnow.com/
*
*/

if ( !class_exists( 'Inbound_Google_Analytics' )) {

	class Inbound_Google_Analytics {

		/**
		*	initiates class
		*/
		public function __construct() {

			global $wpdb;

			/* Define constants */
			self::define_constants();

			/* load files */
			self::load_files();
		}


		/**
		*	Defines constants
		*/
		public static function define_constants() {
			define('INBOUND_GA_CURRENT_VERSION', '2.0.4' );
			define('INBOUND_GA_LABEL' , 'Google Analytics Integration' );
			define('INBOUND_GA_SLUG' , 'inbound-google-analytics');
			define('INBOUND_GA_FILE' ,	__FILE__ );
			define('INBOUND_GA_REMOTE_ITEM_NAME' , 'google-analytics-integration' );
			define('INBOUND_GA_PATH', realpath(dirname(__FILE__)) . '/');
			$upload_dir = wp_upload_dir();
			$url = ( !strstr( INBOUND_GA_PATH , 'plugins' )) ? $upload_dir['baseurl'] . '/inbound-pro/extensions/' .plugin_basename( basename(__DIR__) ) .'/' : WP_PLUGIN_URL.'/'.plugin_basename( dirname(__FILE__) ).'/' ;
			define('INBOUND_GA_URLPATH', $url );
		}

		/**
		*  Loads PHP files
		*/
		public static function load_files() {

			if ( is_admin() ) {
				/* settings page files */
				include_once INBOUND_GA_PATH . 'classes/class.admin.php';
				include_once INBOUND_GA_PATH . 'classes/class.admin.php';
				include_once INBOUND_GA_PATH . 'classes/class.adminbar.php';
				include_once INBOUND_GA_PATH . 'assets/libraries/oauth/apisettings.class.php';
				include_once INBOUND_GA_PATH . 'assets/libraries/oauth/gadata.class.php';
				include_once INBOUND_GA_PATH . 'assets/libraries/oauth/googleoauth2.class.php';

				/* load reporting files */
				include_once INBOUND_GA_PATH . 'classes/class.google-connector.php';	/* Load Inbound Analytics Connector Class */
				include_once INBOUND_GA_PATH . 'classes/class.enqueues.php'; /* Load administration files */

				/* Load template files */
				include_once INBOUND_GA_PATH . 'classes/class.quick-view.php';

			} else {
				
				/* Load Tracking Script */
				include_once INBOUND_GA_PATH . 'classes/class.frontend-tracking.php';
			}
			
		}

	}

	/**
	*	Load Inbound_Google_Analytics class in init
	*/
	function Load_Inbound_Google_Analytics() {
		new Inbound_Google_Analytics();
	}
	add_action( 'init' , 'Load_Inbound_Google_Analytics' , 1 );
}