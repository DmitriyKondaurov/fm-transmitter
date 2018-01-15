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
                        +380978314414</a>
                </div>
            </div>
        </div>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'underscores' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by  %s', 'underscores' ), 'Kondaurov Dmytro' );
			?></a>
			<span class="sep"> | </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'CMS: %s', 'underscores' ), 'WordPress' );
			?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script id="__bs_script__">//<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.18.13'><\/script>".replace("HOST", location.hostname));
    //]]></script>
</body>
</html>
