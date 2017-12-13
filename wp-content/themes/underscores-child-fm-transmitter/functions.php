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
?>
