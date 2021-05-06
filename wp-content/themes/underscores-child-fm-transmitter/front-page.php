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

get_header();
$page_id = get_the_id();
$current_post = get_post($page_id)->post_content;
$current_post_content = apply_filters('the_content', $current_post);
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <section id="hero" class="hero parallax-window"
                     data-parallax="scroll"
                     data--fix="false"
                     data-android-fix="false"
                     data-ios-fix="false"
                     data-speed="0.4"
                     data-image-src="<?php echo wp_get_original_image_url( carbon_get_post_meta( $page_id, 'hero_bg' ) ) ?>">
                <div class="wrapper">
                    <div class="brand_name">
						<?php if ( carbon_get_post_meta( $page_id, 'hero_sticker' ) ): ?>
                            <img src="<?php echo wp_get_original_image_url( carbon_get_post_meta( $page_id, 'hero_sticker' ) ) ?>"
                                 class="brand_new" alt="">
						<?php endif; ?>
                        <h2 class="slogan">
                            <span itemprop="name"><!--микроданные-->
                                <?php echo carbon_get_post_meta( $page_id, 'hero_banner' ) ?>
                                <span class="brand">
                                    <?php echo $GLOBALS['custom_global_variable']['brand_name'] ?>
                                </span>
                            </span>
                        </h2>

                    </div>
                    <div class="hero_main">
                        <div id="carousel_1" class="owl-carousel owl-theme">
							<?php
							$slides = carbon_get_post_meta( $page_id, 'hero_gallery' );
							if ( $slides ) {
								foreach ( $slides as $slide ) {?>
                                        <div><img src="<?php echo wp_get_original_image_url( $slide ); ?>"
                                                  alt="FM модулятор 'BT-800'"
                                                  title="FM модулятор 'BT-800'"
                                                  class="main_img">
                                        </div>
                                    <?php
								}
	                        }?>
                        </div>
                        <?php
                        echo wpautop( carbon_get_the_post_meta( 'hero_shot_spec' ) );
                        get_sidebar( 'header' );?>
                    </div>
                    <div class="nav_button">
                        <a href="#" id="nav_down" class="slider_scroll_button">
                            <i class="glyphicon glyphicon-menu-down"></i>
                        </a>
                    </div>
                </div>
            </section>
            <section class="compare">
                <div class="container">
                    <h2 class="title"><?php echo carbon_get_post_meta( $page_id, 'sec_advantages' ) ?></h2>
                    <table class="compare_table table-bordered">
                        <tbody itemprop="brand" itemscope itemtype="http://schema.org/Brand">
                        <tr>
                            <th><?php echo carbon_get_post_meta( $page_id, 'sec_advantages' ) ?></th>
                            <th><span itemprop="name" class="brand">
                                    <?php echo $GLOBALS['custom_global_variable']['brand_name'] ?></span>
                            </th><!--микроданные-->
                            <th>Other</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="brands_icons"><!--микроданные-->
	                            <?php if ( carbon_get_post_meta( $page_id, 'my_brand_icon' ) ): ?>
                                    <img itemprop="logo" src="<?php echo wp_get_original_image_url(
                                            carbon_get_post_meta( $page_id, 'my_brand_icon' ) ) ?>"
                                         alt="FM модулятор 'BT-800'" title="FM модулятор 'BT-800'"
                                         class="brand_img_icon">
	                            <?php endif; ?>
                            </td>
                            <td class="brands_icons">
	                            <?php if ( carbon_get_post_meta( $page_id, 'other_brand_icon' ) ): ?>
                                    <img src="<?php echo wp_get_original_image_url(
			                            carbon_get_post_meta( $page_id, 'other_brand_icon' ) ) ?>"
                                         alt="FM модулятор" title="другой FM модулятор"
                                         class="brand_img_icon">
	                            <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                        $advantages = carbon_get_post_meta( $page_id, 'crb_advantages' );
                        if ( $advantages ) {
	                        foreach ( $advantages as $advantage ) {?>
                                <tr>
                                    <td><?php echo $advantage['advantage']?></td>
		                            <?php if ( $advantage['my_product']): ?>
                                    <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                                    <?php else: ?>
                                    <td><span class="glyphicon glyphicon-remove text-danger"></span></td>
		                            <?php endif; ?>
                                    <?php if ( $advantage['other_product']): ?>
                                    <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                                    <?php else: ?>
                                    <td><span class="glyphicon glyphicon-remove text-danger"></span></td>
                                    <?php endif; ?>
                                </tr>
		                        <?php
	                        }
                        }?>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="about parallax-window"
                     data-parallax="scroll"
                     data--fix="false"
                     data-android-fix="false"
                     data-ios-fix="false"
                     data-speed="0.3"
                     data-image-src="<?php echo wp_get_original_image_url( carbon_get_post_meta( $page_id, 'sec_functions_bg' ) ) ?>">
                <div class="wrapper">
                    <h2 class="title"><?php echo carbon_get_post_meta( $page_id, 'sec_functions' ) ?></h2>
                    <ul id="functions" class="about_full_spec">
	                    <?php
	                    $crb_functions = carbon_get_post_meta( $page_id, 'crb_functions' );
	                    if ( $crb_functions ):
		                    foreach ( $crb_functions as $crb_function ) {?>
                        <li class="<?php echo $crb_function['choose_icon'] ?>">
                                   <p><?php echo $crb_function['function_description'] ?></p>
                            <?php
		                    }
                        endif; ?>
                    </ul>
                </div>
            </section>
            <section class="explaining">
                <div class="wrapper">
                    <div class="flex_box">
                        <div class="explain_item">
                            <h2 class="title"><?php echo carbon_get_post_meta( $page_id, 'sec_specification' ) ?></h2>
                            <div class="exp_img">
                                <img src="<?php echo wp_get_original_image_url(
	                                carbon_get_post_meta( $page_id, 'spec_image' ) ) ?>"
                                     alt="explain device FM модулятор 'BT-800'" title="Спецификация на FM модулятор
                                     'BT-800'">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="fresh_comments parallax-window"
                     data-parallax="scroll"
                     data--fix="false"
                     data-android-fix="false"
                     data-ios-fix="false"
                     data-speed="0.3"
                     data-image-src="<?php echo get_stylesheet_directory_uri(); ?>/img/background2.webp">
                <div class="wrapper">
					<?php //Show fresh comments
					get_sidebar(); ?>
                    <div class="add_new_comment"><?php comments_template(); ?></div>
                    <div class="add_new_comment_button" id="add_new_comment_button">добавить коментарий</div>
                </div>
            </section>
            <section class="video">
                <div class="wrapper">
                    <h2 class="title"><?php echo carbon_get_post_meta( $page_id, 'sec_screencast' ) ?></h2>
                    <div class="flex-video flex-video-widescreen mb-beta">
                        <iframe id="video-iframe"
                                src="<?php echo carbon_get_post_meta( $page_id, 'link_overview' ) ?>"
                                frameborder="0" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </section>
            <section class="ship_payment">
                <div class="wrapper">
                    <h2 class="title"><?php echo carbon_get_post_meta( $page_id, 'sec_shipment' ) ?></h2>
                    <div class="flex_box">
                        <div>
	                        <?php echo wpautop( carbon_get_the_post_meta( 'shipment_info' ) );?>
                        </div>
	                        <?php get_sidebar( 'footer' );?>
                    </div>
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
get_footer();
