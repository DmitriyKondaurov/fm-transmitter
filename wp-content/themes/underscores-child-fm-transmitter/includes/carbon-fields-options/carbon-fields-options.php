<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', 'Custom Settings' )
	->add_tab( 'General options', [
		Field::make( 'text', 'brand_name', 'Brand_name' ),
		Field::make( 'color', 'brand_color', __( 'Background Color' ) ),
		Field::make( 'checkbox', 'show_content', __( 'Show Content' ) ),
		Field::make( 'checkbox', 'crb_show_content', 'Show content' ),
		Field::make( 'rich_text', 'crb_content', 'Content' )
		     ->set_conditional_logic( array(
			     array(
				     'field' => 'crb_show_content',
				     'value' => true,
			     )
		     ) ),
			] )

	->add_tab( 'Site header', [
		Field::make( 'image', 'site_logo', 'Logo-image (output size = 28☓28)' ),
		Field::make( 'text', 'site_logo_text', 'Logo-text' ),
		Field::make( 'text', 'viber_phone', 'Viber-contact' )
		     ->set_attribute( 'placeholder', '+☓☓ (☓☓☓) ☓☓☓-☓☓-☓☓' )
		     ->set_attribute( 'type', 'phone' ),
	] )
	->add_tab( 'Site Hero', [
		Field::make( 'text', 'brand_full_name', 'Brand_full_name' )
	] )
;
