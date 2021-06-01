<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package underscores
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
        <div class="container contacts">
            <div class="row">
                <span><?php echo $GLOBALS['custom_global_variable']['address']?></span><br>
                <div class="phone" >
                    <a href="viber://add?number=<?php echo $GLOBALS['custom_global_variable']['phone']?>" class="tel"><span class="viber">Viber:</span>
	                    <?php echo $GLOBALS['custom_global_variable']['phone']?></a>
                </div>
                <ul class="social">
                <?php if ($GLOBALS['custom_global_variable']['fb_url']):?>
                    <li>
                        <a class="facebook-icon" href="<?php echo $GLOBALS['custom_global_variable']['fb_url']?>"
                           target="_blank">
                            <i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a>
                    </li>
                <?php endif; ?>
                <?php if ($GLOBALS['custom_global_variable']['inst_url']):?>
                    <li>
                        <a class="facebook-icon" href="<?php echo $GLOBALS['custom_global_variable']['inst_url']?>" target="_blank">
                            <i class="fa fa-instagram" aria-hidden="true"></i></i>Instagram</a>
                    </li>
                <?php endif; ?>
                <?php if ($GLOBALS['custom_global_variable']['vk_url']):?>
                    <li>
                        <a class="facebook-icon" href="<?php echo $GLOBALS['custom_global_variable']['vk_url']?>" target="_blank">
                            <i class="fa fa-vk" aria-hidden="true"></i>Vkontakte</a>
                    </li>
                <?php endif; ?>
                <?php if ($GLOBALS['custom_global_variable']['youtube_url']):?>
                    <li>
                        <a class="facebook-icon" href="<?php echo $GLOBALS['custom_global_variable']['youtube_url']?>" target="_blank">
                            <i class="fa fa-youtube" aria-hidden="true"></i>YouTube</a>
                    </li>
                <?php endif; ?>
                </ul>
            </div>
        </div>
		<div class="site-info">

			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'underscores' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'CMS: %s', 'underscores' ), 'WordPress' );

			?></a>

			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Proudly produced by %s', 'underscores' ), 'Kondaurov Dmytro' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
