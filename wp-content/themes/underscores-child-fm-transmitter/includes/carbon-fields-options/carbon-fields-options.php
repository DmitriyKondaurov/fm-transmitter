<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', 'Site Settings' )
         ->add_tab( 'Logo', [
	         Field::make( 'image', 'site_logo', 'Logo-image' ),
	         Field::make( 'text', 'site_logo_text', 'Logo-text' ),
	         Field::make( 'text', 'text_brand', 'Logo-brand' ),
         ] )
		->add_tab( 'Viber phone', [
			Field::make( 'text', 'viber_phone', 'Viber-contact' ),
		] )
;
