<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', 'CUSTOM SITE FIELDS' )
	->where('post_id', '=', 2)
	->add_fields( array (
		Field::make( 'text', 'hero_banner', 'Hero Banner' )->set_width( 50 ),
		Field::make( 'image', 'hero_sticker', 'Hero sticker "brand new"')->set_width( 50 ),
		Field::make( 'media_gallery', 'hero_gallery', 'Brand gallery' ),
		Field::make( 'rich_text', 'hero_shot_spec', 'Shot specification' )->set_classes('hero_shot_spec'),

	) )

;
