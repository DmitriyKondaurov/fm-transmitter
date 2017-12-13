<?php
/*
Trigger Name: Form Submission Event
Trigger Description: This trigger fires whenever a tracked Form is submitted.
Trigger Author: Inbound Now
Contributors: Hudson Atwell
*/

class Inbound_Automation_Trigger_woocommerce_payment_complete {

	static $trigger;

	/**
	 *  Initialize Class
	 */
	function __construct() {

		self::$trigger = 'woocommerce_payment_complete';
		//self::create_dummy_event();
		add_filter( 'inbound_automation_triggers' , array( __CLASS__ , 'define_trigger' ) , 1 , 1);
		add_action( 'activate/inbound-automation' , array( __CLASS__ , 'create_dummy_event' ) );

	}

	/**
	 *  Define Trigger
	 */
	public static function define_trigger( $triggers ) {

		/* Set & Extend Trigger Argument Filters */
		$arguments = apply_filters('trigger/woocommerce_payment_complete/args' , array(
			'payment_data' => array(
				'id' => 'payment_data',
				'label' => __( 'Payment Data' , 'inbound-pro' ),
				'callback' => array(
					get_class() , 'prepare_payment'
				)
			)
		) );

		/* Set & Extend Action DB Lookup Filters */
		$db_lookup_filters = apply_filters( 'trigger/woocommerce_payment_complete/db_filters' , array (
			array(
				'id' => 'payment_status',
				'label' => __( 'Payment Status' , 'inbound-pro' ),
				'class_name' => 'Inbound_Automation_Query_EDD_Customer'
			)
		));

		/* Set & Extend Available Actions */
		$actions = apply_filters('trigger/woocommerce_payment_complete/actions' , array(
			'create_lead' ,
			'send_email' ,
			'wait' ,
			'relay_data' ,
			'add_remove_lead_tag',
			'kill_lead_tasks'
		));

		$triggers[self::$trigger] = array (
			'label' => __( 'WooCommerce purchase' , 'inbound-pro' ),
			'description' => __( 'This trigger fires whenever a WooCommerce purchase is completed.' , 'inbound-pro' ),
			'action_hook' => self::$trigger,
			'scheduling' => false,
			'arguments' => $arguments,
			'db_lookup_filters' => $db_lookup_filters,
			'actions' => $actions
		);

		return $triggers;
	}

	/**
	 * Get payment data from payment id
	 * @param $order_id
	 * @return array
	 */
	public static function prepare_payment( $order_id ) {

		/* skip callback for define_arguments() method */
		if (debug_backtrace()[1]['function'] == 'define_arguments' ) {
			return $order_id;
		}


		global $woocommerce;
		$order = new WC_Order( $order_id );

		$order_array = array();
		$order_array['order_id'] = $order_id;
		$order_array['billing_email'] = $order->billing_email;
		$order_array['billing_first_name'] = $order->billing_first_name;
		$order_array['billing_last_name'] = $order->billing_last_name;
		$order_array['billing_company'] = $order->billing_company;
		$order_array['billing_address_1'] = $order->billing_address_1;
		$order_array['billing_address_2'] = $order->billing_address_2;
		$order_array['billing_city'] = $order->billing_city;
		$order_array['billing_state'] = $order->billing_state;
		$order_array['billing_postcode'] = $order->billing_postcode;
		$order_array['billing_country'] = $order->billing_country;
		$order_array['billing_phone'] = $order->billing_phone;
		$order_array['shipping_first_name'] = $order->shipping_first_name;
		$order_array['shipping_last_name'] = $order->shipping_last_name;
		$order_array['shipping_company'] = $order->shipping_company;
		$order_array['shipping_address_1'] = $order->shipping_address_1;
		$order_array['shipping_address_2'] = $order->shipping_address_2;
		$order_array['shipping_city'] = $order->shipping_city;
		$order_array['shipping_state'] = $order->shipping_state;
		$order_array['shipping_postcode'] = $order->shipping_postcode;
		$order_array['shipping_country'] = $order->shipping_country;
		$order_array['shipping_country'] = $order->shipping_country;
		$order_array['coupon'] = $order->coupon_code;
		$order_array['discount'] = $order->coupon_discount;
		$order_array['customer_user_agent'] = $order->customer_user_agent;
		$order_array['payment_method'] = $order->payment_method;
		$order_array['created_via'] = $order->created_via;
		$order_array['customer_message'] = $order->customer_message;
		$order_array['customer_note'] = $order->customer_note;
		$order_array['date_paid'] = $order->date_paid;

		$customer_id = get_current_user_id();
		$user  = get_user_by('email' , $order_array['billing_email']);
		$order_array['user_info'] = array();
		$order_array['user_info']['user_id'] =(isset($customer_id)) ? $customer_id : $user->id;

		$order_array['source'] = ( isset($_COOKIE['inbound_referral_site']) ? $_COOKIE['inbound_referral_site'] : '' );

		$items = $order->get_items();
		$order_array['cart'] = json_encode($items);
		$order_array['purchase_total'] = 0;
		$order_array['tax_total'] = 0;
		$order_array['subtotal'] = 0;
		$order_array['subtotal_tax'] = 0;
		$order_array['subtotal_tax'] = 0;
		foreach ( $items as $item ) {
			$order_array['purchase_total'] += $item['line_total'];
			$order_array['tax_total'] += $item['line_tax'];
			$order_array['subtotal'] += $item['line_subtotal'];
			$order_array['subtotal_tax'] += $item['line_subtotal_tax'];
		}


		return $order_array;
	}

	/**
	 * Simulate trigger - perform on plugin activation
	 */
	public static function create_dummy_event() {

		$inbound_arguments = Inbound_Options_API::get_option( 'inbound_automation' , 'arguments' );
		$inbound_arguments = ( is_array($inbound_arguments)  ) ?  $inbound_arguments : array();

		if (!isset($inbound_arguments[self::$trigger]['payment_data'])) {
			return;
		}

		$payment = array(
			'payment_id' => 99630,
			'billing_email' => 'bigblo679operrs787@gmail . com',
			'billing_first_name' => 'Example',
			'billing_last_name' => 'Person',
			'billing_company' => '',
			'billing_address_1' => '1500 Rose Terrace',
			'billing_address_2' => '',
			'billing_city' => 'Dothan',
			'billing_state' => 'AL',
			'billing_postcode' => '36303',
			'billing_country' => 'US',
			'billing_phone' => '3343333333',
			'shipping_first_name' => 'Example',
			'shipping_last_name' => 'Person',
			'shipping_company' => '',
			'shipping_address_1' => '1501 Springhill Terrace',
			'shipping_address_2' => '',
			'shipping_city' => 'Dothan',
			'shipping_state' => 'AL',
			'shipping_postcode' => '36303',
			'shipping_country' => 'US',
			'coupon' => '',
			'discount' => '',
			'customer_user_agent' => 'Mozilla / 5.0 (Windows NT 10.0; WOW64) AppleWebKit / 537.36 (KHTML, like Gecko) Chrome / 56.0.2924.87 Safari / 537.36',
			'payment_method' => '',
			'created_via' => 'checkout',
			'customer_message' => '',
			'customer_note' => '',
			'date_paid' => '',
			'user_info' => array('user_id' => 2	),

			'source' => 'http://someremotesite.com',
			'cart' => '{
			"54":{
				"name":"Test Product","type":"line_item","item_meta":{
					"_qty":\'"3"],"_tax_class":[""],"_product_id":["98762"],"_variation_id":["0"],"_line_subtotal":["0"],"_line_total":["0"],"_line_subtotal_tax":["0"],"_line_tax":["0"],"_line_tax_data":["a:2:{s:5:\"total\";a:0:{}s:8:\"subtotal\";a:0:{}}"]},"item_meta_array":{
					"478":{
						"key":"_qty","value":"3"},"479":{
						"key":"_tax_class","value":""},"480":{
						"key":"_product_id","value":"98762"},"481":{
						"key":"_variation_id","value":"0"},"482":{
						"key":"_line_subtotal","value":"0"},"483":{
						"key":"_line_total","value":"0"},"484":{
						"key":"_line_subtotal_tax","value":"0"},"485":{
						"key":"_line_tax","value":"0"},"486":{
						"key":"_line_tax_data","value":"a:2:{s:5:\"total\";a:0:{}s:8:\"subtotal\";a:0:{}}"}},"qty":"3","tax_class":"","product_id":"98762","variation_id":"0","line_subtotal":"0","line_total":"0","line_subtotal_tax":"0","line_tax":"0","line_tax_data":"a:2:{s:5:\"total\";a:0:{}s:8:\"subtotal\";a:0:{}}"}}',
			'purchase_total' => 0,
			'tax_total' => 0,
			'subtotal' => 0,
			'subtotal_tax' => 0
		);

		$inbound_arguments[self::$trigger]['payment_data'] = $payment;

		Inbound_Options_API::update_option( 'inbound_automation' , 'arguments' ,  $inbound_arguments );
	}

}

/* Load Trigger */
new Inbound_Automation_Trigger_woocommerce_payment_complete;
