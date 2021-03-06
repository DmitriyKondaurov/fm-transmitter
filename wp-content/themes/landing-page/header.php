<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package underscores
 */

?>
<!doctype html>
<!-- Разметка с помощью микроданных, созданная Мастером разметки структурированных данных Google. -->
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Cache-Control" content="max-age=<?php echo $GLOBALS['custom_global_variable']['cache_control']?>, public"/>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="<?php echo $GLOBALS['custom_global_variable']['description']?>">
    <meta name="keywords"
          content="<?php echo $GLOBALS['custom_global_variable']['keywords']?>">

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="alternate" hreflang="ru" href="<?php echo $GLOBALS['custom_global_variable']['domain']?>"/>
	<?php wp_head();?>
</head>
<style>
    :root {
        --brand-color: <?php echo carbon_get_theme_option('brand_color')?>;
        --main-text-color: <?php echo carbon_get_theme_option('main-text-color')?>;
        --sec-text-color: <?php echo carbon_get_theme_option('sec-text-color')?>;
        --hero-bg: <?php echo "url('".wp_get_original_image_url( carbon_get_post_meta( $page_id, 'hero_bg' ) )."')" ?>;
        --functions-bg: <?php echo "url('".wp_get_original_image_url( carbon_get_post_meta( $page_id, 'sec_functions_bg' ) )."')" ?>;
        --advantages-bg: <?php echo carbon_get_post_meta( $page_id, 'advantages_bg')?>;
        --spec-bg: <?php echo carbon_get_post_meta( $page_id, 'spec_bg')?>;
    }
</style>

<body <?php body_class(); ?>>

<div class="loader">
    <div class="loader_inner"></div>
</div>
<div itemscope itemtype="http://schema.org/Product" id="page" class="site"> <!--микроданные-->
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'underscores' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="site-branding">
			<?php
			the_custom_logo(); ?>
            <h1 class="site-title">
                <a itemprop="url" class="logo-container" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <img class="logo"
                         src="<?php echo esc_url(wp_get_attachment_image_url( $GLOBALS['custom_global_variable']['site_logo'], array(
							     28, 28))) ?>" alt="logo" height="28" width="28"><?php
	                echo $GLOBALS['custom_global_variable']['site_logo_text'] ?>
                    <span class="brand"> <?php echo $GLOBALS['custom_global_variable']['brand_name']?></span></a></h1>
	        <?php
	        if ( is_front_page() ) : ?>
                <div class="login-container">
                    <a href="<?php echo esc_url( wp_login_url()); ?>" class="login-url" title="Login">Login</a>
                </div>
	        <?php endif; ?>
            <div class="phone">
                <a href="viber://add?number=380978314414" class="tel"><span class="viber">Viber:</span>
	                <?php echo $GLOBALS['custom_global_variable']['phone']?></a>
            </div>

        </div><!-- .site-branding -->

    </header><!-- #masthead -->

    <div id="content" class="site-content">
