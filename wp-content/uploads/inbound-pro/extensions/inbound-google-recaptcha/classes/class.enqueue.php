<?php


if ( !class_exists( 'Inbound_Forms_Google_Captcha_Enqueue' )) {

	class Inbound_Forms_Google_Captcha_Enqueue {

		/**
		*	initiates class
		*/
		public function __construct() {		
			
			/* Define hooks and filters */
			self::load_hooks();
			
		}
		
		/**
		*	Loads hooks and filters selectively
		*/
		public static function load_hooks() {
			
			/* Add new field type to dropdown */
			add_filter( 'wp_footer' , array( __CLASS__ , 'enqueue_files' ), 1 );
			
			/* Add handler to process field type */
			add_action( 'admin_enqueue_scripts' , array( __CLASS__ , 'enqueue_files') );
		}
		
		/**
		*  Enqueue JS & CSS files for front end and backend
		*/
		public static function enqueue_files(  ) {
			global $google_recaptcha_loaded;

			if (!isset($google_recaptcha_loaded)) {
				return;
			}

			/* enqueue frontend css */
			wp_enqueue_style( 'google-recaptcha-css', INBOUND_GOOGLE_RECAPTCHA_URLPATH . 'assets/css/frontend.css' );

			/* enqueue google api */
			wp_enqueue_script( 'google-recaptcha', 'https://www.google.com/recaptcha/api.js' );

			/* enqueue alanlytics events hooks js for processing */
			wp_enqueue_script( 'google-recaptcha-inbound-hooks', INBOUND_GOOGLE_RECAPTCHA_URLPATH . 'assets/js/hooks.js' );
			wp_localize_script( 'google-recaptcha-inbound-hooks',
				'recaptcha',
				array(
					'error' => __('* reCaptcha verification required' , 'inbound-pro' )
				)
			);



		}
		
		
	}
	

	new Inbound_Forms_Google_Captcha_Enqueue;
}