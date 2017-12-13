<?php


class Inbound_Analytics_UI_Containers {

	static $templates;
	static $ga_settings;
	static $ga_data;

	/**
	* Initalize Inbound_Analytics_UI_Containers Class
	*/
	public function __construct() {
		self::load_static_vars();
		self::load_hooks();
	}


	/**
	* Load Hooks & Filters
	*/
	public static function load_hooks() {

		/* Load Google Charting API & Inbound Analytics Styling CSS*/
		add_action( 'admin_enqueue_scripts' , array( __CLASS__ , 'load_scripts') );

	}


	public static function load_static_vars() {
		global $post;

		if (!isset($post)) {
			return;
		}

		self::$ga_settings = get_option('inbound_ga' , false);

	}

	/**
	* Loads Google charting scripts
	*/
	public static function load_scripts() {
		
		global $post;
		
		
		if (!isset($post) || strstr( $post->post_type , 'inbound-' ) ) {
			return;
		}
		
		wp_register_script( 'jsapi' , 'https://www.google.com/jsapi');
		wp_enqueue_script( 'jsapi' );

		wp_register_script( 'spin-js' , INBOUND_GA_URLPATH.'assets/libraries/spinjs/spin.js');
		wp_enqueue_script( 'spin-js' );

		wp_register_script( 'spin-jquery' , INBOUND_GA_URLPATH.'assets/libraries/spinjs/jquery.spin.js');
		wp_enqueue_script( 'spin-jquery' );


	}

}


new Inbound_Analytics_UI_Containers();