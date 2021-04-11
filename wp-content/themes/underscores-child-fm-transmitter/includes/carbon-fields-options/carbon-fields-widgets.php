<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Carbon_Fields\Widget;
use Carbon_Fields\Field;

class CallToActionWidget extends Widget {
	// Register widget function. Must have the same name as the class
	function __construct() {
		$this->setup( 'custom_widget_call_to_action', 'Call to action',
			'Block with call to action button',
			array(
				Field::make( 'text', 'title', 'Title' )->set_classes( 'attention-2' ),
				Field::make( 'textarea', 'content', 'Content' ),
				Field::make( 'text', 'discount_amount', 'Discount amount' )->set_width( 15 ),
				Field::make( 'select', 'price_currency', 'Price currency' )->set_width( 15 )->add_options( array(
					'eur' => __( 'EUR' ),
					'usd' => __( 'USD' ),
					'pln' => __( 'PLN' ),
					'грн' => __( 'UAH' ),
					'руб' => __( 'RUB' ),
				) ),
				Field::make( 'text', 'old_price', 'Old price (cross out)' )->set_width( 15 )
				                                                           ->set_attribute( 'type', 'number' ),
				Field::make( 'text', 'current_price', 'Current price' )->set_width( 15 )
				                                                       ->set_attribute( 'type', 'number' ),
				Field::make( 'text', 'items_left_text', 'Items left text' )->set_width( 60 ),
				Field::make( 'text', 'items_left_amount', 'amount' )->set_width( 5 )
				                                                    ->set_attribute( 'type', 'number' ),
				Field::make( 'text', 'items_left_pieces', 'pcs' )->set_width( 5 ),
				Field::make( 'text', 'order_button', 'Order button text' )->set_width( 50 ),
			));
		$this->print_wrappers = false;
	}

//	 Called when rendering the widget in the front-end
	function front_end( $args, $instance ) {
		echo $args['before_title'] . $instance['title'] . $args['after_title'];
		echo '<div class="discount">' . $instance['content'];
		echo '<span class="discount_amount">' . $instance['discount_amount'] . '</span></div>';
		echo '<div class="prices"><span class="old_price">' . $instance['old_price'] . $instance['price_currency'] . '</span>';
		echo '<span class="new_price">
					<span>' . $instance['current_price'] .'</span><span>'. $instance['price_currency'] . '</span>
              </span></div>';
		echo '<button class="b24-web-form-popup-btn-8 order_button">' . $instance['order_button'] . '</button>';
		echo '<div>' . $instance['items_left_text'] ;
		echo '<span class="left_pcs">' . $instance['items_left_amount'] . '</span>';
		echo $instance['items_left_pieces'] . '</div>';
	}
}

function load_widgets() {
	register_widget( 'CallToActionWidget' );
}
