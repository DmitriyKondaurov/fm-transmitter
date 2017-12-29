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
                <div class="wrapper">
                    <div class="brand_name">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/new-site.png" alt="Новинка!"
                             class="brand_new">
                        <h1 class="slogan" >Многофункциональный bluetooth FM модулятор <span
                                    class="brand">'BT-800'</span></h1>
                    </div>
                    <div class="hero_main">
                        <div>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_img.png" alt="FM модулятор
                        'BT-800'" class="main_img">
                        </div>
                        <ul class="hero_shot_spec">
                            <li>Bluetooth hands free (Car Kit)</li>
                            <li>FM transmitter</li>
                            <li>Music from TF card</li>
                            <li>Bluetooth(A2DP) music</li>
                            <li>AUX line-in</li>
                            <li>Dual USB CarCharger 1A/2.1A</li>
                        </ul>
                        <div class="call_to_action">
                            <div class="attention">Акция!</div>
                            <div>Первым 10-ти покупателям скидка <span class="discount">20%</span></div>
                            <div class="prices"><span class="old_price">550 грн </span> <span class="new_price">440
                                    грн</span></div>
                            <button class="order_button">заказать</button>
                            <div>По акции осталось: <span class="left_pcs">6</span> шт.</div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="about">
                <ul class="about_full_spec">
                    <li>Безпроводная громкая связь в авто (Bluetooth-Fm)</li>
                    <li>Безпроводная громкая связь в авто (AUX-Fm)</li>
                    <li>Трансляция по радио волнам музыки с SD/TF card reader (SD card - Fm)</li>
                    <li>Трансляция по радио волнам музыки с AUX входа (AUX - Fm)</li>
                    <li>Трансляция по радио волнам музыки с Bluetooth соединения (A2DP - Fm)</li>
                    <li>Переходник с двумя выходами USB для умеренной и быстрой зарядки (1A / 2.1A)</li>
                    <li>Голосовое воспроизведение номера входящих звонков</li>
                </ul>
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
