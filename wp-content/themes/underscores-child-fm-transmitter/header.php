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
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-P6CGQ3C');</script>
    <!-- End Google Tag Manager -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112738095-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-112738095-1'); /*Google Analytics*/
        gtag('config', 'AW-820350295');  /*Google AdWords*/
    </script>
    <meta http-equiv="Cache-Control" content="max-age=31536000, public"/>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Громкая связь (hands free) в авто и трансляция музыки на Фм частоту по Bluetooth модулятору с мобильного телефона, планшета, ноутбука.">
    <meta name="keywords"
          content="fm modulator,bluetooth fm transmitter,модулятор,best fm transmitter,mp3 transmitter,купить модулятор,купить фм модулятор,fm трансмиттер,fm transmitter for car,модулятор купить,фм трансмиттер,модулятор в машину,fm модулятор с bluetooth,fm transmitter,фм модулятор для телефона,wireless fm transmitter,трансмиттер,bluetooth radio transmitter,fm модулятор bluetooth,transmiter fm,transmitter bluetooth,трансмитер,fm модулятор,фм модулятор,фм модулятор для авто">
    <meta name="google-site-verification" content="R4t3WEl3e4CRxOLs1ErckrEYWZNSro5lOY1ol0I8BhE"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="alternate" hreflang="ru" href="https://shops.sytes.net/"/>
	<?php wp_head();
	header( "Cache-Control: public, max-age=604800" );
	?>
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P6CGQ3C"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
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
                <a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <img class="logo"
                         src="<?php echo wp_get_attachment_image_url( carbon_get_theme_option( 'site_logo' ), array(
							     28, 28)) ?>" alt="logo" height="28" width="28"><?php
	                echo carbon_get_theme_option( 'site_logo_text' ) ?>
                    <span class="brand"> <?php echo $GLOBALS['custom_global_variable']['brand_name']?></span></a></h1>
            <div class="phone">
                <a href="viber://add?number=380978314414" class="tel"><span class="viber">Viber:</span>
	                <?php echo $GLOBALS['custom_global_variable']['phone']?></a>
            </div>

        </div><!-- .site-branding -->

    </header><!-- #masthead -->

    <div id="content" class="site-content">
