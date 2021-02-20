<?php

if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', 'Site Settings' )
         ->add_tab( 'main settings',[
	         Field::make( 'image', 'site_logo', 'Logo' ),
         ] );
