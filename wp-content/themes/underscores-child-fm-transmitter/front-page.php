<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage underscores Child (Fm transmitter)
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <a href="#" id="nav_down" class="slider_scroll_bottom">
                <i class="fa fa-angle-down"></i>
            </a>
            <section id="hero" class="hero">
                <div class="attention">НОВИНКА!</div>
                <h1>Многофункциональный bluetooth FM модулятор 'BT-800'</h1>
                <p>Car Kit hands free/A2DP music/AUX line-in/TF card/FM transmitter</p>
                <div class="hero_image">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_img.png" alt="FM модулятор
                    'BT-800'">
                </div>
                <div class="call_to_action">

                </div>
            </section>

			<?php // Show the selected frontpage content.
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/page/content', 'front-page' );
				endwhile;
			else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
				get_template_part( 'template-parts/post/content', 'none' );
			endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
