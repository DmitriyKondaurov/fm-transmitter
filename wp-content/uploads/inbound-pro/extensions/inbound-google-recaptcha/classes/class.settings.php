<?php


if ( !class_exists( 'Inbound_Forms_Google_Captcha_Settings' )) {

	class Inbound_Forms_Google_Captcha_Settings {

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
		
			/*  Add settings to inbound pro  */
			add_filter('inbound_settings/extend', array( __CLASS__  , 'define_pro_settings' ) );
			
			/* add setting tab for attachments in Landing Page Plugin*/
			add_filter('lp_define_global_settings', array( __CLASS__ , 'add_global_settings') );
			
			/* add setting tab for attachments in Lead Plugin*/
			add_filter('wpleads_define_global_settings', array( __CLASS__ , 'add_global_settings') );
			
			/* add setting tab for attachments in CTA Plugin*/
			add_filter('wp_cta_define_global_settings', array( __CLASS__ , 'add_global_settings') );

		}
		
		/**
		*  Add to core settings
		*/
		public static function add_global_settings($global_settings) {
			/* ignore these hooks if inbound pro is active */
			if (defined('INBOUND_PRO_CURRENT_VERSION')) {
				return $global_settings;
			}
			
			switch (current_filter() ) 	{
				case "lp_define_global_settings":		
					$tab_slug = 'lp-extensions';
					break;
				case "wpleads_define_global_settings":		
					$tab_slug = 'wpleads-extensions';
					break;
				case "wp_cta_define_global_settings":		
					$tab_slug = 'wp-cta-extensions';
					break;
			}

			$global_settings[$tab_slug]['settings'][] = array(
				'id'  => 'inboundnow_forms_google_recaptcha_header',
				'type'  => 'header',
				'default'  => __('<h4>Google Captcha</h4>', 'inbound-pro' ),
				'options' => null
			);

			$global_settings[$tab_slug]['settings'][] = array(
					'id'  => 'inbound_forms_google_recaptcha_site_key',
					'option_name'  => 'inbound_forms_google_recaptcha_site_key',
					'label' => __('Google Captcha Site Key', 'inbound-pro'),
					'description' => __('See https://www.google.com/recaptcha/admin to setup and discover your site keys.', 'inbound-pro'),
					'type'  => 'text',
					'default'  => ''
			);

			
			return $global_settings;
		}
		
		
		/**
		*  Adds pro admin settings
		*/
		public static function define_pro_settings( $settings ) {
			$settings['inbound-pro-settings'][] = array(
				'group_name' => INBOUND_GOOGLE_RECAPTCHA_SLUG ,
				'keywords' => __('inbound,forms,inbound forms,captch,spam,spam protection' , 'inbound-pro'),
				'fields' => array (
					array(
						'id'  => 'header_google_recaptcha',
						'type'  => 'header',
						'default'  => __('Google Captcha Setup', 'inbound-pro' ),
						'options' => null
					),
					array(
						'id'  => 'site_key',
						'type'  => 'text',
						'label' => __('Google Site Key', 'inbound-pro'),
						'description' => __('See https://www.google.com/recaptcha/admin to setup and discover your site keys.', 'inbound-pro'),
						'default'  => '',
						'options' => null
					),
					array(
						'id'  => 'instructions',
						'type'  => 'ol',
						'label' => __( 'Instructions:' , 'inbound-pro' ),
						'options' => array(
							sprintf( __( 'Visit %s.' , 'inbound-pro' )  , '<a href="https://www.google.com/recaptcha/admin" target="_blank">https://www.google.com/recaptcha/admin</a>' ),
							__( 'Register a new site. Be sure to include this domain as a permitted site.' , 'inbound-pro' ),
							__( 'Find your Site Key and paste it in the settings area above.' , 'inbound-pro' )
						)
					)
				)

			);


			return $settings;

		}

		/**
		*  Get keys
		*/
		public static function get_settings() {
			$captcha_settings = array();
			
			if (!defined('INBOUND_PRO_CURRENT_VERSION')) {
				$captcha_settings['site_key'] = get_option('inbound_forms_google_recaptcha_site_key' , 'gif,jpeg,png,jpg,pdf,zip');
			} else {
				$settings = Inbound_Options_API::get_option( 'inbound-pro' , 'settings' , array() );
				$captcha_settings['site_key'] =  ( isset($settings[ INBOUND_GOOGLE_RECAPTCHA_SLUG ][ 'site_key' ]) && $settings[ INBOUND_GOOGLE_RECAPTCHA_SLUG ][ 'site_key' ] ) ? $settings[ INBOUND_GOOGLE_RECAPTCHA_SLUG ][ 'site_key' ] : '';
			}

			return $captcha_settings;
		}
		
	}

	new Inbound_Forms_Google_Captcha_Settings;
}