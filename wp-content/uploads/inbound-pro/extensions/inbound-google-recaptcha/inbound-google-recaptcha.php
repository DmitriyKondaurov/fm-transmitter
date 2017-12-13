<?php
/*
Plugin Name: Inbound Extension - Google reCaptcha
Plugin URI: http://www.inboundnow.com/
Description: Extends Inbound Forms with an Google Captcha field type.
Version: 1.0.4
Author: Inbound Now
Contributors: Hudson Atwell
Author URI: http://www.inboundnow.com/
*
*/



if ( !class_exists( 'Inbound_Forms_Google_Captcha' )) {

    class Inbound_Forms_Google_Captcha {

        /**
         *	initiates class
         */
        public function __construct() {

            /* Define constants */
            self::define_constants();

            /* Define hooks and filters */
            self::load_hooks();

            /* load files */
            self::load_files();
        }

        /**
         *	Loads hooks and filters selectively
         */
        public static function load_hooks() {
            /* Setup Automatic Updating & Licensing For Stand Alone Users*/
            add_action('admin_init', array( __CLASS__ , 'license_setup') );
        }


        /**
         *	Defines constants
         */
        public static function define_constants() {
            define('INBOUND_GOOGLE_RECAPTCHA_CURRENT_VERSION', '1.0.5' );
            define('INBOUND_GOOGLE_RECAPTCHA_LABEL' , 'Inbound Forms - Google Captcha' );
            define('INBOUND_GOOGLE_RECAPTCHA_SLUG' , 'inbound-google-recaptcha' );
            define('INBOUND_GOOGLE_RECAPTCHA_FILE' ,	__FILE__ );
            define('INBOUND_GOOGLE_RECAPTCHA_REMOTE_ITEM_NAME' , 'inbound-google-recaptcha' );
			define('INBOUND_GOOGLE_RECAPTCHA_PATH', realpath(dirname(__FILE__)) . '/');
			$upload_dir = wp_upload_dir();
			$url = ( !strstr( INBOUND_GOOGLE_RECAPTCHA_PATH , 'plugins' )) ? $upload_dir['baseurl'] . '/inbound-pro/extensions/' .plugin_basename( basename(__DIR__) ) .'/' : WP_PLUGIN_URL.'/'.plugin_basename( dirname(__FILE__) ).'/' ;
			define('INBOUND_GOOGLE_RECAPTCHA_URLPATH', $url ); 
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
                $license = new Inbound_License( INBOUND_GOOGLE_RECAPTCHA_FILE , INBOUND_GOOGLE_RECAPTCHA_LABEL , INBOUND_GOOGLE_RECAPTCHA_SLUG , INBOUND_GOOGLE_RECAPTCHA_CURRENT_VERSION	, INBOUND_GOOGLE_RECAPTCHA_REMOTE_ITEM_NAME ) ;
            }
        }

        /**
         *  Loads PHP files
         */
        public static function load_files() {

            /* adds settings to global settings */
            include_once INBOUND_GOOGLE_RECAPTCHA_PATH . 'classes/class.settings.php';

            /* Enqueue assets for front end and backend field rendering */
            include_once INBOUND_GOOGLE_RECAPTCHA_PATH . 'classes/class.enqueue.php';

            /* extend inbound form fields */
            include_once INBOUND_GOOGLE_RECAPTCHA_PATH . 'classes/class.inbound-fields.php';

        }

    }

    /**
     *	Load INBOUND_GOOGLE_CAPTCHA class in init
     */
    function Load_INBOUND_GOOGLE_CAPTCHA() {
        $INBOUND_GOOGLE_CAPTCHA = new Inbound_Forms_Google_Captcha();
    }
    add_action( 'init' , 'Load_INBOUND_GOOGLE_CAPTCHA' );
}