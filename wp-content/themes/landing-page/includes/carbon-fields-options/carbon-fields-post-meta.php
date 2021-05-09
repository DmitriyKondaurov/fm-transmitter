<?php
//проверка на подключение к этому файлу напрямую
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Field\Complex_Field;

Container::make( 'post_meta', 'HERO' )
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_id', '=', 2 )
         ->add_fields( array(
	         Field::make( 'text', 'hero_banner', 'Hero Banner' )->set_width( 50 ),
	         Field::make( 'image', 'hero_sticker', 'Hero sticker "brand new"' )->set_width( 50 ),
	         Field::make( 'media_gallery', 'hero_gallery', 'Brand gallery (slider)' ),
	         Field::make( 'rich_text', 'hero_shot_spec', 'Shot specification' )->set_classes( 'hero_shot_spec' ),
	         Field::make( 'image', 'hero_bg', 'Hero background' ),
	         Field::make( 'separator', 'crb_separator', 'Call to action form is widget, you can find it in sidebars menu' ),
         ) );
Container::make( 'post_meta', 'ADVANTAGES' )
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_id', '=', 2 )
         ->add_fields( array(
	         Field::make( 'text', 'sec_advantages', 'Section caption' ),
	         Field::make( 'image', 'my_brand_icon' )->set_width( 50 ),
	         Field::make( 'image', 'other_brand_icon' )->set_width( 50 ),
	         Field::make( 'complex', 'crb_advantages', 'List of advantages (max 10)' )
	              ->set_collapsed( true )
	              ->add_fields( 'advantages', array(
			              Field::make( 'text', 'advantage' )
			                   ->set_width( 75 ),

			              Field::make( 'select', 'my_product' )->set_width( 10 )
			                   ->set_options( array(
				                   true  => 'yes',
				                   false => 'no',
			                   ) ),
			              Field::make( 'select', 'other_product' )->set_width( 10 )
			                   ->set_options( array(
				                   true  => 'yes',
				                   false => 'no',
			                   ) ),
		              )
	              )
	              ->set_max( 10 )
	              ->set_header_template( '<% if (advantage) { %>Advantage: <%- advantage %><% } %>' )
         ) );
Container::make( 'post_meta', 'FUNCTIONS' )
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_id', '=', 2 )
         ->add_fields( array(
	         Field::make( 'text', 'sec_functions', 'Section caption' ),
	         Field::make( 'image', 'sec_functions_bg', 'Section functions background' ),
	         Field::make( 'complex', 'crb_functions', 'List of support functions (max 10)' )
	              ->set_collapsed( false )
	              ->add_fields( 'crb_function', array(
			              Field::make( 'select', 'choose_icon', '' )->set_width( 10 )
			                   ->set_options( array(
				                   false => 'no icon',
				                   'icon-moonphone_bluetooth_speaker' => 'phone_bluetooth_speaker',
				                   'icon-moonaux10' => 'aux10',
				                   'icon-mooncard1' => 'card1',
				                   'icon-moonradio' => 'radio',
				                   'icon-moonaux5' => 'aux5',
				                   'icon-moonbluetooth_connected' => 'bluetooth_connected',
				                   'icon-moonvoice1' => 'voice1',
				                   'icon-mooncharg66' => 'charg66',
				                   'icon-mooncamera' => 'camera',
				                   'icon-moonheadphones' => 'headphones',
				                   'icon-moonmusic' => 'music',
				                   'icon-moonmic' => 'mic',
				                   'icon-mooncart' => 'cart',
				                   'icon-mooncredit-card' => 'credit-card',
				                   'icon-moonlocation' => 'location',
				                   'icon-moonwrench' => 'wrench',
				                   'icon-mooncog' => 'cog',
				                   'icon-mooncogs' => 'cogs',
				                   'icon-moonfire' => 'fire',
				                   'icon-moonpower' => 'power',
				                   'icon-mooncheckmark2' => 'checkmark2',
				                   'icon-moonfacebook' => 'facebook',
				                   'icon-mooninstagram' => 'instagram',
				                   'icon-moontwitter' => 'twitter',
				                   'icon-moonyoutube' => 'youtube',
				                   'icon-moondropbox' => 'dropbox',
				                   'icon-mooncloud' => 'cloud',
				                   'icon-moongithub' => 'github',
				                   'icon-moonwordpress' => 'wordpress',
				                   'icon-moonapple' => 'apple',
				                   'icon-moonandroid' => 'android',
				                   'icon-moonwindows' => 'windows',
				                   'icon-moonlinkedin' => 'linkedin',
				                   'icon-moonpinterest' => 'pinterest',
				                   'icon-moonchrome' => 'chrome',
				                   'icon-moongit' => 'git',
			                   ) ),
			              Field::make( 'textarea', 'function_description', '' )->set_width( 85 )->set_rows(3),
		              )
	              )
	              ->set_max( 10 )
         ) );

Container::make( 'post_meta', 'SPECIFICATION' )
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_id', '=', 2 )
         ->add_fields( array(
	         Field::make( 'text', 'sec_specification', 'Section caption' ),
	         Field::make( 'image', 'spec_image' ),
         ) );

Container::make( 'post_meta', 'VIDEO OVERVIEW' )
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_id', '=', 2 )
         ->add_fields( array(
	         Field::make( 'text', 'sec_screencast', 'Section caption' ),
	         Field::make( 'text', 'link_overview', 'Add youtube link of overview your product here...' ),
//
         ) );
Container::make( 'post_meta', 'SHIPMENT INFO' )
         ->where( 'post_type', '=', 'page' )
         ->where( 'post_id', '=', 2 )
         ->add_fields( array(
	         Field::make( 'text', 'sec_shipment', 'Section caption' ),
	         Field::make( 'rich_text', 'shipment_info', ''),
         ) );