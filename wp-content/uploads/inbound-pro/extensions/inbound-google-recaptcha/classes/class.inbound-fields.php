<?php


if ( !class_exists( 'Inbound_Forms_Google_Captcha_Fields' )) {

	class Inbound_Forms_Google_Captcha_Fields {

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
			add_filter( 'inboundnow_forms_settings' , array( __CLASS__ , 'extend_field_type_dropdown' ) );
			
			/* Add handler to process field type */
			add_filter( 'inbound_form_custom_field' , array( __CLASS__ , 'inbound_form_custom_field' ), 10, 3 );
		}
		
		/**
		*  Extends field type dataset for Inbound Forms
		*/
		public static function extend_field_type_dropdown( $config ) {
			$config['forms']['child']['options']['field_type']['options']['google_recaptcha'] = __("Google reCaptcha", "inbound-pro");
			return $config;
		}
		
		
		/**
		*  Listens for google captcha and renders it
		*/
		public static function inbound_form_custom_field( $form, $field, $form_id) {
			global $google_recaptcha_loaded;
			
			/* only render field if 'attachments' type is selected. */ 
			if ( !$field || $field['type'] != 'google_recaptcha'){
				return $form;
			}

			/* Mark loaded */
			$google_recaptcha_loaded = true;
			
			/* get attachment settings */
			$settings = Inbound_Forms_Google_Captcha_Settings::get_settings();

			if ($settings['site_key']) {
				$form .= '<div class="inbound-google-recaptcha-container">
					<div class="g-recaptcha" id="rcaptacha" data-sitekey="' . $settings['site_key'] . '"></div>
					<span id="inbound-recaptcha-message" /></span>
					</div>';
			} else {
				$form .= '<div class="inbound-google-recaptcha-container">
							<span id="inbound-recaptcha-message" />'.__('reCaptcha site key required' , 'inbound-pro') .'</span>
						</div>';
			}
			
			
			return $form;
		}
	}
	

	new Inbound_Forms_Google_Captcha_Fields;
}