<?php
/*
Plugin Name: Inbound Extension - Contact Form 7
Plugin URI: http://www.inboundnow.com/market/
Description: Provides Contact Form 7 Integration.
Version: 2.0.4
Author: Inbound Now
Contributors: Matt Bisset, Hudson Atwell
Author URI: http://www.inboundnow.com/

*/

if(!class_exists('Inbound_CF7')){
	

	class Inbound_CF7{
		
		/**
		*  Initialize class
		*/
		public function __construct(){
			self::define_constants();
			self::load_files();
			self::load_hooks();
		}
		
		/**
		*  Define constants
		*/
		public static function define_constants(){
			define('INBOUND_CF7_CURRENT_VERSION', '2.0.4' );
			define('INBOUND_CF7_LABEL' , 'Contact Form 7 Integration' );
			define('INBOUND_CF7_SLUG' , 'inbound-cf7');
			define('INBOUND_CF7_TEXT_DOMAIN' , 'inbound-pro' );
			define('INBOUND_CF7_FILE' , __FILE__ );
			define('INBOUND_CF7_REMOTE_ITEM_NAME' , 'contact-form-7-integration' );
			define('INBOUND_CF7_PATH', realpath(dirname(__FILE__)) . '/');
			$upload_dir = wp_upload_dir();
			$url = ( !strstr( INBOUND_CF7_PATH , 'plugins' ) ) ? $upload_dir['baseurl'] . '/inbound-pro/extensions/' .plugin_basename( basename(__DIR__) ) .'/' : WP_PLUGIN_URL.'/'.plugin_basename( dirname(__FILE__) ).'/' ;
			define('INBOUND_CF7_URLPATH', $url ); 
		}
		
		/**
		*  Load File
		*/ 
		public static function load_files(){
			include_once('cf7-integration/cf7-integration.php');
		
		}
		
		/**
		*  Load hook
		*/
		public static function load_hooks(){
			/* Setup Automatic Updating & Licensing */
			add_action('admin_init', array( __CLASS__ , 'license_setup') );

			/*  Add settings to inbound pro  */
			add_filter('inbound_settings/extend', array(__CLASS__, 'add_pro_settings'));
		}

		/**
		 *  Add inbound pro settings references
		 */
		public static function add_pro_settings($settings) {

			$settings['inbound-pro-settings'][] = array(
				'group_name' => INBOUND_CF7_SLUG,
				'keywords' => __('cf7,contact form 7,forms,form', 'inbound-pro'),
				'fields' => array(
					array(
						'id' => 'header_cf7',
						'type' => 'header',
						'default' => __('Contact Form 7', 'inbound-pro'),
						'options' => null
					),
					array(
						'id' => 'edd_auto_generate_lists',
						'type' => 'html',
						'label' => '',
						'default' => __( 'This component requires no setup at this location. Please see available features inside the CF7 form setup screen.' , 'inbound-pro'),
					)
				)

			);

			return $settings;

		}

		/*
		* Setups Software Update API
		*/
		public static function license_setup() {

			/* ignore these hooks if inbound pro is active */
			if ( defined('INBOUND_ACCESS_LEVEL') && INBOUND_ACCESS_LEVEL > 0 && INBOUND_ACCESS_LEVEL != 9 ) {
				return;
			}

			/*PREPARE THIS EXTENSION FOR LICESNING*/
			if ( class_exists( 'Inbound_License' ) ) {
				$license = new Inbound_License( INBOUND_CF7_FILE , INBOUND_CF7_LABEL , INBOUND_CF7_SLUG , INBOUND_CF7_CURRENT_VERSION  , INBOUND_CF7_REMOTE_ITEM_NAME ) ;
			}
		}		

		
	}
	
	add_action('plugins_loaded' , 'load_inbound_contact_form_7' , 1);
		function load_inbound_contact_form_7() {
		new Inbound_CF7;
		
	}
	
}

