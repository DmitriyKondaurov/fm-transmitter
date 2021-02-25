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
                <span>Черкассы | Новая Почта</span><br>
                <span>ул. Благовесная 379 отд. №8</span><br>
                <div class="phone" >
                    <a href="viber://add?number=380978314414" class="tel"><span class="viber">Viber:</span>
	                    <?php echo $GLOBALS['custom_global_variable']['phone']?></a>
                </div>
                <ul class="social">
                    <li>
                        <a class="facebook-icon" href="https://www.facebook.com/permalink.php?story_fbid=972668916191446&id=926936384098033" target="_blank">
                            <i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a>
                    </li>
                    <li>
                        <a class="facebook-icon" href="https://plus.google.com/u/1/104593117882070015696/posts/VZiT9sigVke" target="_blank">
                            <i class="fa fa-google-plus" aria-hidden="true"></i></i>Google+</a>
                    </li>
                    <li>
                        <a class="facebook-icon" href="https://kondaurov-blog.tumblr.com/post/170055843893/bluetooth-fm-transmitter-bt-800-%D0%B2-%D0%BE%D1%81%D0%BD%D0%BE%D0%B2%D0%BD%D0%BE%D0%BC" target="_blank">
                            <i class="fa fa-tumblr" aria-hidden="true"></i>Tumblr</a>
                    </li>
                    <li>
                        <a class="facebook-icon" href="https://www.pinterest.com/invisibilityclear/bluetooth-fm-transmitter-bt-800/" target="_blank">
                            <i class="fa fa-pinterest" aria-hidden="true"></i>Pinterest</a>
                    </li>
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
