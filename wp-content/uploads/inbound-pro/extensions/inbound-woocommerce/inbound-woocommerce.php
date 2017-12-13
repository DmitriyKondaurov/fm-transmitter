<?php
/*
Plugin Name: Inbound Extension - WooCommerce Integration
Plugin URI: http://www.inboundnow.com/
Description: Adds Tracking Class to Checkout Form
Version: 2.2.4
Author: Inbound Now
Author URI: http://www.inboundnow.com/

*/


if (!class_exists('WC_leads')) {

	class WC_Leads {

		static $map;

		public function __construct() {

			self::setup_static_vars();
			self::load_hooks();
			self::load_files();

		}


		public static function setup_static_vars() {
			if(!defined('INBOUNDNOW_WOOCOMMERCE_CURRENT_VERSION')) { define('INBOUNDNOW_WOOCOMMERCE_CURRENT_VERSION', '2.2.3' ); }
			if(!defined('INBOUNDNOW_WOOCOMMERCE_LABEL')) { define('INBOUNDNOW_WOOCOMMERCE_LABEL' , 'WooCommerce Integration' ); }
			if(!defined('INBOUNDNOW_WOOCOMMERCE_SLUG')) { define('INBOUNDNOW_WOOCOMMERCE_SLUG' ,  basename(dirname(__FILE__) ));  }
			if(!defined('INBOUNDNOW_WOOCOMMERCE_FILE')) { define('INBOUNDNOW_WOOCOMMERCE_FILE' ,  __FILE__ ); }
			if(!defined('INBOUNDNOW_WOOCOMMERCE_REMOTE_ITEM_NAME')) { define('INBOUNDNOW_WOOCOMMERCE_REMOTE_ITEM_NAME' , 'woocommerce-integration' ); }
			define('INBOUNDNOW_WOOCOMMERCE_PATH', realpath(dirname(__FILE__)) . '/');
			$upload_dir = wp_upload_dir();
			$url = ( !strstr( INBOUNDNOW_WOOCOMMERCE_PATH , 'plugins' )) ? $upload_dir['baseurl'] . '/inbound-pro/extensions/' .plugin_basename( basename(__DIR__) ).'/' : WP_PLUGIN_URL.'/'.plugin_basename( dirname(__FILE__) ).'/' ;
			define('INBOUNDNOW_WOOCOMMERCE_URLPATH', $url );

		}

		public static function load_hooks() {
			/* Setup Automatic Updating & Licensing */
			add_action( 'admin_init', array( __CLASS__ , 'license_setup') );

			/* fix bootstrap conflict */
			add_action( 'admin_print_footer_scripts' , array( __CLASS__ , 'print_footer_css' ) );

			/* Add Lead on Update Order Meta */
			//add_action( 'woocommerce_checkout_update_order_meta' , array( __CLASS__, 'add_lead' ), 1000, 1 );

			/* Add Lead on Payment Complete */
			add_action( 'woocommerce_payment_complete' , array( __CLASS__ , 'add_lead' ), 10, 3 );

			/* Remove all tracking classes from cart page */
			add_action( 'wp_footer' , array( __CLASS__ , 'remove_cart_tracking_class') );

			/* adds inbound pro settings */
			add_action( 'inbound_settings/extend' , array( __CLASS__ , 'add_pro_settings' ) , 10 , 1);

			/* add quick stat  */
			add_action( 'wpleads_display_quick_stat', array(__CLASS__, 'display_quick_stat_purchases') , 15 );

			/* add page views as hidden input to checkout */
			add_action( 'woocommerce_before_checkout_billing_form' , array( __CLASS__ , 'add_page_view_hidden_input' ) );

			if (is_admin()) {
				/* Add 'spent' column */
				add_filter('manage_wp-lead_posts_columns', array(__CLASS__, 'add_column'), 20, 1);

				/* Calculate data for 'spent' column */
				add_action('manage_posts_custom_column', array(__CLASS__, 'prepare_column_data'), 10, 2);

				/* Make 'spent' column sortable */
				//add_filter('manage_edit-wp-lead_sortable_columns', array(__CLASS__, 'make_sortable'), 10);

				/* Add handler for sorting 'spent' column */
				//add_action('pre_get_posts', array(__CLASS__, 'sort_column'));

			}
		}


		public static function load_files() {

			include_once(INBOUNDNOW_WOOCOMMERCE_PATH . 'automation/trigger.woocommerce_payment_complete.php');

			if (!is_admin()) {
				return;
			}

			include_once(INBOUNDNOW_WOOCOMMERCE_PATH . 'reports/report.inbound_wc_sale.php');

		}

		/*
		* Setups Software Update API
		*/
		public static function license_setup() {

			/* ignore these hooks if inbound pro is active */
			if (defined('INBOUND_PRO_CURRENT_VERSION')) {
				return;
			}

			/*PREPARE THIS EXTENSION FOR LICESNING*/
			if ( class_exists( 'Inbound_License' ) ) {
				$license = new Inbound_License( INBOUNDNOW_WOOCOMMERCE_FILE , INBOUNDNOW_WOOCOMMERCE_LABEL , INBOUNDNOW_WOOCOMMERCE_SLUG , INBOUNDNOW_WOOCOMMERCE_CURRENT_VERSION  , INBOUNDNOW_WOOCOMMERCE_REMOTE_ITEM_NAME ) ;
			}
		}

		/*
		* Add Lead on Payment Complete
		*/
		public static function add_lead( $id, $status = 'new', $new_status = 'pending' ) {
			global $woocommerce;

			$order = new WC_Order( $id );
			$cart_items = $order->get_items( );

			//var_dump(  $woocommerce->cart );
			//exit;

			/* Setup Field Mapping */
			(isset($order->billing_email)) ? self::$map['wpleads_email_address'] = $order->billing_email : self::$map['wpleads_email_address'] = "";
			(isset($order->billing_first_name)) ? self::$map['wpleads_first_name'] = $order->billing_first_name : self::$map['wpleads_first_name'] = "";
			(isset($order->billing_last_name)) ? self::$map['wpleads_last_name'] = $order->billing_last_name : self::$map['wpleads_first_name'] = "";
			(isset($woocommerce->customer->country)) ? self::$map['wpleads_country'] = $woocommerce->customer->country : self::$map['wpleads_country'] = "";
			(isset($woocommerce->customer->address)) ? self::$map['wpleads_address_line_1'] = $woocommerce->customer->address : self::$map['wpleads_address_line_1'] = "";
			(isset($woocommerce->customer->address_2)) ? self::$map['wpleads_address_line_2'] = $woocommerce->customer->address_2 : self::$map['wpleads_address_line_2'] = "";
			(isset($woocommerce->customer->city)) ? self::$map['wpleads_city'] = $woocommerce->customer->city : self::$map['wpleads_city'] = "";
			(isset($woocommerce->customer->state)) ? self::$map['wpleads_region_name'] = $woocommerce->customer->state : self::$map['wpleads_region_name'] = "";
			(isset($woocommerce->customer->postcode)) ? self::$map['wpleads_zip'] = $woocommerce->customer->postcode : self::$map['wpleads_zip'] = "";
			(isset($woocommerce->customer->shipping_address)) ? self::$map['wpleads_shipping_address_line_1'] = $woocommerce->customer->shipping_address : self::$map['wpleads_shipping_address_line_1'] = "";
			(isset($woocommerce->customer->shipping_address_2)) ? self::$map['wpleads_shipping_address_line_2'] = $woocommerce->customer->shipping_address_2 : self::$map['wpleads_shipping_address_line_2'] = "";
			(isset($woocommerce->customer->shipping_city)) ? self::$map['wpleads_shipping_city'] = $woocommerce->customer->shipping_city : self::$map['wpleads_shipping_city'] = "";
			(isset($woocommerce->customer->shipping_state)) ? self::$map['wpleads_shipping_region_name'] = $woocommerce->customer->shipping_state : self::$map['wpleads_shipping_region_name'] = "";
			(isset($woocommerce->customer->shipping_postcode)) ? self::$map['wpleads_shipping_zip'] = $woocommerce->customer->shipping_postcode : self::$map['wpleads_shipping_zip'] = "";


			/* Abort if no email detected */
			if(!isset(self::$map['wpleads_email_address']) || !strstr( self::$map['wpleads_email_address'] , '@' ) ) {
				return;
			}

			/* Map user IP Address */
			self::$map['ip_address'] = $_SERVER['REMOTE_ADDR'];

			/* Grab referer data */
			self::$map['source'] = (isset($_COOKIE['inbound_referral_site'])) ? $_COOKIE['inbound_referral_site'] : '';

			/* Populate Tracking Cookie - Create if not Available */
			if (isset($_COOKIE['wp_lead_uid'])) {
				self::$map['wp_lead_uid'] = $_COOKIE['wp_lead_uid'];
			} else	{
				self::$map['wp_lead_uid'] = md5(self::$map['wpleads_email_address']);
				setcookie('wp_lead_uid' , self::$map['wp_lead_uid'] , time() + (20 * 365 * 24 * 60 * 60),'/');
			}

			/* Grab pageviews */
			self::$map['page_views'] = (isset($_POST['inbound_page_views'])) ? $_POST['inbound_page_views'] : '';

			/* Store Lead */
			$lead_id = inbound_store_lead( self::$map , true );

			/* Add sale events */
			foreach ($cart_items as $id => $item) {

				/* create a conversion activity */
				$args = array(
					'event_name' => 'inbound_wc_sale',
					'page_id' => $item['product_id'],
					'lead_id' => $lead_id,
					'funnel' => stripslashes(self::$map['page_views']),
					'source' => self::$map['source'],
					'lead_uid' => (isset(self::$map['wp_lead_uid'])) ? self::$map['wp_lead_uid'] : 0,
					'event_details' => $item,
				);

				Inbound_Events::store_event($args);
			}

		}

		/**
		 *  Removes tracking class 'wpl-track-me' from cart details page.
		 */
		public static function remove_cart_tracking_class() {
			?>
			<script type='text/javascript'>
				jQuery( document ).ready(function() {
					jQuery('input[name="proceed"]').closest("form").removeClass('wpl-track-me');
				})
			</script>
			<?php
		}


		/**
		 * Helper log function for debugging
		 *
		 * @since 1.2.2
		 */
		static function log( $message ) {
			if ( WP_DEBUG === true ) {
				if ( is_array( $message ) || is_object( $message ) ) {
					error_log( print_r( $message, true ) );
				} else {
					error_log( $message );
				}
			}
		}

		/**
		 *  Add inbound pro settings references
		 */
		public static function add_pro_settings($settings) {

			$settings['inbound-pro-settings'][] = array(
				'group_name' => INBOUNDNOW_WOOCOMMERCE_SLUG ,
				'keywords' => __('woocommerce' , 'inbound-pro'),
				'fields' => array (
					array(
						'id'  => 'header_woocommerce',
						'type'  => 'header',
						'default'  => __('WooCommerce', 'inbound-pro' ),
						'options' => null
					),
					array(
						'id'  => 'woocommerce_documentations',
						'type'  => 'ol',
						'label' => __( 'Documentation:' , 'inbound-pro' ),
						'options' => array(
							'<a href="http://docs.inboundnow.com/guide/debugging-woocommerce-integration/" target="_blank">'.__( 'Debugging the WooCommerce Extension' , 'inbound-pro' ).'</a>'
						)
					)
				)

			);

			return $settings;

		}

		/**
		 * Adds total spent calculation to leads listing table
		 * @param array
		 */
		public static function add_column($cols) {

			$cols['wc-spent'] = __("Spent", 'inbound-pro');
			return $cols;
		}

		/**
		 * Sort by 'spent'
		 * @param array
		 */
		public static function sort_column($query) {

			if (!is_admin()) {
				return;
			}

			$orderby = $query->get('orderby');

			if ('wc-spent' == $orderby) {
				$query->set('meta_key', 'wc_total_spent');
				$query->set('orderby', 'meta_value_num');
			}
		}

		/**
		 * Calculates total spent for lead and returns data
		 * @param string
		 * @param int
		 */
		public static function prepare_column_data($column, $post_id) {
			if ($column == "wc-spent") {
				global $post;
				$user = get_user_by('email', $post->post_title);
				if (isset($user->ID) ) {
					echo wc_price(wc_get_customer_total_spent($user->ID));
				} else {
					echo wc_price('0.00');
				}

			}
		}

		/**
		 * Makes 'spent' column sortable
		 * @param array
		 */
		public static function make_sortable($columns) {

			$columns['edd-spent'] = 'edd-spent';

			return $columns;
		}

		public static function print_footer_css() {
			$screen = get_current_screen();

			if (!isset($screen) || (  $screen->post_type != "product" && $screen->post_type != "shop_order" ) ) {
				return;
			}

			?>
			<style type="text/css">
				#product_attributes , #variable_product_options  {
					border:none !important;
				}

				.wc-order-totals td {
					color: #000 !important;
				}
			</style>
			<?php
		}

		/**
		 * Adds a quick stat for EDD Purchases to the Quick Stats box
		 */
		public static function display_quick_stat_purchases() {
			global $post;

			if (!isset($_REQUEST['range'])) {
				$range = 90;
			} else {
				$range = intval($_REQUEST['range']);
			}

			/* get daily action counts for chart 1 */
			$params = array(
				'lead_id' => $post->ID,
				'event_name' => 'inbound_wc_sale'
			);
			$sale_events = Inbound_Events::get_events($params);


			?>
			<div  class="quick-stat-label">
				<div class="label_1">
					<?php _e('WC Purchases', 'inbound-pro'); ?>
				</div>
				<div class="label_2">
					<?php
					if (class_exists('Inbound_Analytics')) {
						?>
						<a href='<?php echo admin_url('index.php?action=inbound_generate_report&lead_id='.$post->ID.'&class=Inbound_WC_Event_Report&event_name=inbound_wc_sale&range='.$range.'&tb_hide_nav=true&TB_iframe=true&width=1000&height=600'); ?>' class='thickbox inbound-thickbox'>
							<?php echo count($sale_events); ?>
						</a>
						<?php
					} else {
						echo count($sale_events);
					}
					?>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php

		}

		public static function add_page_view_hidden_input( $fields ) {
			?>
			<input name='inbound_page_views' type='hidden'>
			<script type='text/javascript'>
				jQuery(document).ready(function () {
					jQuery('input[name="inbound_page_views"]').val(localStorage.getItem("page_views"));
				});
			</script>
			<?php
		}
	}


	new WC_Leads();

}