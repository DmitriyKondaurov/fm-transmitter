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

		Field::make( 'checkbox', 'crb_show_content', 'Show content' ),
		Field::make( 'rich_text', 'crb_content', 'Content' )
		     ->set_conditional_logic( array(
			     array(
				     'field' => 'crb_show_content',
				     'value' => true,
			     )
		     ) ),
			] )

	->add_tab( 'Logo', [
		Field::make( 'image', 'site_logo', 'Logo-image (output size = 28☓28)' ),
		Field::make( 'text', 'site_logo_text', 'Logo-text' ),

	] )
	->add_tab( 'Site Hero', [
		Field::make( 'image', 'hero_sticker', 'Hero sticker "brand new"' ),
		Field::make( 'text', 'hero_banner', 'Hero Banner' )
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
;
