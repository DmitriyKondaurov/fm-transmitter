<?php
add_filter('robots_txt', 'add_robotstxt');
function add_robotstxt($output){
	$output .= "Allow: $path/wp-content/uploads/\n";
	$output .= "Disallow: $path/wp-login.php\n";
	$output .= "Disallow: $path/wp-register.php\n";
	$output .= "Disallow: $path/xmlrpc.php\n";
	$output .= "Disallow: $path/template.html\n";
	$output .= "Disallow: $path/cgi-bin\n";
	$output .= "Disallow: $path/wp-admin\n";
	$output .= "Disallow: $path/wp-includes\n";
	$output .= "Disallow: $path/wp-content/plugins\n";
	$output .= "Disallow: $path/wp-content/cache\n";
	$output .= "Disallow: $path/wp-content/themes\n";
	$output .= "Disallow: *$path/trackback\n";
	$output .= "Disallow: *$path/feed\n";
	$output .= "Disallow: */comments\n";
	$output .= "Disallow: *$path/comment-page*\n";
	$output .= "Disallow: *$path/replytocom=\n";
	$output .= "Disallow: $path/author*\n";
	$output .= "Disallow: *$path/?author=*\n";
	$output .= "Disallow: *$path/tag\n";
	$output .= "Disallow: $path/?feed=\n";
	$output .= "Disallow: $path/?s=\n";
	$output .= "Disallow: $path/?se=\n";

	$output .= "Host: shops.sytes.net\n";

	return $output;
}
function underscores_child_scripts() {
	wp_enqueue_style( 'underscores-style', get_stylesheet_uri() );

//_____________________________________________ CUSTOM STYLES libs __________________________________________________
	wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/libs-style.min.css',
		array(), '1.0', false );
//-----------------------------------------------------------------------------------------------------------------

//___________________________________________    FONT AWESOME    ____________________________________________
	wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/b41b6eacb2.js', array(), '1.0',
		false );
//-----------------------------------------------------------------------------------------------------------------

//_______________________________________ CUSTOM  JS PLUGINS libs__________________________________________________
	wp_enqueue_script( 'custom-libs-plugins-js', get_template_directory_uri() . '/libs.min.js', array(), '1.0',
		false );
//-----------------------------------------------------------------------------------------------------------------

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'underscores_child_scripts' );
