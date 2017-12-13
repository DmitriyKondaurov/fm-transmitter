<?php
/*
Plugin Name: Leads - Import Leads (CSV)
Plugin URI: http://www.inboundnow.com/
Description: Imports lead profiles from CSV file.
Version: 2.1.3
Author: Inbound Now
Author URI: http://www.inboundnow.com/

*/


if (!class_exists('Inbound_CSV_Importer')) {


	class Inbound_CSV_Importer {


		/**
		* Initialize Inbound_CSV_Importer Class
		*/
		public function __construct() {

			self::define_constants();
			self::load_files();
			self::load_hooks();
		}

		/**
		* Define Constants
		*
		*/
		private static function define_constants() {
			define('INBOUND_CSV_IMPORTING_CURRENT_VERSION', '2.1.3' );
			define('INBOUND_CSV_IMPORTING_LABEL' , 'Leads - CSV Importing' );
			define('INBOUND_CSV_IMPORTING_SLUG' , 'leads-csv-importing');
			define('INBOUND_CSV_IMPORTING_FILE' ,  __FILE__ );
			define('INBOUND_CSV_IMPORTING_REMOTE_ITEM_NAME' , 'import-leads-csv' );
			define('INBOUND_CSV_IMPORTING_PATH', realpath(dirname(__FILE__)) . '/');
			$upload_dir = wp_upload_dir();
			$url = ( !strstr( INBOUND_CSV_IMPORTING_PATH , 'plugins' )) ? $upload_dir['baseurl'] . '/inbound-pro/extensions/' .plugin_basename( basename(__DIR__) ) .'/' : WP_PLUGIN_URL.'/'.plugin_basename( dirname(__FILE__) ).'/' ;
			define('INBOUND_CSV_IMPORTING_URLPATH', $url ); 
			define('INBOUND_CSV_IMPORTING_UPLOADS_PATH', $upload_dir['basedir'].'/leads/json/' );
			define('INBOUND_CSV_IMPORTING_UPLOADS_URLPATH', $upload_dir['baseurl'].'/leads/json/' );
			
		}

		/**
		*  Loads php files
		*/
		public static function load_files() {

			if (is_admin()) {

				/* Load Admin Menu */
				include_once 'classes/class.administration.php';

			}

		}


		/**
		* Load Hooks & Filters
		*/
		public static function load_hooks() {

			/* Setup Automatic Updating & Licensing */
			add_action('admin_init', array( __CLASS__ , 'license_setup') );

            /* add compatibility fixes */
            add_action( 'admin_init' , array( __CLASS__ , 'compatibility_fixes' ) );

			/*  Add settings to inbound pro  */
			add_filter('inbound_settings/extend', array( __CLASS__  , 'define_pro_settings' ) );

			/* filter to modify setting url */
			add_filter( 'inbound-pro/download-setting-url' , array( __CLASS__ , 'modify_settings_url') , 10 ,  2 );
		}

        /**
         * Compatibility fixes
         *
         */
        public static function compatibility_fixes() {
            /* them compatibility fixes */
            if (isset($_GET['page']) && $_GET['page'] == 'leads-import' ) {
                remove_action( 'admin_enqueue_scripts', 'fasterthemes_framework_load_scripts' );
            }
        }

        /**
		* Setups Software Update API
		*/
		public static function license_setup() {
			/* ignore these hooks if inbound pro is active */
			if (defined('INBOUND_PRO_CURRENT_VERSION')) {
				return;
			}

			/*PREPARE THIS EXTENSION FOR LICESNING*/
			if ( class_exists( 'Inbound_License' ) ) {
				$license = new Inbound_License( INBOUND_CSV_IMPORTING_FILE , INBOUND_CSV_IMPORTING_LABEL , INBOUND_CSV_IMPORTING_SLUG , INBOUND_CSV_IMPORTING_CURRENT_VERSION  , INBOUND_CSV_IMPORTING_REMOTE_ITEM_NAME ) ;
			}
		}

		/**
		*  Modifies settings URL in Inbound Pro Extension management
		*  @param STRING $url
		*  @param ARRAY $download
		*/
		public static function modify_settings_url( $url , $download = null ) {
			if ( !isset($download['zip_filename']) || $download['zip_filename'] != 'inbound-csv-importing' ) {
				return $url;
			}

			return add_query_arg( array( 'post_type' => 'wp-lead' , 'page'=>'leads-import' ) , admin_url( 'edit.php' ) );
		}

		/**
		*  Adds pro admin settings
		*/
		public static function define_pro_settings( $settings ) {
			$settings_url = add_query_arg( array( 'post_type' => 'wp-lead' , 'page'=>'leads-import' ) , admin_url( 'edit.php' ) );
			$html = '<a href="'.$settings_url.'" class="ink-button green">'.__('Import Leads' , 'inbound-pro' ) .'</a>';

			$settings['inbound-pro-settings'][] = array(
				'group_name' => INBOUND_CSV_IMPORTING_SLUG ,
				'keywords' => __('csv,import,importing,social' , 'inbound-pro'),
				'fields' => array (
					array(
						'id'  => 'header_csv_importing',
						'type'  => 'header',
						'default'  => __('CSV Importing', 'inbound-pro' ),
						'options' => null
					),
					array(
						'id'  => 'header_csv_importing',
						'type'  => 'html',
						'default'  => $html,
						'description'  =>  $html
					)
				)

			);


			return $settings;

		}

		/**
		 * Helper log function for debugging
		 *
		 * @since 1.2.2
		 */
		static function log( $message ) {
			if ( WP_DEBUG === true ) {
				if ( is_array( $message ) || is_object( $message ) ) {
					error_log( print_r( $message, true ) );
				} else {
					error_log( $message );
				}
			}
		}

	}


	new Inbound_CSV_Importer();

}