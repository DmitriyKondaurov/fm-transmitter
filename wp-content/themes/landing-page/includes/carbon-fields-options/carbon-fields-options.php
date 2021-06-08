<?php
//проверка на подключение к этому файлу напрямую
if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', 'Custom settings' )
	->add_tab( 'General options', [
		Field::make( 'text', 'brand_name', 'Brand_name' ),
		Field::make( 'color', 'brand_color', __( 'Background Color' ) ),
		Field::make( 'color', 'main-text-color', __( 'Text Color' ) ),
		Field::make( 'color', 'sec-text-color', __( 'Text Color' ) ),
	] )

	->add_tab( 'Logo', [
		Field::make( 'image', 'site_logo', 'Logo-image (output size = 28☓28)' ),
		Field::make( 'text', 'site_logo_text', 'Logo-text' ),
	] )

	->add_tab( 'Contacts', [
		Field::make( 'text', 'address', 'Address contact' ),
		Field::make( 'text', 'viber_phone', 'Viber-contact' )
		     ->set_attribute( 'placeholder', '+☓☓ (☓☓☓) ☓☓☓-☓☓-☓☓' )
		     ->set_attribute( 'type', 'phone' ),
		Field::make( 'text', 'fb_url', 'Facebook link' )
		     ->set_attribute( 'type', 'url' ),
		Field::make( 'text', 'inst_url', 'Instagram link' )
		     ->set_attribute( 'type', 'url' ),
		Field::make( 'text', 'vk_url', 'Vkontakte link' )
		     ->set_attribute( 'type', 'url' ),
		Field::make( 'text', 'youtube_url', 'YouTube link' )
		     ->set_attribute( 'type', 'url' ),
	] )
	->add_tab( 'Scripts', [
		Field::make( 'header_scripts', 'crb_header_script', __( 'Header Script' ) ),
		Field::make( 'footer_scripts', 'crb_footer_script', __( 'Footer Script' ) ),
	] )
	->add_tab( 'Meta', [
		Field::make( 'text', 'cache_control')
		     ->set_attribute( 'type', 'number' ),
		Field::make( 'text', 'description')
		     ->set_attribute( 'type', 'text' ),
		Field::make( 'text', 'keywords')
		     ->set_attribute( 'type', 'text' ),
		Field::make( 'text', 'domain')
		     ->set_attribute( 'type', 'url' ),
	] )
	->add_tab( 'Gravity Form', [
		Field::make( 'gravity_form', 'crb_gravity_form', __( 'Select a Gravity Form' ) )
	] )
;
