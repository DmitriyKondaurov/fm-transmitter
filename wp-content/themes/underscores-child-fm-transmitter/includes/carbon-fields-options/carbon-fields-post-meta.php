<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', 'custom page fields' )
	->where('post_id', '=', 2)
	->add_tab( 'Site Hero', [
		Field::make( 'text', 'hero_banner', 'Hero Banner' )->set_width( 50 ),
		Field::make( 'image', 'hero_sticker', 'Hero sticker "brand new"'),
		Field::make( 'media_gallery', 'hero_gallery', 'Brand gallery' ),

	] )

;
