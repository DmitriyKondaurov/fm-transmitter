<?php

function underscores_child_scripts() {

	//________________switch off some default WP style____________________________________________
	wp_dequeue_style('wp-block-library');
	wp_deregister_script('wp-embed');
	//--------------connect parent style-------------------------------------------------------
	wp_enqueue_style( 'underscores-style', get_stylesheet_uri() );

	//_____________________________________________ CUSTOM STYLES libs __________________________________________________
	wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/libs-style.min.css',
		array(), '1.0.0.0', false );

	//___________________________________________    Google Font    ____________________________________________
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;subset=cyrillic', array(), '1.0.0.0',
		false );

	//___________________________________________    FONT AWESOME    ____________________________________________
	wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/b41b6eacb2.js', array(), '1.0.0.0',
		false );

	//_______________________________________ CUSTOM  JS PLUGINS libs__________________________________________________
	wp_enqueue_script( 'custom-libs-plugins-js', get_stylesheet_directory_uri() . '/libs.min.js', array(), '1.0.0.0',
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
	return 'https://shops.sytes.net/wp-content/uploads/2017/12/cropped-thumbnail_71_71-1-e1532036247409.png';
}

//______________________CARBON-FIELDS_____________________________________________
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
	require_once( 'includes/carbon-fields/vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}

add_action( 'carbon_fields_register_fields', 'register_carbon_fields' );
function register_carbon_fields() {
	require_once( 'includes/carbon-fields-options/carbon-fields-options.php' );
}
//________________________________________________________________________________________