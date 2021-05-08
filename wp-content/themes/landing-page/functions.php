<?php
//______________________CARBON-FIELDS_____________________________________________
use function Sodium\add;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
	require_once( 'includes/carbon-fields-options/carbon-fields-options.php' );
	require_once( 'includes/carbon-fields-options/carbon-fields-post-meta.php' );
	require_once( 'includes/carbon-fields-options/carbon-fields-widgets.php' );
}

add_action( 'widgets_init', 'underscores_child_header_sidebar_init' );
add_action( 'widgets_init', 'underscores_child_footer_sidebar_init' );
add_action( 'widgets_init', 'load_widgets' );

//регестрируем место под виджеты
function underscores_child_header_sidebar_init() {
	register_sidebar( array(
		'name'          => 'Header banner',
		'id'            => 'header_banner',
		'before_widget' => '<div id="%1$s" class="call_to_action %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="attention-2">',
		'after_title'   => '</h3>',
	) );

}

function underscores_child_footer_sidebar_init() {
	register_sidebar( array(
		'name'          => 'Footer banner',
		'id'            => 'footer_banner',
		'before_widget' => '<div id="%1$s" class="call_to_action %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="attention-2">',
		'after_title'   => '</h3>',
	) );

}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
	require_once( 'includes/carbon-fields/vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}

function underscores_child_scripts() {
	$version = '0.0.0.0';
	//________________switch off some default WP style____________________________________________
	wp_dequeue_style('wp-block-library');
	wp_deregister_script('wp-embed');
	//--------------connect parent style-------------------------------------------------------
	wp_enqueue_style( 'underscores-style', get_stylesheet_uri() );

	//_____________________________________________ CUSTOM STYLES libs __________________________________________________
	wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/libs-style.min.css',
		array(), $version, false );

	//___________________________________________    Google Font    ____________________________________________
//	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;subset=cyrillic', array(), '1.0.0.0',
//		false );

	//___________________________________________    FONT AWESOME    ____________________________________________
	wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/b41b6eacb2.js', array(), $version,
		false );

	//_______________________________________ CUSTOM  JS PLUGINS libs__________________________________________________
	wp_enqueue_script( 'custom-libs-plugins-js', get_stylesheet_directory_uri() . '/libs.min.js', array(), $version,
		false );
	//-----------------------------------------------------------------------------------------------------------------

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	//	-------------------------------------------------creat custom JS Object with  property 'siteURL'-----------------
	wp_localize_script('custom-libs-plugins-js', 'WPJS', [
		'siteUrl' => get_template_directory_uri(),
	]);

}
add_action( 'wp_enqueue_scripts', 'underscores_child_scripts' );


//add site logo image For Google Rich Snippets
add_filter( 'wp_postratings_site_logo', 'wp_postratings_site_logo' );
function wp_postratings_site_logo( $url ) {
	return get_theme_root_uri().'/landing-page/img/brand-icon.png';
}

add_action('init', 'create_global_variable');
function create_global_variable() {
	global $custom_global_variable;
	$custom_global_variable = [
		'phone' => carbon_get_theme_option('viber_phone'),
		'brand_name' => carbon_get_theme_option('brand_name'),
		'site_logo' => carbon_get_theme_option('site_logo'),
		'brand_color' => carbon_get_theme_option('brand_color'),
		'site_logo_text' => carbon_get_theme_option('site_logo_text'),
		'fb_url' => carbon_get_theme_option('fb_url'),
		'inst_url' => carbon_get_theme_option('inst_url'),
		'vk_url' => carbon_get_theme_option('vk_url'),
		'youtube_url' => carbon_get_theme_option('youtube_url'),
		'address' => carbon_get_theme_option('address'),
		'cache_control' => carbon_get_theme_option('cache_control'),
		'description' => carbon_get_theme_option('description'),
		'keywords' => carbon_get_theme_option('keywords'),
		'domain' => carbon_get_theme_option('domain'),
		'my_brand_icon' => carbon_get_post_meta(2, 'my_brand_icon'),
		'other_brand_icon' => carbon_get_post_meta(2, 'other_brand_icon'),
	];
}

add_action( 'admin_menu', function() {
	global $current_user;
	global $submenu;
	$current_user = wp_get_current_user();
	$user_name = $current_user->user_login;

	//check condition for the user means show menu for this user
	if(is_admin() &&  $user_name != 'dima') {
		//We need this because the submenu's link (key from the array too) will always be generated with the current SERVER_URI in mind.
		$customizer_url = add_query_arg( 'return', urlencode( remove_query_arg( wp_removable_query_args(),
			wp_unslash( $_SERVER['REQUEST_URI'] ) ) ), 'customize.php' );
		remove_submenu_page( 'themes.php', $customizer_url );
		remove_submenu_page( 'themes.php', 'theme-editor.php' );
//		remove customize preview
		if ( isset( $submenu[ 'themes.php' ] ) ) {
			foreach ( $submenu[ 'themes.php' ] as $index => $menu_item ) {
				foreach ($menu_item as $value) {
					if (strpos($value,'customize') !== false) {
						unset( $submenu[ 'themes.php' ][ $index ] );
					}
				}
			}
		}
	}
}, 999 );
//________________________________________________________________________________________