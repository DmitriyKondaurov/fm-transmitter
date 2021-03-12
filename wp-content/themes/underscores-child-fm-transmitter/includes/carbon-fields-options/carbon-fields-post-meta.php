<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', 'custom fields' )
	->add_tab( 'Site Hero', [
		Field::make( 'text', 'hero_banner', 'Hero Banner' ),
		Field::make( 'image', 'hero_sticker', 'Hero sticker "brand new"'),

	] )

;
