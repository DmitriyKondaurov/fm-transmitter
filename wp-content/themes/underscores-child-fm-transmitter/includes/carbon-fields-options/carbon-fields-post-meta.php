<?php
//проверка на подключение к этому файлу напрямую
if (!defined('ABSPATH')) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Field\Complex_Field;

Container::make( 'post_meta', 'HERO' )
	->where( 'post_type', '=', 'page' )
	->where('post_id', '=', 2)
	->add_fields( array (
		Field::make( 'text', 'hero_banner', 'Hero Banner' )->set_width( 50 ),
		Field::make( 'image', 'hero_sticker', 'Hero sticker "brand new"')->set_width( 50 ),
		Field::make( 'media_gallery', 'hero_gallery', 'Brand gallery (slider)' ),
		Field::make( 'rich_text', 'hero_shot_spec', 'Shot specification' )->set_classes('hero_shot_spec'),
		Field::make( 'separator', 'crb_separator', 'Call to action form is widget, you can find it in sidebars menu')
	) );
Container::make( 'post_meta', 'ADVANTAGES' )
     ->where( 'post_type', '=', 'page' )
	 ->where('post_id', '=', 2)
     ->add_fields( array(
	     Field::make( 'image', 'my_brand_icon')->set_width( 50 ),
	     Field::make( 'image', 'other_brand_icon')->set_width( 50 ),
         Field::make( 'complex', 'crb_advantages', 'List of advantages (max 10)' )
             ->set_collapsed( true )
	         ->add_fields( 'advantage', array(
		         Field::make( 'text', 'advantage' )
		              ->set_width( 75 ),

		         Field::make( 'select', 'my_product' )->set_width( 10 )
		             ->set_options( array(
			             true => 'yes',
			             false  => 'no',
					) ),
		         Field::make( 'select', 'other_product' )->set_width( 10 )
		              ->set_options( array(
			              true => 'yes',
			              false  => 'no',
		              ) )

	             )
	         )
	         ->set_max(10)
             ->set_header_template( '<% if (advantage) { %>Advantage: <%- advantage %><% } %>' )
     ));

